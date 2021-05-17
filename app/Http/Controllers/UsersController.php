<?php

namespace App\Http\Controllers;

use App\Coordinator;
use App\Country;
use App\Director;
use App\GetDonation;
use App\Leader;
use App\Package;
use App\ProvideDonation;
use App\Repositories\PackageRepository;
use App\State;
use App\User;
use App\Role;
use App\UserDebitWallet;
use App\UserPackage;
use App\UserReferral;
use App\UserSavingWallet;
use App\UserSavingWalletTransaction;
use App\VirtualWallet;
use App\VirtualWalletTransaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $this->hasPermission('index_user');

        $users = User::query()
            ->with(['virtual_wallet', 'saving_wallet', 'dividend_wallet'])
            ->get();

        return view('users.index')->with(compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->hasPermission('add_user');

        $states = State::pluck('name', 'id');
        $countries = Country::pluck('name', 'id');

        return view('users.create')->with(compact('states', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->hasPermission('add_user');

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'phone_number' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $data = $request->input();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        if ($user) {
            flash()->success('user was successfully created');
        } else {
            flash()->error('user was not created');
        }

        return redirect()->route('users:edit', $user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->hasPermission('show_user');

        $director = Director::where('user_id', $user->id)->first();
        $coordinator = Coordinator::with('state:id,name')->where('user_id', $user->id)->first();
        $leader = Leader::with('state:id,name')->where('user_id', $user->id)->first();

        $referrals = UserReferral::where('referral_user_id', $user->id)
            ->get();


        $saving_wallet = UserSavingWallet::query()
            ->where('user_id', $user->id)
            ->first();

        $virtual_wallet = VirtualWallet::query()
            ->where('user_id', $user->id)
            ->first();

        $debit_wallet = UserDebitWallet::query()
            ->where('user_id', $user->id)
            ->first();

        $userPackages = UserPackage::query()
            ->where('user_id', $user->id)
            ->with(['package'])
            ->get();

        $getDonations = GetDonation::query()
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $provideDonations = ProvideDonation::query()
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $savingWalletTransactions = UserSavingWalletTransaction::query()
            ->where('user_saving_wallet_id', $saving_wallet->id)
            ->latest()->get();

        $virtualWalletTransactions = VirtualWalletTransaction::query()
            ->where('virtual_wallet_id', $virtual_wallet->id)
            ->latest()
            ->get();

        return view('users.view', compact('user',
            'userPackages', 'saving_wallet', 'virtual_wallet', 'debit_wallet',
        'getDonations', 'provideDonations', 'savingWalletTransactions', 'virtualWalletTransactions',
        'director', 'coordinator', 'leader', 'referrals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->hasPermission('edit_user');

        $states = State::pluck('name', 'id');
        $countries = Country::pluck('name', 'id');
        $userStatus = User::status;
        $roles = Role::pluck('name', 'id');
        $packages = Package::pluck('name', 'id')->prepend('--Select Current Package-- ', '');

        $permissions = config('permissions');

        $rolePermissions = $user->getAllPermissions()->pluck('name')->toArray();

        $userRoles = $user->roles()->pluck('id');
        return view('users.edit')->with(compact('states',
            'countries', 'user', 'userStatus', 'roles', 'userRoles',
            'packages', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->hasPermission('edit_user');

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'phone_number' => 'required'
        ]);

        $user->fill($request->only([
            'name', 'email', 'username',
            'phone_number', 'city', 'state_id', 'country_id',
            'status', 'current_virtual_package_id',
            'override_virtual_withdrawal_restriction',
            'override_referral_limit_in_virtual_transfer',
            'pro_member_through'
        ]));

        if ((int) $request->input('is_pro_member') !== 1) {
            $user->forceFill(['is_pro_member' => 0]);
        }


        if ((int) $request->input('email_verified_at') === 1) {
            $user->forceFill(['email_verified_at' => new Carbon()]);
        } else {
            $user->forceFill(['email_verified_at' => null]);
        }

        if ($user->update()) {
            if ((int) $request->input('is_pro_member') === 1) {
                $user->makeProMember($request->input('pro_member_through'));
            }

            $user->syncRoles($request->input('roles'));
            $user->syncPermissions($request->input('permissions'));

            flash()->success('User was successfully updated!');
        } else {
            flash()->success('User could not be updated. Please try again later.');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->hasPermission('delete_user');

        if ($user->is_pro_member()) {
            flash()->error('Please block the user ');
            return back();
        }
        if ($user->delete()) {
            flash()->success('User was successfully deleted!');
        } else {
            flash()->error('User could not be deleted');
        }
        return back();
    }

    public function subscribeToPackage(Request $request)
    {
        $this->hasPermission('subscribe_user_to_package');

        $request->validate([
            'user_id' => 'required',
            'package_id' => 'required'
        ]);
        $data = $request->input();

        $subscribed = PackageRepository::subscribeUserToPackage($data['user_id'], $data['package_id']);
        if ($subscribed) {
            flash()->success('Yes was successfully subscribed to the package');
        } else {
            flash()->error('User could not be subscribed to the package');
        }
        return back();
    }

    public function updatePermissions(Request $request, User $user)
    {
        if ($user->syncPermissions($request->input('permissions')))
        {
        $user->syncRoles($request->input('roles'));
        $user->syncPermissions($request->input('permissions'));

        flash()->success('User permissions was successfully updated!');
        } else {
            flash()->success('User permissions could not be updated. Please try again later.');
        }
        return back();
    }
}
