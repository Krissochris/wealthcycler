<?php

namespace App\Console\Commands;

use App\GetDonation;
use App\MaintenanceFee;
use App\Package;
use App\ProvideDonation;
use App\User;
use App\VirtualCycle;
use App\VirtualMerges;
use App\VirtualWallet;
use App\Wallet;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ProcessVirtualMerges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process_virtual_merges';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $virtualMerges = static::getActiveMerges();
        if ($virtualMerges->isEmpty()) {
            return ;
        }
        foreach ($virtualMerges as $virtualMerge) {
            try {
                DB::beginTransaction();
                // create two get donation records for
                //the provide donation user
                static::createGetDonation(
                    $virtualMerge->provide_donation->user_id,
                    $virtualMerge->provide_donation->amount,
                    $virtualMerge->provide_donation->id,
                    $virtualMerge->provide_donation->package_id
                );

                static::createGetDonation(
                    $virtualMerge->provide_donation->user_id,
                    $virtualMerge->provide_donation->amount,
                    $virtualMerge->provide_donation->id,
                    $virtualMerge->provide_donation->package_id
                );

                $virtualMerge->provide_donation->updateStatus(ProvideDonation::COMPLETED);
                // completing the get donation
                if (static::checkIfGetDonationIsFirst($virtualMerge->get_donation)) {
                    $get_donation_user = User::with(['virtual_wallet'])
                        ->select(['id'])
                        ->find($virtualMerge->get_donation->user_id);

                    if ($get_donation_user) {
                        $credited = $get_donation_user->virtual_wallet->credit($virtualMerge->get_donation->amount);
                        throw_if(!$credited, '\Exception', 'An error occurred crediting user virtual wallet');
                    }
                } else {
                    // create a new provide donation to continue the cycle
                    $newProvideDonation =
                    ProvideDonation::create([
                        'user_id' => $virtualMerge->get_donation->user_id,
                        'package_id' => $virtualMerge->get_donation->package_id,
                        'amount' => $virtualMerge->get_donation->amount
                    ]);
                    throw_if(!$newProvideDonation, '\Exception', 'An error occurred creating new provide donation for the user');

                    $newVirtualCycle =
                    VirtualCycle::create([
                        'user_id' => $virtualMerge->get_donation->user_id,
                        'package_id' => $virtualMerge->get_donation->package_id,
                        'created_get_donation_id' => $virtualMerge->get_donation->id,
                    ]);
                    throw_if(!$newVirtualCycle, '\Exception', 'An error occurred creating the user new virtual cycle');

                    // check if the cycle is the third and debit 30% of that from the user
                    static::checkIfThirdCycleAndTaxUser($virtualMerge->get_donation->package_id,
                        $virtualMerge->get_donation->user_id,
                        $virtualMerge->get_donation->amount,
                        $virtualMerge->get_donation->id
                    );
                }
                $virtualMerge->get_donation->updateStatus(GetDonation::COMPLETED);

                $virtualMergeUpdated = $virtualMerge->updateStatus(VirtualMerges::COMPLETED);
                throw_if(!$virtualMergeUpdated, '\Exception', 'virtual merge could not be marked as completed');

                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                // notify the administration of the error. and continue processing
            }
        }
        return true;
    }

    protected static function getActiveMerges()
    {
        return VirtualMerges::query()
            ->has('provide_donation')
            ->has('get_donation')
            ->with(['provide_donation', 'get_donation'])
            ->where('status', VirtualMerges::ACTIVE)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    protected static function createGetDonation($user_id, $amount, $provide_donation_id, $package_id)
    {
        $getDonation = GetDonation::create([
            'user_id' => $user_id,
            'amount' => $amount,
            'provide_donation_id' => $provide_donation_id,
            'package_id' => $package_id,
        ]);
        if (!$getDonation) {
            throw new \Exception('could not create get donation');
        }
        return false;
    }

    /**
     * Checks if a get donation has already been marked as completed
     */
    protected static function checkIfGetDonationIsFirst($get_donation)
    {
        $getDonation = GetDonation::query()
            ->where('provide_donation_id', $get_donation->provide_donation_id)
            ->where('status', GetDonation::COMPLETED)
            ->first();
        if ($getDonation) {
            return false;
        }
        return true;
    }

    protected static function checkIfThirdCycleAndTaxUser($package_id, $user_id, $amount, $get_donation_id)
    {
        $virtualCycles = VirtualCycle::query()
            ->where('package_id', $package_id)
            ->where('user_id', $user_id)
            ->where('taxed', 0)
            ->orderBy('created_at')
            ->limit(3)
            ->get();
        if ($virtualCycles->count() === 3) {
            // tax the user
            $taxed_amount = (float)$amount * (30 / 100);
            $virtual_wallet = VirtualWallet::where('user_id', $user_id)
                ->first();

            $virtualWalletDebited = $virtual_wallet->debit($taxed_amount);
            throw_if(!$virtualWalletDebited, '\Exception', 'An error occurred taxing the user virtual wallet');

            $maintenanceFee =
            MaintenanceFee::create([
                'user_id' => $user_id,
                'package_id' => $package_id,
                'get_donation_id' => $get_donation_id,
                'amount' => $taxed_amount
            ]);
            if (!$maintenanceFee) {
                throw new \Exception('maintenance fee could not be created');
            }
            activity()
                ->performedOn($virtual_wallet)
                ->causedBy($user_id)
                ->log('You virtual wallet was taxed. ($'.number_format($taxed_amount, 2).') has been deducted from your virtual wallet.');

            foreach ($virtualCycles as $virtualCycle) {
                $virtualCycle->completed_get_donation_id = $get_donation_id;
                if (!$virtualCycle->taxed()) {
                    throw new \Exception('Error occurred taxing the user get paid get donation');
                }
            }
        }
    }
}
