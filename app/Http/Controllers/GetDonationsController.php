<?php

namespace App\Http\Controllers;

use App\GetDonation;
use App\Package;
use App\ProvideDonation;
use App\User;
use Illuminate\Http\Request;

class GetDonationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->hasPermission('index_get_donation');

        $getDonations = GetDonation::query()
            ->with(['user'])
            ->orderByDesc('created_at')
            ->get();
        return view('get_donations.index')->with(compact('getDonations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->hasPermission('add_get_donation');

        $users = User::pluck('name', 'id');
        $packages = Package::pluck('name', 'id');

        $provideDonations = ProvideDonation::pluck('id', 'id');
        $status = [
            GetDonation::ACTIVE => 'Active',
            GetDonation::IN_PROGRESS => 'In-Progress',
            GetDonation::COMPLETED => 'Completed',
            GetDonation::CANCELLED => 'Cancelled'
        ];

        return view('get_donations.create')->with(compact('users', 'packages', 'status', 'provideDonations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->hasPermission('add_get_donation');

        $request->validate([
            'user_id' => 'required',
            'package_id' => 'required',
        ]);

        $package = Package::find($request->input('package_id'));
        $newGetDonation = GetDonation::create(
            [
                'user_id' => $request->input('user_id'),
                'package_id' => $package->id,
                'amount' => $package->amount,
                'provide_donation_id' => $request->input('provide_donation_id'),
                'status' => $request->input('status')
            ]
        );
        if ($newGetDonation) {
            flash()->success('Get donation was successfully created!');
        } else {
            flash()->error('Get donation could not be created. Please try again later.');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GetDonation  $getDonation
     * @return \Illuminate\Http\Response
     */
    public function show(GetDonation $getDonation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GetDonation  $getDonation
     * @return \Illuminate\Http\Response
     */
    public function edit(GetDonation $getDonation)
    {
        $this->hasPermission('edit_get_donation');

        $users = User::pluck('name', 'id');
        $packages = Package::pluck('name', 'id');
        $provideDonations = ProvideDonation::pluck('id', 'id');

        $status = [
            GetDonation::ACTIVE => 'Active',
            GetDonation::IN_PROGRESS => 'In-Progress',
            GetDonation::COMPLETED => 'Completed',
            GetDonation::CANCELLED => 'Cancelled'
        ];
        return view('get_donations.edit')->with(compact('getDonation', 'provideDonations', 'users', 'packages', 'status'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GetDonation  $getDonation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GetDonation $getDonation)
    {
        $this->hasPermission('edit_get_donation');

        $request->validate([
            'user_id' => 'required',
            'status' => 'required',
            'provide_donation_id' => 'required',
        ]);
        if ($getDonation->update($request->only(['user_id', 'status', 'provide_donation_id'])) ) {
            flash()->success('Get donation was successfully updated!');
        } else {
            flash()->error('Get donation could not be updated. Please try again later.');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GetDonation  $getDonation
     * @return \Illuminate\Http\Response
     */
    public function destroy(GetDonation $getDonation)
    {
        $this->hasPermission('delete_get_donation');

        if ($getDonation->delete()) {
            flash()->success('Get donation was successfully deleted!');
        } else {
            flash()->error('Get donation could not be deleted. Please try again later.');
        }
        return back();
    }
}
