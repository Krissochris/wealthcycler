<?php


namespace App\Http\Controllers;


use App\User;

class UpdateEmailAddressController extends Controller
{

    public function update()
    {
        $this->validate(request(), [
            'email' => 'required|unique:users'
        ]);

        $user = User::find(auth()->user()->id);

        if ($user) {
            $user->fill([
                'email' => request()->input('email')
            ]);
            if ($user->update()) {
                flash()->success('Your email address was successfully updated.');
            } else {
                flash()->error('Your email address change was not successfully. Please try again.');
            }
        }
        return back();
    }
}
