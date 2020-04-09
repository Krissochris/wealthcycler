<?php


namespace App\Http\Controllers;


use App\User;

class MembersController extends Controller
{

    public function index()
    {
        $members = User::all();

        return view('members.index', compact('members'));
    }
}
