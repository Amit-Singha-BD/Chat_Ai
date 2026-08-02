<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Conversation;
use App\Models\Message;
use App\Services\GeminiService;

class ChatController extends Controller
{
    public function __construct(protected GeminiService $geminiService){}

    public function view(){
        return view('Frontend.Pages.index');
    }

    public function store(MessageRequest $request){
        $validatedData = $request->validated();

        // Create a new conversation
        $conversation = Conversation::create([
            'user_id' => 1,
            'title'   => null,
        ]);

        // Save user's message
        Message::create([
            'conversation_id' => $conversation->id,
            'role'            => 'user',
            'content'         => $validatedData['message'],
        ]);

        // Send message to Gemini
        $reply = $this->geminiService->generateResponse($validatedData['message']);

        // Save AI response
        Message::create([
            'conversation_id' => $conversation->id,
            'role'            => 'assistant',
            'content'         => $reply,
        ]);

        // Update conversation
        $conversation->update([
            'last_message_at' => now(),
        ]);

        // return response()->json([
        //     'reply' => $reply,
        // ]);
    }
}