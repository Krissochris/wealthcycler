<?php

namespace App\Http\Controllers;

use App\Leader;
use App\State;
use App\User;
use Illuminate\Http\Request;

class LeadersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->hasPermission('index_leader');

        $leaders = Leader::query()
            ->with(['user:id,name', 'state:id,name'])
            ->get();

        return view('leaders.index', compact('leaders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->hasPermission('add_leader');

        $users = User::pluck('name', 'id');
        $states = State::pluck('name', 'id');
        return view('leaders.create', compact('users', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->hasPermission('add_leader');

        $this->validate($request, [
            'user_id' => 'required'
        ]);

        $leaderExists = Leader::query()->where('user_id', $request->get('user_id'))->first();
        if ($leaderExists) {
            flash()->error('User is already a leader');
            return back();
        }

        if (Leader::create($request->input())) {
            flash()->success('User was successfully made a leader');
        } else {
            flash()->error('User could not be made a leader. Please try again later.');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leader  $leader
     * @return \Illuminate\Http\Response
     */
    public function show(Leader $leader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leader  $leader
     * @return \Illuminate\Http\Response
     */
    public function edit(Leader $leader)
    {
        $this->hasPermission('edit_leader');

        $users = User::pluck('name', 'id');
        return view('leaders.edit', compact('leader', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leader  $leader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leader $leader)
    {
        $this->hasPermission('edit_leader');

        $this->validate($request, [
            'user_id' => 'required'
        ]);
        if ($leader->update($request->input())) {
            flash()->success('Leader record was successfully updated!');
        } else {
            flash()->error('Leader record could not be updated. Please try again later.');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leader  $leader
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leader $leader)
    {
        $this->hasPermission('delete_leader');

        try {
            if ($leader->delete()) {
                flash()->success('Leader record was successfully deleted.');
            } else {
                flash()->error('Leader record could not be deleted. Please try again later.');
            }

        } catch (\Exception $exception) {
            flash()->error($exception->getMessage());
        }
        return back();
    }
}
