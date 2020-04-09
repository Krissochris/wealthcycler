<?php

namespace App\Http\Controllers;

use App\UserSavingWallet;
use App\VirtualWallet;
use Illuminate\Http\Request;

class SavingsWalletController extends Controller
{

    public function edit($user_id)
    {
        $this->hasPermission('access_users_wallets');

        $savings_wallet = UserSavingWallet::with('user:id,name')
        ->where('user_id', $user_id)
            ->first();

        $virtual_wallet = VirtualWallet::with('user:id,name')
            ->where('user_id', $user_id)
            ->first();

        return view('savings_wallet.edit',
            compact('savings_wallet', 'virtual_wallet'));
    }


    public function update(Request $request, $user_id)
    {
        $this->hasPermission('access_users_wallets');

        $request->validate([
            'amount' => 'required',
            'type' => 'required'
        ]);

        $savings_wallet = UserSavingWallet::where('user_id', $user_id)
            ->first();

        $data = $request->input();
        if ($data['type'] === 'credit') {
            if ($savings_wallet->credit($data['amount'])) {
                flash()->success($data['amount']. " was successfully credited to the wallet");
            } else {
                flash()->error($data['amount']. " could not be credited to the wallet");
            }

        } elseif ($data['type'] === 'debit') {
            if ($data['amount'] > $savings_wallet->amount) {
                flash()->error('Amount specified is greater than the wallet balance.');
                return back();
            }
            if ($savings_wallet->debit($data['amount'])) {
                flash()->success($data['amount']. " was successfully debited from the wallet");
            } else {
                flash()->error($data['amount']. " could not be debited from the wallet");
            }
        }
        return back();
    }
}
