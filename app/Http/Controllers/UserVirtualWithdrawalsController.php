<?php

namespace App\Http\Controllers;

use App\ProvideDonation;
use App\UserVirtualWithdrawal;
use Illuminate\Http\Request;

class UserVirtualWithdrawalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userVirtualWithdrawals = UserVirtualWithdrawal::query()
            ->where('user_id', auth()->user()->id)
            ->get();
        return view('user_virtual_withdrawals.index')
            ->with(compact('userVirtualWithdrawals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user_virtual_withdrawals.create');
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
            'amount' => 'required'
        ]);
        if ($request->input('amount') > auth()->user()->virtual_wallet->virtual) {
            flash()->error('Withdrawal amount specified is greater than virtual wallet amount.');
            return back();
        }

        $currentUserId = auth()->user()->id; // reduces call to auth()->user()->id
        $last_withdrawal_record = UserVirtualWithdrawal::query()
            ->where('user_id', $currentUserId)
            ->latest()
            ->first();
        if ($last_withdrawal_record) {
            // check if the user record is greater than 6 months
            if (now()->diffInMonths($last_withdrawal_record->created_at) > 6 ) {
                $newWithdrawal = UserVirtualWithdrawal::create([
                    'amount' => $request->input('amount'),
                    'user_id' => $currentUserId
                ]);
                if ($newWithdrawal) {
                    flash()->success('You withdrawal request was successfully created!.');
                } else {
                    flash()->error('An Error occurred creating your withdrawal request. Please try again. If it persist please contact support.');
                }
            } else {
                flash()->error('You can only make a withdrawal 6 months after your last withdrawal.');
            }
        } else {
            $first_user_provide_donation = ProvideDonation::query()
                ->where('user_id', $currentUserId)
                ->orderBy('created_at', 'asc')
                ->first();
            if ($first_user_provide_donation) {

                if (now()->diffInMonths($first_user_provide_donation->created_at) > 6 ) {
                    $newWithdrawal = UserVirtualWithdrawal::create([
                        'amount' => $request->input('amount'),
                        'user_id' => $currentUserId
                    ]);
                    if ($newWithdrawal) {
                        flash()->success('You withdrawal request was successfully created!.');
                    } else {
                        flash()->error('An Error occurred creating your withdrawal request. Please try again. If it persist please contact support.');
                    }
                } else {
                    flash()->error('You can only make a withdrawal after 6 months');
                }

            } else {
                flash()->error('You can not make a withdrawal at this time. Please try again later.');
            }
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
