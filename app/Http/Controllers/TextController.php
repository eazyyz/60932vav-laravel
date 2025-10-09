<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Text;
use Illuminate\Http\Request;

class TextController extends Controller
{
    public function index()
    {
        return view('texts_index', ['texts' => Text::all()]);
    }

    public function show($id)
    {
        return view('texts_show', [
            'text' => Text::with('user')->findOrFail($id)
        ]);
    }
}
