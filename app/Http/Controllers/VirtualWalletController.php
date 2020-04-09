<?php

namespace App\Http\Controllers;

use App\VirtualWallet;
use Illuminate\Http\Request;

class VirtualWalletController extends Controller
{

    public function update(Request $request, $user_id)
    {
        $this->hasPermission('access_users_wallets');

        $request->validate([
            'amount' => 'required',
            'type' => 'required'
        ]);

        $virtual_wallet = VirtualWallet::where('user_id', $user_id)
            ->first();

        $data = $request->input();
        if ($data['type'] === 'credit') {
            if ($virtual_wallet->credit($data['amount'])) {
                flash()->success($data['amount']. " was successfully credited to the wallet");
            } else {
                flash()->error($data['amount']. " could not be credited to the wallet");
            }

        } elseif ($data['type'] === 'debit') {
            if ($data['amount'] > $virtual_wallet->amount) {
                flash()->error('Amount specified is greater than the wallet balance.');
                return back();
            }
            if ($virtual_wallet->debit($data['amount'])) {
                flash()->success($data['amount']. " was successfully debited from the wallet");
            } else {
                flash()->error($data['amount']. " could not be debited from the wallet");
            }
        }
        return back();
    }
}
