<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class GeminiService {
    public function generateResponse(string $message): string{
        $apiKey = config('services.gemini.api_key');

        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}";

        $response = Http::withoutVerifying()
        ->withHeaders([
            'Content-Type' => 'application/json',
        ])
        ->timeout(30)
        ->post($url, [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $message,
                        ],
                    ],
                ],
            ],
        ]);

        // Check API response
        if(! $response->successful()){
            throw new Exception('Failed to get response from Gemini API.');
        }

        $data = $response->json();

        return $data['candidates'][0]['content']['parts'][0]['text']
            ?? 'Sorry, I could not generate a response.';
    }
}