<?php

namespace App\Http\Controllers;

use App\CoinPaymentTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Kevupton\LaravelCoinpayments\Exceptions\CoinPaymentsResponseError;

class CoinPaymentController extends Controller
{
    public function index()
    {
        if (!request()->session()->has('payment')) {
            flash()->error('Invalid Action');
            return redirect(route('home'));
        }
        $payment_details = Session::get('payment');
        $req = null;
        $req['amount'] = $payment_details['amount'];
        $req['currency1'] = 'USD';
        $req['currency2'] = 'btc';
        $req['buyer_email'] = auth()->user()->email;
        $req['buyer_name'] = auth()->user()->id;
        $req['item_number'] = $payment_details['item_no'];
        $req['ipn_url'] = url('/api/ipn');
        try {
            $transaction = \Coinpayments::createTransactionSimple($req['amount'], $req['currency1'], $req['currency2'], $req);
            if ($transaction) {
                // record deposit request // continue
                // return redirect to make deposit
                return redirect(route('payment_processor:coin_payment:make_deposit', $transaction->id));
            } else {
                flash("Could not proceed with your request. Please try again...")->error();
                return back();
            }
        } catch (CoinPaymentsResponseError $exception) {
            flash("An Error Occurred processing your request. Please try again...")->error();
            return back();
        }
    }

    public function makeDeposit(CoinPaymentTransaction $transaction)
    {
        return view('coin_payments.make_deposit')->with(compact('transaction'));
    }

    public function confirmDeposit()
    {
        flash()->success('We will notify you when your payment is successfully received.');
        return redirect(route('home'));
    }

    public function getPaymentStatus()
    {

    }
}
