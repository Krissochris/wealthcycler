<?php


namespace App\Http\Controllers;


class BankTransferController extends Controller
{

    public function process()
    {
        return view('bank_transfer.index');
    }
}
