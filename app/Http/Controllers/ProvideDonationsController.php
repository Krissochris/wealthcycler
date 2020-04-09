<?php

namespace App\Http\Controllers;

use App\Package;
use App\ProvideDonation;
use App\User;
use Illuminate\Http\Request;

class ProvideDonationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->hasPermission('index_provide_donation');

        $provideDonations = ProvideDonation::query()
            ->with(['user'])
            ->orderByDesc('created_at')
            ->get();
        return view('provide_donations.index')->with(compact('provideDonations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->hasPermission('add_provide_donation');

        $users = User::pluck('name', 'id');
        $packages = Package::pluck('name', 'id');

        $status = [
            ProvideDonation::ACTIVE => 'Active',
            ProvideDonation::IN_PROGRESS => 'In-Progress',
            ProvideDonation::COMPLETED => 'Completed',
            ProvideDonation::CANCELLED => 'Cancelled'
        ];

        return view('provide_donations.create')->with(compact('users', 'packages', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->hasPermission('add_provide_donation');

        $request->validate([
            'user_id' => 'required',
            'package_id' => 'required',
        ]);

        $package = Package::find($request->input('package_id'));
        $newProvideDonation = ProvideDonation::create(
            [
                'user_id' => $request->input('user_id'),
                'package_id' => $package->id,
                'amount' => $package->amount,
                'status' => $request->input('status')
            ]
        );
        if ($newProvideDonation) {
            flash()->success('Provide donation was successfully created!');
        } else {
            flash()->error('Provide donation could not be created. Please try again later.');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProvideDonation  $provideDonation
     * @return \Illuminate\Http\Response
     */
    public function show(ProvideDonation $provideDonation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProvideDonation  $provideDonation
     * @return \Illuminate\Http\Response
     */
    public function edit(ProvideDonation $provideDonation)
    {
        $this->hasPermission('edit_provide_donation');

        $users = User::pluck('name', 'id');
        $packages = Package::pluck('name', 'id');

        $status = [
            ProvideDonation::ACTIVE => 'Active',
            ProvideDonation::IN_PROGRESS => 'In-Progress',
            ProvideDonation::COMPLETED => 'Completed',
            ProvideDonation::CANCELLED => 'Cancelled'
        ];
        return view('provide_donations.edit')->with(compact('provideDonation', 'users', 'packages', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProvideDonation  $provideDonation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProvideDonation $provideDonation)
    {
        $this->hasPermission('edit_provide_donation');

        $request->validate([
            'user_id' => 'required',
            'status' => 'required',
        ]);
        if ($provideDonation->update($request->only(['user_id', 'status'])) ) {
            flash()->success('Provide donation was successfully updated!');
        } else {
            flash()->error('Provide donation could not be updated. Please try again later.');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProvideDonation  $provideDonation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProvideDonation $provideDonation)
    {
        $this->hasPermission('delete_provide_donation');

        if ($provideDonation->delete()) {
            flash()->success('Provide donation was successfully deleted!');
        } else {
            flash()->error('Provide donation could not be deleted. Please try again later.');
        }
        return back();
    }
}
