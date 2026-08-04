<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Conversation;
use App\Models\Message;
use App\Services\GeminiService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ChatController extends Controller {
    public function __construct(protected GeminiService $geminiService){}

    public function view(){
        $conversations = Conversation::where('user_id', 1)->latest('last_message_at')->get();
        return view('Frontend.Pages.index', [
            'conversations' => $conversations,
            'conversation' => null,
        ]);
    }

    public function show(Conversation $conversation){
        abort_if($conversation->user_id != 1, 403);
        $conversations = Conversation::where('user_id', 1)->latest('last_message_at')->get();
        $conversation->load('messages');

        return view('Frontend.Pages.index', compact('conversations', 'conversation'));
    }


    public function store(MessageRequest $request){
        $validatedData = $request->validated();

        DB::beginTransaction();

        try{
            // Existing conversation or create new one
            if($request->filled('conversation_id')){
                $conversation = Conversation::where('id', $request->conversation_id)->where('user_id', 1)->firstOrFail();
            }
            else{
                $conversation = Conversation::create([
                    'user_id' => 1,
                    'title'   => Str::limit($validatedData['message'], 40),
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

            return redirect()->route('show', $conversation->id);

        }
        catch(Exception $e){

            DB::rollBack();

            return redirect()->route('show', $conversation->id);
        }
    }
}