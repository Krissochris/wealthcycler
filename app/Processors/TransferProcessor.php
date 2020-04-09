<?php


namespace App\Processors;


use App\ProvideDonation;
use App\User;
use App\UserReferral;
use App\UserSavingWallet;
use App\UserVirtualWithdrawal;
use App\VirtualWallet;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class TransferProcessor
{
    protected $user_id,
        $savingWallet,
        $user,
        $virtualWallet;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
        $this->user = User::find($user_id);
        $this->savingWallet = UserSavingWallet::where('user_id', $user_id)->first();
        $this->virtualWallet = VirtualWallet::where('user_id', $user_id)->first();
        if (is_null($this->savingWallet) || is_null($this->virtualWallet) || is_null($this->user)) {
            throw new \Exception('One of the user wallet system does not exists');
        }
    }

    public function processTransfer($postData)
    {
        if ($postData['from_wallet'] === 'saving') {
            // perform the transfer
            if ($postData['amount'] > $this->savingWallet->amount) {
                flash()->error('Amount specified is greater than wallet balance');
                return false;
            }
            try {
                DB::beginTransaction();
                $this->savingWallet->debit($postData['amount']);
                $this->virtualWallet->credit($postData['amount']);
                DB::commit();
                flash()->success('You have successfully transfer $'. number_format($postData['amount'], 2).' from the savings wallet to the virtual wallet.');
                return true;
            } catch ( \Exception $exception) {
                DB::rollBack();
                flash()->error('Error occurred make the transfer. Please try again later. If problem persists report to the customer care');
                return false;
            }
        } elseif($postData['from_wallet'] === 'virtual') {

            if ($postData['amount'] > $this->virtualWallet->amount) {
                flash()->error('Amount specified is greater than wallet balance');
                return false;
            }

            $withdrawalAmount = $postData['amount'];
            // get last withdrawal time
            $last_withdrawal_record = $this->getLastWithdrawal($this->user_id);
            if (is_null($last_withdrawal_record)) {
                flash()->error('You can not make a transfer from your virtual wallet at this time. Please try again later');
                return false;
            }
            if (!$this->user->override_referral_limit_in_virtual_transfer) {
                // get the user referral between the last withdrawal
                $referralsCount = UserReferral::query()
                    ->select('users.id','users.is_pro_member', 'user_referrals.*')
                    ->join('users', 'user_referrals.referred_user_id', '=', 'users.id')
                    ->where('user_referrals.referral_user_id', $this->user_id)
                    ->where(function($query) use ($last_withdrawal_record) {
                        $query->where('users.is_pro_member', 1)
                            ->whereBetween('user_referrals.created_at', [$last_withdrawal_record->created_at->format('Y-m-d'),
                                DB::raw('CURDATE()')
                            ]);
                    })->count();
                if ($referralsCount < 50) {
                    $withdrawalAmount = $postData['amount'] - ($postData['amount'] * 0.10);
                }
            }

            if ($this->user->override_virtual_withdrawal_restriction) {
                if ($this->makeTransferFromVirtualToSavings($postData['amount'], $withdrawalAmount)) {
                    return true;
                } else {
                    flash()->error('Error occurred make the transfer. Please try again later. If problem persists report to the customer care');
                }
            } else {
                if (now()->diffInMonths($last_withdrawal_record->created_at) > 6 ) {
                    if ($this->makeTransferFromVirtualToSavings($postData['amount'], $withdrawalAmount)) {
                        return true;
                    } else {
                        flash()->error('Error occurred make the transfer. Please try again later. If problem persists report to the customer care');
                    }
                } else {
                    flash()->error('You can only make a transfer 6 months after your last transfer.');
                }
            }
        } else {
            flash()->error('Invalid action');
        }
        return false;
    }


    protected function getLastWithdrawal($user_id)
    {
        $last_withdrawal_record = UserVirtualWithdrawal::query()
            ->where('user_id', $user_id)
            ->latest()
            ->first();
        if($last_withdrawal_record) {
            return $last_withdrawal_record;
        } else {
            return  ProvideDonation::query()
                ->where('user_id', auth()->user()->id)
                ->orderBy('created_at', 'asc')
                ->first();
        }
    }

    protected function makeTransferFromVirtualToSavings($submitAmount, $withdrawalAmount)
    {
        try {
            DB::beginTransaction();
            $userWithdrawal = UserVirtualWithdrawal::create([
                'amount' => floatval($submitAmount),
                'user_id' => $this->user_id
            ]);
            if (!$userWithdrawal) {
                throw new \Exception('Could not created new withdrawal');
            }
            $this->virtualWallet->debit($submitAmount);
            $this->savingWallet->credit($withdrawalAmount);
            DB::commit();
            flash()->success('You have successfully transfer $'. number_format($submitAmount, 2).' from the virtual wallet to the savings wallet.');
            return true;
        } catch (\Exception $exception){
            return false;
        }
    }
}
