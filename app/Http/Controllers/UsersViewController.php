<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersViewController extends Controller
{


    public function show($username)
    {
        $user = User::query()
            ->where('username', $username)
            ->first();

        return view('users_view.show', compact('user'));
    }
}
