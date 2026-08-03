<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Conversation;
use App\Models\Message;
use App\Services\GeminiService;
use Exception;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller {
    public function __construct(protected GeminiService $geminiService){}

    public function view(){
        return view('Frontend.Pages.index');
    }



    public function store(MessageRequest $request){
        $validatedData = $request->validated();

        DB::beginTransaction();

        try{
            // Existing conversation or create new one
            if($request->filled('conversation_id')){
                $conversation = Conversation::where('id', $request->conversation_id)->where('user_id', auth()->id())->firstOrFail();
            }
            else{
                $conversation = Conversation::create([
                    'user_id' => auth()->id(),
                    'title'   => null,
                ]);
            }

            // Save user message
            Message::create([
                'conversation_id' => $conversation->id,
                'role'            => 'user',
                'content'         => $validatedData['message'],
            ]);

            // Generate AI response
            $reply = $this->geminiService->generateResponse($validatedData['message']);

            // Save AI response
            Message::create([
                'conversation_id' => $conversation->id,
                'role'            => 'assistant',
                'content'         => $reply,
            ]);

            // Update conversation
            $conversation->update(['last_message_at' => now(),]);

            DB::commit();

            return response()->json([
                'success'         => true,
                'conversation_id' => $conversation->id,
                'reply'           => $reply,
            ]);

        }
        catch(Exception $e){

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}