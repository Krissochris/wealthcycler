<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Processors\UserDepositProcessor;

class MakeDepositController extends Controller
{

    public function index()
    {
        return view('make_deposit.index');
    }

    public function processDeposit(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'payment_type' => 'required'
        ]);

        if (!in_array($request->input('payment_type'), array_keys(config('payment_types'))) ) {
            flash()->error('Invalid payment method selected!.');
            return back();
        }

        $postData = $request->all();

        $request->session()->put('payment', [
            'amount' => $postData['amount'],
            'user_id' => auth()->user()->id,
            'item_no' => UserDepositProcessor::NORMAL_DEPOSIT,
            'item_name' => 'Pro user Package Purchase',
            'currency' => 'USD',
            'quantity' => '1',
            'customer_name' => auth()->user()->name,
            'customer_email' => auth()->user()->email,
            'error_return_url' => 'make_deposit:index'
        ]);

        if ($postData['payment_type'] === 'paypal') {
            return redirect(route('payment_processor:paypal'));

        } else if ($postData['payment_type'] === 'coinpayment') {

            return redirect(route('payment_processor:coin_payment'));

        } else if ($postData['payment_type'] === 'rave_payment') {
            return redirect(route('payment_processor:rave_payment'));

        } else if ($postData['payment_type'] === 'bank_transfer') {

            return redirect(route('payment_processor:bank_transfer'));
        }

        flash()->error('Invalid payment method selected!.');
        return back();
    }
}
