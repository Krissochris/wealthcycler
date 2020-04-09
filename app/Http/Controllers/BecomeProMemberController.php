<?php

namespace App\Http\Controllers;

use App\Processors\UserDepositProcessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\CoinPaymentTransaction as Transaction;

class BecomeProMemberController extends Controller
{
    CONST REGISTRATION_AMOUNT = 30;

    public function index()
    {
        $pro_member_registration_fee = static::REGISTRATION_AMOUNT;
        return view('become_pro_member.index')->with(['amount' => $pro_member_registration_fee]);

    }

    public function process_payment(Request $request)
    {
        $postData = $request->all();
        $request->session()->put('payment', [
            'amount' => static::REGISTRATION_AMOUNT,
            'user_id' => auth()->user()->id,
            'item_no' => UserDepositProcessor::PRO_MEMBER_DEPOSIT,
            'item_name' => 'Pro user Package Purchase',
            'currency' => 'USD',
            'quantity' => '1',
            'customer_name' => auth()->user()->name,
            'customer_email' => auth()->user()->email,
            'error_return_url' => 'become_pro_member'
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
