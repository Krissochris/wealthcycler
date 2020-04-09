<?php


namespace App\Http\Controllers;


use App\Bank;
use App\Country;
use App\State;
use App\User;
use App\UserPaymentDetail;

class ProfileController
{

    public function edit()
    {
        $user = User::find(auth()->user()->id);
        $states = State::pluck('name', 'id');
        $countries = Country::pluck('name', 'id');

        $banks = Bank::pluck('name', 'id');
        $userPaymentDetails = UserPaymentDetail::where('user_id', $user->id)->first();

        return view('profile.edit', compact('user', 'states', 'countries', 'banks', 'userPaymentDetails'));
    }

    public function update()
    {

        $user = User::find(auth()->user()->id);

        if ($user->update(request()->only(['name', 'phone_number', 'city', 'country_id', 'state_id']))) {
            flash()->success('Profile was successfully updated');
        } else {
            flash()->error('Profile could not be updated');
        }
        return back();
    }
}
