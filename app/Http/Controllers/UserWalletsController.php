<?php


namespace App\Http\Controllers;


use App\DividendWallet;
use App\User;
use App\UserSavingWallet;
use App\VirtualWallet;

class UserWalletsController extends Controller
{

    public function wallets($user_id)
    {
        $this->hasPermission('access_users_wallets');

        $savings_wallet = UserSavingWallet::with('user:id,name')
            ->where('user_id', $user_id)
            ->first();

        $virtual_wallet = VirtualWallet::with('user:id,name')
            ->where('user_id', $user_id)
            ->first();

        $dividend_wallet = DividendWallet::with('user:id,name')
            ->where('user_id', $user_id)
            ->first();

        $user = User::find($user_id);

        return view('user_wallets.index')
            ->with(compact('savings_wallet',
                'virtual_wallet', 'dividend_wallet',
                'user'));
    }
}
