<?php

namespace App\Http\Controllers;

use App\Processors\UserDepositProcessor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class RavePaymentController extends Controller
{

    protected $_publicKey;

    protected $_secretKey;

    protected $userPaymentRepository;

    public function __construct()
    {
        $config = config('rave_payment');

        $this->_publicKey = $config['public_key'];

        $this->_secretKey = $config['secret_key'];
    }


    public function process()
    {
        if (!request()->session()->exists('payment')) {

            session()->flash('error','Invalid action');

            return redirect()->route('home');
        }
        $payment_details = request()->session()->get('payment');

        $postData = [
            'amount'=>$payment_details['amount'],
            'customer_email'=>$payment_details['customer_email'],
            'customer_name'=>$payment_details['customer_name'],
            'currency'=> $payment_details['currency'],
            'txref'=> uniqid(),
            'PBFPubKey'=> $this->_publicKey,
            'redirect_url'=>route('payment_processor:rave_payment:status'),
            'custom_logo' => asset('assets/images/logo.png')
        ];


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($postData),
            CURLOPT_HTTPHEADER => [
                "content-type: application/json",
                "cache-control: no-cache"
            ],
        ));

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        if($err){
            // there was an error contacting the rave API
            flash()->error('Payment failed');
            return redirect()->route($payment_details['error_return_url']);
        }

        $transaction = json_decode($response);

        if(!$transaction->data && !$transaction->data->link){
            // there was an error from the API
            flash()->error('Payment failed');
            return redirect()->route($payment_details['error_return_url']);
        }

        return redirect($transaction->data->link);
    }


    /**
     * The payment status page
     */
    public function getPaymentStatus()
    {
        $payment_details = request()->session()->get('payment');
        Session::forget('payment');

        $txref = request()->get('txref');
        if (isset($txref) && !empty($txref)) {

            $isCancelled = request()->get('cancelled');
            if ($isCancelled) {
                flash( 'Payment could not be completed because it was cancelled by the user.')->error();
            } else {

                $resp = json_decode(request()->input('resp'), true);

                $amount = $payment_details["amount"];
                $currency = $payment_details["currency"];

                $paymentStatus = $resp['data']['data']['status'];
                $chargeResponsecode = $resp['tx']['chargeResponseCode'];
                $chargeAmount = $resp['tx']['amount'];
                $chargeCurrency = $resp['tx']['currency'];

                // save the transaction in the database

                if ( ($paymentStatus == 'successful') && ($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {

                    //record the payment detail
                    // craft the deposit
                    $deposit = [
                        'user_id' => auth()->user()->id,
                        'amount' => $payment_details['amount'],
                        'item_no' => $payment_details['item_no'],
                        'type' => 'rave_pay',
                        'currency' => $payment_details['currency'],
                        'item_name' => $payment_details['item_name']
                    ];
                    new UserDepositProcessor($deposit);

                    if ($payment_details['item_no'] === UserDepositProcessor::PRO_MEMBER_DEPOSIT) {
                        flash()->success('You have successfully become a pro member');
                    }
                    flash()->success('Payment success');
                    return redirect()->route('home');
                    // transaction was successful...
                    // please check other things like whether you already gave value for this ref
                    // if the email matches the customer who owns the product etc
                    //Give Value and return to Success page
                } else {
                    //Dont Give Value and return to Failure page
                    flash('Payment failed')->error();
                }
            }
        }
        else {
            flash('Payment failed')->error();
        }
        return redirect()->route('home');
    }
}
