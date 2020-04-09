<?php

namespace App\Http\Controllers\Auth;

use App\Country;
use App\State;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'username' => 'required|unique:users',
            'phone_number' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        // get the default state is state is empty
        if (empty($data['state_id'])) {
            $default_state_id = State::where('default_selection', 1)->pluck('id')->first();
            if ($default_state_id) {
                $data['state_id'] = $default_state_id;
            }
        }
        // get the default country if country is empty
        if (empty($data['country_id'])) {
            $default_country_id = Country::where('default_selection', 1)->pluck('id')->first();
            if ($default_country_id) {
                $data['country_id'] = $default_country_id;
            }
        }


        return User::create($data);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $states = DB::table('states')->pluck('name', 'id')->prepend('-- Select State --', '');
        $countries = DB::table('countries')->pluck('name', 'id')->prepend('-- Select Country --', '');
        $leaders = DB::table('leaders')->join('users', 'users.id', '=', 'leaders.user_id')
            ->select('leaders.*', 'users.name')
            ->pluck('users.name', 'user_id')->prepend('--Select Leader --', '');
        return view('auth.register')->with(compact('states', 'countries', 'leaders'));
    }
}
