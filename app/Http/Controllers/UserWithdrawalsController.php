<?php

namespace App\Http\Controllers;

use App\ProvideDonation;
use App\UserVirtualWithdrawal;
use App\UserWithdrawal;
use Illuminate\Http\Request;

class UserWithdrawalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userWithdrawals = UserWithdrawal::query()
            ->where('user_id', auth()->user()->id)
            ->get();
        return view('user_withdrawals.index')
            ->with(compact('userWithdrawals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user_withdrawals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'type' => 'required'
        ]);
        if ($request->input('amount') > auth()->user()->saving_wallet->amount ) {
            flash()->error('Withdrawal amount specified is greater than savings wallet balance.');
            return back();
        }
        $data = $request->input();
        $data['user_id'] = auth()->user()->id;

        $userWithdrawal = UserWithdrawal::create($data);
        if ($userWithdrawal) {
            flash()->success('Withdrawal request was successfully created');
        } else {
            flash()->error('Withdrawal request could not be created.');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserVirtualWithdrawal  $userVirtualWithdrawal
     * @return \Illuminate\Http\Response
     */
    public function show(UserVirtualWithdrawal $userVirtualWithdrawal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserVirtualWithdrawal  $userVirtualWithdrawal
     * @return \Illuminate\Http\Response
     */
    public function edit(UserVirtualWithdrawal $userVirtualWithdrawal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserVirtualWithdrawal  $userVirtualWithdrawal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserVirtualWithdrawal $userVirtualWithdrawal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserVirtualWithdrawal  $userVirtualWithdrawal
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserVirtualWithdrawal $userVirtualWithdrawal)
    {
        //
    }
}
