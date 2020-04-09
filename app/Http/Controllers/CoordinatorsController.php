<?php

namespace App\Http\Controllers;

use App\Coordinator;
use App\Director;
use App\Leader;
use App\State;
use App\User;
use Illuminate\Http\Request;

class CoordinatorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coordinators = Coordinator::query()
            ->with(['user', 'state','director.user'])
            ->get();

        return view('coordinators.index', compact('coordinators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck('name', 'id');
        $states = State::pluck('name', 'id');
        $directors = Director::pluck('title', 'id');
        return view('coordinators.create', compact('users', 'states', 'directors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'state_id' => 'required',
            'director_id' => 'required'
        ]);
        /*if ( $coordinator = Coordinator::query()->where('user_id', $request->get('user_id'))->first()) {
            flash()->error('User is already a coordinator');
            return back();
        }*/
        if (Coordinator::create($request->only(['user_id', 'state_id', 'director_id']))) {
            flash()->success('User was successfully added as a coordinator');
        } else {
            flash()->error('User could not be made a coordinator. Please try again later.');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coordinator  $coordinator
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coordinator = Coordinator::with(['user:id,name', 'state:id,name'])
            ->find($id);
        $leaders = Leader::query()
            ->with(['user:id,name'])
            ->where('state_id', $coordinator->state_id)
            ->get();

        return view('coordinators.show', compact('coordinator', 'leaders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coordinator  $coordinator
     * @return \Illuminate\Http\Response
     */
    public function edit(Coordinator $coordinator)
    {
        $users = User::pluck('name', 'id');
        $states = State::pluck('name', 'id');
        $directors = Director::pluck('title', 'id');
        return view('coordinators.edit', compact('users', 'states', 'coordinator', 'directors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coordinator  $coordinator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coordinator $coordinator)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'state_id' => 'required',
            'director_id' => 'required'
        ]);

        if ($coordinator->update($request->only(['user_id', 'state_id', 'director_id']))) {
            flash()->success('Coordinator was successfully updated');
        } else {
            flash()->error('Coordinator could not be updated. Please try again later.');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coordinator  $coordinator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coordinator $coordinator)
    {
        try {
            if ($coordinator->delete()) {
                flash()->success('Coordinator was successfully deleted.');
            } else {
                flash()->error('coordinator could not be deleted. Please try again later.');
            }
        } catch (\Exception $exception) {
            flash()->error($exception->getMessage());
        }
        return back();
    }
}
