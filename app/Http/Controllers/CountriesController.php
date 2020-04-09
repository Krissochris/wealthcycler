<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->hasPermission('index_country');

        $countries = Country::query()
            ->orderBy('default_selection', 'desc')
            ->get();

        return view('countries.index')->with(compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->hasPermission('add_country');

        return view('countries.create');
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

        $this->validate($request, [
            'iso_3166_2' => 'required',
            'name' => 'required',
        ]);

        $country = Country::create($request->input());
        if ($country) {
            flash()->success('Country was successfully added!');
        } else {
            flash()->error('Country could not be added!');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        $this->hasPermission('edit_country');

        return view('countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $this->hasPermission('edit_country');

        $this->validate($request, [
            'iso_3166_2' => 'required',
            'name' => 'required'
        ]);

        if ($country->update($request->input())) {
            flash()->success('Country was successfully updated');
        } else {
            flash()->error('country could not be updated.');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $this->hasPermission('delete_country');

        try {
            if ($country->delete()) {
                flash()->success('Country was successfully deleted');
            } else {
                flash()->error('Country could not be deleted');
            }
        } catch (\Exception $exception) {
            flash()->error($exception->getMessage());
        }
        return back();
    }
}
