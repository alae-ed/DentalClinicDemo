<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function handle(Request $request)
    {
        $userMessage = $request->input('message');

        if (!$userMessage) {
            return response()->json(['error' => 'No message provided'], 400);
        }

        // إعداد الطلب إلى نموذج ذكاء اصطناعي مجاني - Mistral عبر OpenRouter
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
            'HTTP-Referer' => 'https://yourdomain.com', // غيّره إلى رابط موقعك الفعلي
            'X-Title' => 'Dentist AI Agent'
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => 'mistral/mistral-7b-instruct',
            'messages' => [
                ['role' => 'system', 'content' => 'أنت مساعد ذكي لموقع عيادة أسنان، تساعد الزوار في الإجابة عن أسئلتهم بطريقة لطيفة واحترافية.'],
                ['role' => 'user', 'content' => $userMessage],
            ],
        ]);

        if ($response->failed()) {
            return response()->json(['error' => 'AI request failed'], 500);
        }

        $aiResponse = $response->json('choices.0.message.content');

        return response()->json(['reply' => $aiResponse]);
    }
}
