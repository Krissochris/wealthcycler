<?php

namespace App\Http\Controllers;

use App\UserPaymentDetail;
use App\UserSavingWallet;
use App\UserWithdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WithdrawalsController extends Controller
{

    public function index()
    {
        $withdrawals = UserWithdrawal::query()
            ->with('user')
            ->latest()
            ->orderBy('status')
            ->get();



        return view('withdrawals.index', compact('withdrawals'));
    }

    public function edit(UserWithdrawal $withdrawal)
    {
        return view('withdrawals.edit', compact('withdrawal'));
    }


    public function update(Request $request, UserWithdrawal $withdrawal)
    {
        $request->validate([
            'status' => 'required'
        ]);

        if ($withdrawal->update($request->input())) {
            flash()->success('Withdrawal request was successfully updated');
        } else {
            flash()->error('Withdrawal request could not be updated.');
        }
        return back();
    }

    public function show(UserWithdrawal $withdrawal)
    {
        // get the user payment details
        $userPaymentDetail = UserPaymentDetail::query()
            ->has('bank')
            ->with('bank')
            ->where('user_id', $withdrawal->user_id)->first();

        return view('withdrawals.show', compact('withdrawal', 'userPaymentDetail'));
    }

    public function paid(UserWithdrawal $withdrawal)
    {
        // get the user saving wallet
        $saving_wallet = UserSavingWallet::where('user_id', $withdrawal->user_id)->first();
        if (!$saving_wallet) {
            flash()->error('error occurred completing the user withdrawal. The user does not have a savings wallet.');
            return back();
        }

        if ($saving_wallet->amount < $withdrawal->amount) {
            flash()->error('Savings wallet amount is less than withdrawal amount');
            return back();
        }

        try {
            DB::beginTransaction();
            throw_if(!$saving_wallet->debit($withdrawal->amount), '\Exception', ['message' => 'User savings wallet could not be debited']);
            $withdrawalUpdated = $withdrawal->update(['status' => 2]);

            throw_if(!$withdrawalUpdated, '\Exception', ['message' => 'Withdrawal could not be updated']);
            DB::commit();
            flash()->success('Withdrawal was successfully completed');
        } catch (\Exception $exception) {
            DB::rollBack();
            flash()->error('Withdrawal could not be successfully completed :' .$exception->getMessage());
        }
        return back();
    }
}
