<?php

namespace App\Http\Controllers;

use App\Package;
use App\Processors\CouponCodeVerifyProcessor;
use App\Processors\UserDepositProcessor;
use App\Repositories\PackageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\CoinPaymentTransaction as Transaction;

class BecomeProMemberController extends Controller
{

    protected $registration_amount;

    public function __construct()
    {
        $this->registration_amount = setting('membership_price');
    }


    public function index()
    {
        $pro_member_registration_fee = setting('membership_price');
        return view('become_pro_member.index')->with(['amount' => $pro_member_registration_fee]);

    }

    public function process_payment(Request $request)
    {
        $postData = $request->all();
        $request->session()->put('payment', [
            'amount' => $this->registration_amount,
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

    public function verifyCouponCode(Request $request)
    {
        $request->validate([
            'coupon_code'
        ]);
        $coupon_code = $request->input('coupon_code');

        if (!empty($coupon_code)) {
            $couponVerifier = new CouponCodeVerifyProcessor('https://tyenorg.com');
            $return = $couponVerifier->verify(auth()->user()->username, $coupon_code);

            if ($return === false) {
                flash()->error('An error occurred verifying your coupon code. Please try again');
            }

            if ($return) {
                $result_array = json_decode($return, true);
                if ($result_array['result'] === "ok") {

                    auth()->user()->makeProMember('coupon');
                    auth()->user()->virtual_wallet->credit(15);
                    $package = Package::where('entry_package', 1)->first();

                    if ($package) {
                        PackageRepository::subscribeUserToPackage(auth()->user()->id, $package->id);
                    }
                    flash()->success("Coupon was successfully verified");
                    return redirect()->route('home');
                } else {
                    flash()->error($result_array['message']);
                }
            }
        }
        return back();
    }
}
