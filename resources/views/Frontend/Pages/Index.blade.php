@extends('Frontend.Layout.MasterLayout')
@section('Content')
    <section class="chat-thread" id="chatThread" aria-live="polite" aria-label="Conversation messages">
        <div class="chat-thread-inner">

            <!-- Date Divider -->
            <div class="date-divider"><span>Today</span></div>

            <!-- AI Message -->
            <article class="message message-ai">
                <span class="avatar avatar-md avatar-ai" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M12 2L14.5 9.5L22 12L14.5 14.5L12 22L9.5 14.5L2 12L9.5 9.5L12 2Z" fill="white" />
                    </svg>
                </span>
                <div class="message-body">
                    <div class="message-meta">
                        <span class="message-author">Aurea</span>
                        <span class="message-time">9:41 AM</span>
                    </div>
                    <div class="message-bubble">
                        <p>Good morning, Amelia. Here's a structure you could use for the Q3 roadmap narrative — happy to
                            adjust the emphasis once you tell me which stakeholders are in the room.</p>
                        <h3>Proposed structure</h3>
                        <ol>
                            <li>Where we are — a one-line recap of Q2 outcomes</li>
                            <li>What's changed — market signal since last planning cycle</li>
                            <li>The three bets for Q3, ranked by conviction</li>
                            <li>What we're explicitly not doing</li>
                        </ol>
                        <blockquote>“A roadmap is a statement of trade-offs, not a wishlist.” — good line to open the deck
                            with.</blockquote>
                        <p>Let me know if you'd like this adapted for an <code>engineering</code> audience versus a
                            <code>go-to-market</code> one — the sequencing usually shifts.
                        </p>
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

            <!-- User Message -->
            <article class="message message-user">
                <div class="message-body">
                    <div class="message-meta message-meta-right">
                        <span class="message-time">9:43 AM</span>
                        <span class="message-author">You</span>
                    </div>
                    <div class="message-bubble">
                        <p>This is for the go-to-market team. Can you also sketch a quick comparison table of the three bets
                            — impact vs. effort — and keep it tight.</p>
                    </div>
                </div>
                <span class="avatar avatar-md avatar-user">
                    <img src="https://i.pravatar.cc/64?img=13" alt="Amelia Hart">
                </span>
            </article>

            <!-- AI Message with Table + Code -->
            <article class="message message-ai">
                <span class="avatar avatar-md avatar-ai" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M12 2L14.5 9.5L22 12L14.5 14.5L12 22L9.5 14.5L2 12L9.5 9.5L12 2Z" fill="white" />
                    </svg>
                </span>
                <div class="message-body">
                    <div class="message-meta">
                        <span class="message-author">Aurea</span>
                        <span class="message-time">9:43 AM</span>
                    </div>
                    <div class="message-bubble">
                        <p>Here's the tightened comparison, framed for a go-to-market audience:</p>
                        <div class="table-responsive">
                            <table class="msg-table">
                                <thead>
                                    <tr>
                                        <th>Bet</th>
                                        <th>Impact</th>
                                        <th>Effort</th>
                                        <th>Owner</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Self-serve onboarding</td>
                                        <td><span class="pill pill-high">High</span></td>
                                        <td><span class="pill pill-med">Medium</span></td>
                                        <td>Growth</td>
                                    </tr>
                                    <tr>
                                        <td>Usage-based pricing</td>
                                        <td><span class="pill pill-high">High</span></td>
                                        <td><span class="pill pill-high">High</span></td>
                                        <td>Product</td>
                                    </tr>
                                    <tr>
                                        <td>Partner integrations</td>
                                        <td><span class="pill pill-med">Medium</span></td>
                                        <td><span class="pill pill-low">Low</span></td>
                                        <td>BD</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p>And if you need the raw values for the slide builder, here's a small snippet:</p>
                        <div class="code-block">
                            <div class="code-block-header">
                                <span>javascript</span>
                                <button class="code-copy-btn" type="button" aria-label="Copy code"><i
                                        class="bi bi-copy"></i> Copy</button>
                            </div>
                            <pre><code>const bets = [
  { name: "Self-serve onboarding", impact: "high", effort: "medium" },
  { name: "Usage-based pricing", impact: "high", effort: "high" },
  { name: "Partner integrations", impact: "medium", effort: "low" },
];</code></pre>
                        </div>
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
        <form class="chat-input-form" id="chatInputForm">
            <div class="chat-input-wrapper" id="chatInputWrapper">

                <label for="chatTextarea" class="visually-hidden">Message</label>
                <textarea id="chatTextarea" class="chat-textarea" placeholder="Ask anything..." rows="1"
                    aria-label="Type your message"></textarea>

                <button type="submit" class="send-btn" id="sendBtn" aria-label="Send message" disabled>
                    <i class="bi bi-arrow-up" aria-hidden="true"></i>
                </button>
            </div>
        </form>
        <p class="input-disclaimer">Chat AI can make mistakes. Please verify important information.</p>
    </footer>
@endsection
