<?php

namespace App\Http\Controllers;

use App\Director;
use App\User;
use Illuminate\Http\Request;

class DirectorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directors = Director::query()
            ->with(['user:id,name'])
            ->get();
        return view('directors.index', compact('directors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck('name', 'id');
        return view('directors.create', compact('users'));
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
            'user_id' => 'required',
            'title' => 'required'
        ]);

        if ($director = Director::create($request->only(['user_id', 'title']))) {
            flash()->success('New director was successfully added!.');
            return redirect()->route('directors:index');
        } else {
            flash()->error('Director could not be added. Please try again later.');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Director  $director
     * @return \Illuminate\Http\Response
     */
    public function show(Director $director)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Director  $director
     * @return \Illuminate\Http\Response
     */
    public function edit(Director $director)
    {
        $users = User::pluck('name', 'id');
        return view('directors.edit', compact('director', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Director  $director
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Director $director)
    {
        $request->validate([
            'user_id' => 'required',
            'title' => 'required'
        ]);

        if ($director->update($request->only(['user_id', 'title']))) {
            flash()->success('Director was successfully updated.');

            return redirect()->route('directors:index');
        } else {
            flash()->error('Director could not be updated. Please try again.');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Director  $director
     * @return \Illuminate\Http\Response
     */
    public function destroy(Director $director)
    {
        try {
            if ($director->delete()) {
                flash()->success('Director was successfully deleted.');
            } else {
                flash()->error('Could not delete the director. Please try again.');
            }
        } catch (\Exception $exception) {
            flash()->error($exception->getMessage());
        }
        return back();
    }
}
