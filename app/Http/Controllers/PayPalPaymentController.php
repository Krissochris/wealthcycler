<?php

namespace App\Http\Controllers;

use App\PayPalRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use App\Processors\UserDepositProcessor;
class PayPalPaymentController extends Controller
{
    private $_api_context;

    public function __construct()
    {
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret']
        ));

        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function index()
    {
        if (!request()->session()->exists('payment')) {
            flash()->message('Invalid action');
            return back();
        }
        $payment_details = request()->session()->get('payment');

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item1 = new Item();
        $item1->setName($payment_details['item_name']);
        $item1->setCurrency($payment_details['currency']);
        $item1->setQuantity($payment_details['quantity']);
        $item1->setSku($payment_details['item_no']);
        $item1->setPrice($payment_details['amount']);

        $itemList = new ItemList();
        $itemList->setItems([$item1]);

        /** setting the amount */
        $amount = new Amount();
        $amount->setTotal($payment_details['amount']);
        $amount->setCurrency($payment_details['currency']);

        /** @var  $transaction */
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription($payment_details['item_name'])
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(URL::to(route('payment_processor:paypal:status', ['success' => 'true'])))
            ->setCancelUrl(URL::to(route('payment_processor:paypal:status', ['success' => 'false'])));

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->_api_context);
            // process the payment
        } catch (PayPalConnectionException $pay_pal_exception) {

            if (Config::get('app.debug')) {
                flash()->error($pay_pal_exception->getMessage());
                return \redirect()->route($payment_details['error_return_url']);
            } else {
                // log the error
                flash()->error('Some error occurred, sorry for the inconvenience');
                return \redirect()->route($payment_details['error_return_url']);
            }
        }
        if ($payment->getApprovalLink()) {
            // save the data to the database
            $responseData = $payment->toArray();
            PayPalRequest::create([
                'id' => $responseData['id'],
                'intent' => $responseData['intent'],
                'item_no' => $payment_details['item_no'],
                'payment_method' => $responseData['payer']['payment_method'],
                'transaction_amount' => $responseData['transactions'][0]['amount']['total'],
                'transaction_currency' => $responseData['transactions'][0]['amount']['currency'],
                'transaction_description' => $responseData['transactions'][0]['description'],
                'transaction_invoice_number' => $responseData['transactions'][0]['invoice_number'],
                'state' => $responseData['state'],
                'value_given' => 0,
                'create_time' => $responseData['create_time']
            ]);

            $redirect_url = $payment->getApprovalLink();
        }

        /** add payment ID to session */
        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }

        flash()->error('Unknown error occurred');
        return \redirect()->route($payment_details['error_return_url']);
    }


    /**
     * processes the payment
     */
    public function getPaymentStatus()
    {
        if (!empty(Input::get('success')) && Input::get('success') == 'true') {

            $payment_id = Session::get('paypal_payment_id');
            $payment_details = Session::get('payment');
            Session::forget('payment');
            Session::forget('paypal_payment_id');

            if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
                flash()->error('Payment failed');
                return \redirect()->route($payment_details['error_return_url']);
            }
            $payment = Payment::get($payment_id, $this->_api_context);
            $execution = new PaymentExecution();
            $execution->setPayerId(Input::get('PayerID'));

            $payPalRequest = PayPalRequest::find($payment_id);
            if ( (int) $payPalRequest->value_given == 1) {
                flash()->error('Payment already processed');
                return \redirect()->route($payment_details['error_return_url']);
            }

            /** Execute the payment */
            try {
                $result = $payment->execute($execution, $this->_api_context);

            } catch (PayPalConnectionException $payPalException) {
                // handle paypal connection error.
                flash()->error('Payment failed');
                return \redirect()->route($payment_details['error_return_url']);
            }

            if ($result->getState() == 'approved') {


                // craft the deposit
                $deposit = [
                    'user_id' => auth()->user()->id,
                    'amount' => $payment_details['amount'],
                    'item_no' => $payment_details['item_no'],
                    'type' => 'paypal',
                    'currency' => $payment_details['currency'],
                    'item_name' => $payment_details['item_name']
                ];
                new UserDepositProcessor($deposit);

                if ($payment_details['item_no'] === UserDepositProcessor::PRO_MEMBER_DEPOSIT) {
                    flash()->success('You have successfully become a pro member');
                }

                // updating the payment request
                $payPalRequest->update(['value_given' => 1]);

                flash()->success('Payment success');
                return redirect(route('home'));
            }

        }










        flash()->error('Payment failed');
        return redirect(route('home'));
    }
}
