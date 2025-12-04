<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Text;
use Illuminate\Http\Request;

class TextController extends Controller
{
    public function index(Request $request)
    {
        if (!Gate::allows('view-create-text')) {
            return redirect()->back()->with('message', 'У вас нет доступа к этой странице');
        }
        $perpage = $request->perpage ?? 2;
        return view('texts_index', [
            'texts' => Text::paginate($perpage)->withQueryString(),
        ]);
    }

    public function show($id)
    {
        if (!Gate::allows('view-create-text')) {
            return redirect()->back()->with('message', 'У вас нет доступа к этой странице');
        }
        return view('texts_show', [
            'text' => Text::with('user')->findOrFail($id)
        ]);
    }
    public function create()
    {
        if (!Gate::allows('view-create-text')) {
            return redirect()->back()->with('message', 'У вас нет доступа к этой странице');
        }
        return view('texts_create', ['users' => \App\Models\User::all()]);
    }

    public function store(Request $request)
    {
        if (auth()->user()->is_admin) {
            $validated = $request->validate([
                'original_text' => 'required|string',
                'modified_text' => 'required|string',
                'used_tokens' => 'required|integer|min:0',
                'user_id' => 'required|exists:users,id',
            ]);
            $text = new Text($validated);
            $text->save();

            return redirect('/texts')->with('success', 'Текст успешно сохранён!');
        } else {
            $request->validate([
                'original_text' => 'required|string|max:5000',
            ]);

            $user = auth()->user();
            $originalText = $request->input('original_text');
            $words = preg_split('/\s+/', trim($originalText));
            $tokenCount = count($words);

            if ($user->tokens_balance < $tokenCount) {
                return redirect()->back()->withErrors(['Недостаточно токенов на балансе.']);
            }

//            $modifiedText = !empty($words) ? implode(' 👋 ', $words) . ' 👋' : '';
            $response = Http::post('http://127.0.0.1:8001/EmojifyText', [
                'text' => $originalText
            ]);

            if (!$response->successful() || empty($response->json('modified_text')))
                return redirect()->back()->withErrors(['Ошибка обработки текста']);


            $modifiedText = $response->json('modified_text');
            $wordsM = preg_split('/\s+/', trim($modifiedText));
            if (count($wordsM) > count($words))
                return redirect()->back()->withErrors(['Ошибка обработки текста']);


            $user->tokens_balance -= $tokenCount;
            $user->save();

            $text = new Text();
            $text->user_id = $user->id;
            $text->original_text = $originalText;
            $text->modified_text = $modifiedText;
            $text->used_tokens = $tokenCount;
            $text->save();

            return redirect()->back()->with([
                'success' => 'Текст успешно сохранён',
                'used_tokens' => $tokenCount,
                'original_text' => $originalText,
                'modified_text' => $modifiedText,
            ]);
        }
    }


    public function edit(string $id)
    {
        $text = Text::findOrFail($id);

        if (!Gate::allows('delete-text', $text)) {
            return redirect()->back()->with('message', 'У вас нет доступа к этой странице');
        }
        return view('texts_edit', [
            'text' => Text::all()->where('id', $id)->first(),
            'users' => User::all()
        ]);
    }

    public function update(Request $request, string $id)
    {
        $text = Text::findOrFail($id);

        if (!Gate::allows('delete-text', $text)) {
            return redirect()->back()->with('message', 'У вас нет доступа к этой странице');
        }
        {
            $validated = $request->validate([
                'original_text' => 'required|string',
                'modified_text' => 'required|string',
                'used_tokens' => 'required|integer|min:0',
                'user_id' => 'required|exists:users,id',
            ]);

            $text->original_text = $validated['original_text'];
            $text->modified_text = $validated['modified_text'];
            $text->used_tokens = $validated['used_tokens'];
            $text->user_id = $validated['user_id'];
            $text->save();
        }

        if (auth()->user()->is_admin)
            return redirect(to: '/texts');
        else
            return redirect()->back();
    }


    public function destroy(string $id)
    {
        $text = Text::findOrFail($id);
        if (!Gate::allows('delete-text', $text)) {
            return redirect()->back()->with('message', 'У вас нет доступа к удалению');
        }
        text:: destroy($id);
        if (auth()->user()->is_admin)
            return redirect(to: '/texts')->with('message', 'Текст успешно удалён');
        else
            return redirect()->back()->with('message', 'Текст успешно удалён');
    }
}
