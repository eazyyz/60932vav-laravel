<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class EmojifyService
{
    protected string $apiKey;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = config('services.openrouter.api_key');
        $this->model = config('services.openrouter.model');
    }

    public function emojify(string $text): string
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'HTTP-Referer' => config('app.url', 'http://localhost'),
            'X-Title' => 'Emoji Service',
            'Content-Type' => 'application/json',
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => $this->model,
            'temperature' => 0.3,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Ты — помощник, который добавляет эмодзи после каждого слова в тексте.'
                ],
                [
                    'role' => 'user',
                    'content' => "Тебе нужно вывести полный текст с эмодзи по смыслу после каждого слова (включая предлоги и союзы). Смайлы ставятся сразу после слова без пробела.\n\n{$text}"
                ]
            ]
        ]);

        if ($response->failed()) {
            throw new \Exception($response->body());
        }

        return $response['choices'][0]['message']['content'] ?? '';
    }
}
