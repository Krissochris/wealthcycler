<?php


namespace App\Http\Controllers;


use App\UserReferral;

class UserReferralsController extends Controller
{

    public function index()
    {
        $referrals = UserReferral::query()
            ->where('referral_user_id', auth()->user()->id)
            ->with(['referred_user'])
            ->get();

        return view('user_referrals.index')->with(compact('referrals'));
    }
}
