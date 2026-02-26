<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmojifyService;

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

        try {
            $modifiedText = $this->emojifyService->emojify($request->text);

            return response()->json([
                'modified_text' => $modifiedText
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ошибка ИИ: ' . $e->getMessage()
            ], 500);
        }
    }
}
