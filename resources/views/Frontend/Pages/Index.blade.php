@extends('Frontend.Layout.MasterLayout')
@section('Content')
    <section class="chat-thread" id="chatThread" aria-live="polite" aria-label="Conversation messages">
        <div class="chat-thread-inner">

            <!-- Date Divider -->
            <div class="date-divider"><span>Today</span></div>
            @if ($conversation)
                @foreach ($conversation->messages as $message)
                    @if ($message->role == 'user')
                        <article class="message message-user">
                            <div class="message-body">
                                <div class="message-meta message-meta-right">
                                    <span class="message-time">{{ $message->created_at->format('g:i A') }}</span>
                                    <span class="message-author">You</span>
                                </div>
                                <div class="message-bubble">
                                    <p>{{ $message->content }}</p>
                                </div>
                            </div>
                            <span class="avatar avatar-md avatar-user">
                                <img src="https://i.pravatar.cc/64?img=13" alt="Amelia Hart">
                            </span>
                        </article>
                    @else
                        <article class="message message-ai">
                            <span class="avatar avatar-md avatar-ai" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 2L14.5 9.5L22 12L14.5 14.5L12 22L9.5 14.5L2 12L9.5 9.5L12 2Z" fill="white" />
                                </svg>
                            </span>
                            <div class="message-body">
                                <div class="message-meta">
                                    <span class="message-author">Chat Ai</span>
                                    <span class="message-time">{{ $message->created_at->format('g:i A') }}</span>
                                </div>
                                <div class="message-bubble">
                                    <p>{{ $message->content }}</p>
                                </div>
                                <div class="message-actions">
                                    <button class="msg-action-btn" type="button" aria-label="Copy message" data-bs-toggle="tooltip"
                                        title="Copy"><i class="bi bi-copy"></i></button>
                                    <button class="msg-action-btn" type="button" aria-label="Good response" data-bs-toggle="tooltip"
                                        title="Good response"><i class="bi bi-hand-thumbs-up"></i></button>
                                    <button class="msg-action-btn" type="button" aria-label="Poor response" data-bs-toggle="tooltip"
                                        title="Poor response"><i class="bi bi-hand-thumbs-down"></i></button>
                                    <button class="msg-action-btn" type="button" aria-label="Regenerate response"
                                        data-bs-toggle="tooltip" title="Regenerate"><i class="bi bi-arrow-repeat"></i></button>
                                </div>
                            </div>
                        </article>
                    @endif
                @endforeach
            @endif
            <!-- user Message  -->
            

            <!-- Typing Indicator (visual only, hidden by default) -->
            <article class="message message-ai typing-message d-none" id="typingIndicator">
                <span class="avatar avatar-md avatar-ai" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M12 2L14.5 9.5L22 12L14.5 14.5L12 22L9.5 14.5L2 12L9.5 9.5L12 2Z" fill="white" />
                    </svg>
                </span>
                <div class="message-body">
                    <div class="message-bubble typing-bubble">
                        <span class="typing-dot"></span>
                        <span class="typing-dot"></span>
                        <span class="typing-dot"></span>
                    </div>
                </div>
            </article>

            <!-- Skeleton Loading (visual only, hidden by default) -->
            <div class="skeleton-message d-none" id="skeletonMessage">
                <div class="skeleton-avatar"></div>
                <div class="skeleton-lines">
                    <div class="skeleton-line w-75"></div>
                    <div class="skeleton-line w-100"></div>
                    <div class="skeleton-line w-50"></div>
                </div>
            </div>

        </div>
    </section>

    <!-- ============================= -->
    <!-- EMPTY STATE (toggle via JS)    -->
    <!-- ============================= -->
    <section class="empty-state d-none" id="emptyState" aria-label="Start a new conversation">
        <div class="empty-state-inner">
            <div class="empty-illustration" aria-hidden="true">
                <svg width="72" height="72" viewBox="0 0 24 24" fill="none">
                    <path d="M12 2L14.5 9.5L22 12L14.5 14.5L12 22L9.5 14.5L2 12L9.5 9.5L12 2Z" fill="url(#emptyGrad)" />
                    <defs>
                        <linearGradient id="emptyGrad" x1="2" y1="2" x2="22" y2="22"
                            gradientUnits="userSpaceOnUse">
                            <stop stop-color="#2563EB" />
                            <stop offset="1" stop-color="#7C3AED" />
                        </linearGradient>
                    </defs>
                </svg>
            </div>
            <h2 class="empty-heading">What can I help with today?</h2>
            <p class="empty-subtitle">Ask a question, brainstorm an idea, or paste something you're working on.</p>

            <div class="suggestion-grid">
                <button class="suggestion-card" type="button">
                    <i class="bi bi-lightbulb"></i>
                    <span class="suggestion-title">Brainstorm ideas</span>
                    <span class="suggestion-desc">for a product launch campaign</span>
                </button>
                <button class="suggestion-card" type="button">
                    <i class="bi bi-file-earmark-text"></i>
                    <span class="suggestion-title">Summarize a document</span>
                    <span class="suggestion-desc">and pull out key action items</span>
                </button>
                <button class="suggestion-card" type="button">
                    <i class="bi bi-code-slash"></i>
                    <span class="suggestion-title">Debug my code</span>
                    <span class="suggestion-desc">and explain what went wrong</span>
                </button>
                <button class="suggestion-card" type="button">
                    <i class="bi bi-graph-up-arrow"></i>
                    <span class="suggestion-title">Analyze this data</span>
                    <span class="suggestion-desc">and highlight the key trends</span>
                </button>
            </div>
        </div>
    </section>

    <!-- ============================= -->
    <!-- MESSAGE INPUT (sticky)         -->
    <!-- ============================= -->
    <footer class="chat-input-area">
        <form class="chat-input-form" id="chatInputForm" action="{{ route('chat.store') }}" method="POST">
            @csrf
            <input type="hidden" name="conversation_id" id="conversation_id" value="{{ $conversation->id ?? '' }}">
            <div class="chat-input-wrapper" id="chatInputWrapper">

                <label for="chatTextarea" class="visually-hidden">Message</label>
                <textarea id="chatTextarea" name="message" class="chat-textarea" placeholder="Ask anything..." rows="1" aria-label="Type your message"></textarea>

                <button type="submit" name="submit" class="send-btn" id="sendBtn" aria-label="Send message" disabled>
                    <i class="bi bi-arrow-up" aria-hidden="true"></i>
                </button>
            </div>
        </form>
        <p class="input-disclaimer">Chat AI can make mistakes. Please verify important information.</p>
    </footer>
@endsection
