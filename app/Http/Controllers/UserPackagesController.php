<?php

namespace App\Http\Controllers;

use App\Package;
use App\Processors\UserDepositProcessor;
use App\ProvideDonation;
use App\UserPackage;
use App\VirtualWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserPackagesController extends Controller
{
    public function index()
    {
        // check if the user has any packages
        $user_package_ids = UserPackage::query()
            ->where('user_id', auth()->user()->id)
            ->pluck('package_id')
            ->toArray();

        $user_packages = Package::query()
            ->whereIn('id', $user_package_ids)
            ->get()
            ->keyBy('id')
            ->map(function($package) {
                $package['joined'] = true;
                return $package;
            })
            ->toArray();

        $packages = $user_packages;

        $current_package = Package::find(auth()->user()->current_virtual_package_id);

        if ($current_package && $current_package['next_package_id']) {
            $system_packages = Package::query()
                ->where('id', $current_package['next_package_id'])
                ->get()
                ->keyBy('id')
                ->map(function($package) {
                    $package['joined'] = false;
                    return $package;
                })
                ->toArray();

            $packages = $user_packages + $system_packages;
        }

        return view('user_packages.index')->with(compact('packages'));
    }

    /**
     * Joining a new user package
     */
    public function joinPackage($package_id)
    {
        $user_already_in_package = UserPackage::query()
            ->where('user_id', auth()->user()->id)
            ->where('package_id', $package_id)
            ->first();

        if ($user_already_in_package) {
            flash()->error('You are already in the package!.');
            return back();
        }

        $user_virtual_wallet = VirtualWallet::query()
            ->where('user_id', auth()->user()->id)
            ->first();

        $package = Package::find($package_id);

        // get the amount difference in the package amount and the virtual amount
        // prepare payment details
        $amount = $package->amount - $user_virtual_wallet->amount;

        \request()->session()->put('payment', [
            'amount' => $amount,
            'user_id' => auth()->user()->id,
            'item_no' => UserDepositProcessor::PACKAGE_UPGRADE_DEPOSIT,
            'item_name' => 'Package Upgrade Purchase :'.$package->id,
            'currency' => 'USD',
            'quantity' => '1',
            'customer_name' => auth()->user()->name,
            'customer_email' => auth()->user()->email,
            'error_return_url' => 'user_packages:index'
        ]);

        return redirect(route('user_packages:payment'));
    }


    public function payment()
    {
        if(!Session::has('payment')) {
            flash()->error('Invalid action!');
            return redirect()->route('user_packages:index');
        }
        $payment = Session::get('payment');

        return view('user_packages.payment', compact('payment'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_type' => 'required'
        ]);

        if (!in_array($request->input('payment_type'), array_keys(config('payment_types'))) ) {
            flash()->error('Invalid payment method selected!.');
            return back();
        }
        $postData = $request->input();

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
