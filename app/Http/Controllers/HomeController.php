<?php

namespace App\Http\Controllers;

use App\User;
use App\UserSavingWalletTransaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::query()
            ->with([
                'saving_wallet',
                'virtual_wallet',
                'debit_wallet'])
            ->where('id', auth()->user()->id)
            ->first();

        $savingsWalletTransactions = UserSavingWalletTransaction::where('user_saving_wallet_id', $user->saving_wallet->id)
            ->latest()
            ->get();
        return view('home')->with(compact('user', 'savingsWalletTransactions'));
    }
}
