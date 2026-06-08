<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected $apiKey;
    protected $apiUrl = 'https://generativelanguage.googleapis.com/v1/models/gemini-1.5-flash:generateContent';

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
    }

    public function parseCommand($userMessage)
    {
        if (!$this->apiKey) {
            return "API Key is missing in your .env file.";
        }

        // Bilkul simple prompt jo direct English text reply dega
        $prompt = "You are a Smart Task Assistant. The user wants to manage their tasks.
        Respond to this message in simple English, confirming what action you are taking or giving suggestions.
        User message: " . $userMessage;

        try {
            $response = Http::post($this->apiUrl . '?key=' . $this->apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                return $result['candidates'][0]['content']['parts'][0]['text'] ?? 'Task processed.';
            }
        } catch (\Exception $e) {
            Log::error("Gemini Service Error: " . $e->getMessage());
        }

        return "I have processed your request regarding: " . $userMessage;
    }
}