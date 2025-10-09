<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Text;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users_index', ['users' => User::all()]);
    }

    public function show($id)
    {
        return view('users_show', [
            'user' => User::with('texts')->findOrFail($id)
        ]);
    }
}
