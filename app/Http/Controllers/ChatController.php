<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Conversation;
use App\Models\Message;
use App\Services\GeminiService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ChatController extends Controller {
    public function __construct(
        protected GeminiService $geminiService
    ) {}

    public function index(){
        $conversations = Conversation::where('user_id', Auth::id())->latest('last_message_at')->get();
        return view('Frontend.Pages.index', [
            'conversations' => $conversations,
            'conversation' => null,
        ]);
    }

    public function show(Conversation $conversation){
        abort_if($conversation->user_id !== Auth::id(), 403);

        $conversations = Conversation::where('user_id', Auth::id())->latest('last_message_at')->get();
        $conversation->load('messages');

        return view('Frontend.Pages.index', compact('conversations', 'conversation'));
    }

    public function store(MessageRequest $request){
        $validated = $request->validated();

        try{
            $conversation = DB::transaction(
                function() use ($request, $validated){
                    if($request->filled('conversation_id')){
                        $conversation = Conversation::where('id', $request->conversation_id)->where('user_id', Auth::id())->firstOrFail();
                    }
                    else{
                        $conversation = Conversation::create([
                            'user_id' => Auth::id(),
                            'title'   => Str::limit($validated['message'], 40),
                        ]);
                    }

                    // Save User Message
                    $conversation->messages()->create([
                        'role' => Message::ROLE_USER,
                        'content' => $validated['message'],
                    ]);

                    // Generate AI response
                    $reply = $this->geminiService->generateResponse($validated['message']);

                    // Save AI Message
                    $conversation->messages()->create([
                        'role' => Message::ROLE_ASSISTANT,
                        'content' => $reply,
                    ]);

                    $conversation->update(['last_message_at' => now(),]);

                    return $conversation;
                }
            );

            return redirect()->route('chat.show', $conversation)
                             ->with('success', 'Message sent successfully.');

        }
        catch(Exception $exception){
            
            Log::error('Chat message failed.', [
                'user_id' => Auth::id(),
                'message' => $request->message,
                'error'   => $exception->getMessage(),
            ]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }
}