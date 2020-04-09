<?php

namespace App\Http\Controllers;

use App\State;
use App\Country;
use Illuminate\Http\Request;

class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->hasPermission('index_state');

        $states = State::query()
            ->with(['country:id,name'])->get();
        return view('states.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->hasPermission('add_country');

        $countries = Country::query()
                        ->get()
            ->map(function($row) {
                $row->main_name = $row->name. ' - '. $row->iso_3166_2;
                return $row;
            })->pluck('main_name', 'id');
        return view('states.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->hasPermission('add_country');

        $request->validate([
            'country_code' => 'required|max:2',
            'code' => 'nullable|string',
            'name' => 'required',
            'country_id' => 'required'
        ]);

        if ($newState = State::create($request->only(['country_code', 'code',
            'name', 'country_id', 'default_selection']))) {
            flash()->success('State was successfully created.');
            return redirect()->route('states:index');
        } else {
            flash()->error('State could not be created. please try again later.');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        $this->hasPermission('edit_country');

        $countries = Country::pluck('name', 'id');
        return view('states.edit', compact('countries', 'state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        $this->hasPermission('edit_country');

        $request->validate([
            'country_code' => 'required|max:2',
            'code' => 'nullable|string',
            'name' => 'required',
            'country_id' => 'required'
        ]);
        if ($state->update($request->only(['country_code', 'code',
            'name', 'country_id', 'default_selection']))) {
            flash()->success('State was successfully updated');
        } else {
            flash()->error('State could not be updated. Please try again.');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        $this->hasPermission('delete_country');

        try {
            if ($state->delete()) {
                flash()->success('State was successfully deleted.');
            } else {
                flash()->error('State could not be deleted!.');
            }
        } catch (\Exception $exception) {
            flash()->error($exception->getMessage());
        }
        return back();
    }
}
