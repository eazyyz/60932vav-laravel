<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmojifyService;
use App\Models\TokenTransaction;
use App\Models\Text;

class EmojifyController extends Controller
{
    protected EmojifyService $emojifyService;

    public function __construct(EmojifyService $emojifyService)
    {
        $this->emojifyService = $emojifyService;
    }

    public function emojify(Request $request)
    {
        $request->validate([
            'text' => 'required|string'
        ]);

        $user = $request->user();
        $originalText = $request->text;
        $balance = (int)$user->tokens_balance;
        $tokensUsed = count(preg_split('/\s+/u', trim($request->text)));
        
        if ($balance < $tokensUsed) {
            return response()->json([
                'error' => "Недостаточно токенов: на счету $balance, нужно $tokensUsed вот текст\n $originalText"
            ], 403);
        }

        try {
            $modifiedText = $this->emojifyService->emojify($originalText);

            $text = Text::create([
                'user_id' => $user->id,
                'original_text' => $originalText,
                'modified_text' => $modifiedText,
                'used_tokens' => $tokensUsed
            ]);

            TokenTransaction::create([
                'user_id' => $user->id,
                'type' => 'conversion',
                'amount' => -$tokensUsed
            ]);

            $user->tokens_balance -= $tokensUsed;
            $user->save();

            return response()->json([
                'modified_text' => $modifiedText,
                'tokens_balance' => $user->tokens_balance
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ошибка ИИ: ' . $e->getMessage()
            ], 500);

        }
    }
}
