<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class GeminiService {
    public function generateResponse(string $message): string{
        $apiKey = config('services.gemini.api_key');

        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent?key={$apiKey}";

        $response = Http::acceptJson()
        ->timeout(30)
        ->retry(3, 1000)
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
            throw new Exception(
                'Gemini API Error: ' . $response->body()
            );
        }

        return data_get(
            $response->json(),
            'candidates.0.content.parts.0.text',
            'Sorry, I could not generate a response.'
        );
    }
}