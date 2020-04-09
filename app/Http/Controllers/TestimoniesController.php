<?php

namespace App\Http\Controllers;

use App\Testimony;
use App\User;
use Illuminate\Http\Request;

class TestimoniesController extends Controller
{

    public function index()
    {
        $this->hasPermission('index_testimony');

        $testimonies = Testimony::query()
            ->with(['user:id,name'])
            ->latest()
            ->get();

        return view('testimonies.index', compact('testimonies'));
    }



    public function create()
    {
        $this->hasPermission('add_testimony');

        $users = User::pluck('name', 'id');

        return view('testimonies.create', compact('users'));
    }


    public function store(Request $request)
    {
        $this->hasPermission('add_testimony');

        $request->validate([
            'user_id' => 'required',
            'testimony' => 'required',
            'status' => 'required',
        ]);

        $testimony = Testimony::create($request->input());
        if ($testimony) {
            flash()->success('Testimony was successfully added');
        } else {
            flash()->error('Testimony could not be added');
        }
        return redirect()->route('testimonies:index');

    }


    public function edit(Testimony $testimony)
    {
        $this->hasPermission('edit_testimony');

        $users = User::pluck('name', 'id');

        return view('testimonies.edit', compact('users', 'testimony'));
    }



    public function update(Request $request, Testimony $testimony)
    {
        $this->hasPermission('edit_testimony');

        $request->validate([
            'user_id' => 'required',
            'testimony' => 'required',
            'status' => 'required',
        ]);

        if ($testimony->update($request->input())) {
            flash()->success('Testimony was successfully added');
        } else {
            flash()->error('Testimony could not be added');
        }
        return redirect()->route('testimonies:index');
    }


}
