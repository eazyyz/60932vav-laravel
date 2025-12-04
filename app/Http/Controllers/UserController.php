<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        if (!Gate::allows('view-users')) {
            return redirect()->back()->with('message', 'У вас нет доступа к списку пользователей');
        }
        return view('users_index', ['users' => User::all()]);
    }

    public function show($id)
    {
        if (!Gate::allows('view-user', $id)) {
            return redirect()->back()->with('message', 'У вас нет доступа к этому пользователю');
        }
        return view('users_show', [
            'user' => User::with('texts')->findOrFail($id)
        ]);
    }
}
