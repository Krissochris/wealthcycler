<?php

namespace App\Console\Commands;

use App\GetDonation;
use App\Package;
use App\ProvideDonation;
use App\VirtualMerges;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateVirtualMerges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create_virtual_merges';

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
        $packages = $this->getPackages();

        if ($packages->isEmpty()) {
            return ;
        }
        foreach ($packages as $package) {
            $getDonations = static::getGetDonations($package['id']);
            if ($getDonations->isEmpty()) {
                continue;
            }

            foreach ($getDonations as $getDonation) {
                $provideDonation = static::getProvideDonation($package['id']);

                if (is_null($provideDonation)) {
                    break;
                }

                try {
                    DB::beginTransaction();
                    //create a new virtual merge
                    $new_virtual_merge = VirtualMerges::create([
                        'provide_donation_id' => $provideDonation['id'],
                        'get_donation_id' => $getDonation['id'],
                        'amount' => $provideDonation['amount']
                    ]);

                    throw_if(!$new_virtual_merge, '\Exception', 'An error occurred creating new virtual merge');

                    if ($new_virtual_merge) {

                        throw_if(!$provideDonation->updateStatus(ProvideDonation::IN_PROGRESS), '\Exception', 'An error occurred updating provide donation record');

                        throw_if(!$getDonation->updateStatus(GetDonation::IN_PROGRESS), '\Exception', 'An error occurred updating get donation record');
                    }
                    DB::commit();
                } catch (\Exception $exception) {
                    dd($exception->getMessage());
                    DB::rollBack();
                }
            }
        }
    }

    protected static function getProvideDonation($package_id)
    {
        return  ProvideDonation::query()
            ->where('package_id', $package_id)
            ->where('status', ProvideDonation::ACTIVE)
            ->orderBy('created_at', 'asc')
            ->first();
    }

    protected static function  getGetDonations($package_id)
    {
        return  GetDonation::query()
            ->where('package_id', $package_id)
            ->where('status', GetDonation::ACTIVE)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function getPackages()
    {
        return Package::all();
    }
}
