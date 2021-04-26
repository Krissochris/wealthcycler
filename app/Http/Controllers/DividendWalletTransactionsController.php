<?php


namespace App\Http\Controllers;


use App\DividendWalletTransaction;

class DividendWalletTransactionsController extends Controller
{

    public function index()
    {
        $transactions = DividendWalletTransaction::all();

        return view('dividend_wallet_transactions.index')
            ->with(compact('transactions'));
    }
}
