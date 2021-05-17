<?php


namespace App\Http\Controllers;


use App\UserPaymentDetail;
use Illuminate\Http\Request;

class PaymentDetailsController extends Controller
{

    public function update(Request $request)
    {
        $request->validate([
            'account_name' => 'required',
            'account_number' => 'required',
            'bank_id' => 'required',
        ]);

        $userPaymentDetails = UserPaymentDetail::where('user_id', auth()->user()->id)
            ->first();

        if ($userPaymentDetails->edit_locked) {
            flash()->info('You can only edit your payment details once. Please contact support for assistance.');

        } else {
            $newData = $request->input();
            $newData['edit_locked'] = 1;

            if ($userPaymentDetails->update($newData)) {
                flash('User payment detail successfully updated!')->success();
            } else {
                flash('User payment detail successfully updated!')->error();
            }
        }

        return back();
    }
}
