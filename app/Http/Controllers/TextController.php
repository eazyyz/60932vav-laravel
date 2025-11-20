<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Text;
use Illuminate\Http\Request;

class TextController extends Controller
{
    public function index(Request $request)
    {
        $perpage = $request->perpage ?? 2;
        return view('texts_index', [
            'texts' => Text::paginate($perpage)->withQueryString(),
        ]);
    }

    public function show($id)
    {
        return view('texts_show', [
            'text' => Text::with('user')->findOrFail($id)
        ]);
    }
    public function create()
    {
        return view('texts_create', ['users' => \App\Models\User::all()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'original_text' => 'required|string',
            'modified_text' => 'required|string',
            'used_tokens' => 'required|integer|min:0',
            'user_id' => 'required|exists:users,id',
        ]);
        $text = new Text($validated);
        $text->save();
        return redirect(to: '/texts');
    }
    public function edit(string $id)
    {
        return view('texts_edit', [
            'text' => Text::all()->where('id', $id)->first(),
            'users' => User::all()
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'original_text' => 'required|string',
            'modified_text' => 'required|string',
            'used_tokens' => 'required|integer|min:0',
            'user_id' => 'required|exists:users,id',
        ]);

        $text = Text::all()->where('id', $id)->first();
        $text->original_text = $validated['original_text'];
        $text->modified_text = $validated['modified_text'];
        $text->used_tokens = $validated['used_tokens'];
        $text->user_id = $validated['user_id'];
        $text->save();
        return redirect(to: '/texts');
    }

    public function destroy(string $id)
    {
        $text = Text::find($id);
        if (!Gate::allows('delete-text', $text)) {
            return redirect(to: '/error')->with('message', 'У вас нет разрешения на удаление текста ' . $id);
        }
        text:: destroy($id);
        return redirect(to: '/texts');
    }
}
