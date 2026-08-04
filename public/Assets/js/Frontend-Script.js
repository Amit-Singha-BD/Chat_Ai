document.addEventListener("DOMContentLoaded", () => {
    /* --------------------------------------------------
     1. Bootstrap Tooltips
  -------------------------------------------------- */
    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]',
    );
    tooltipTriggerList.forEach((el) => new bootstrap.Tooltip(el));

    /* --------------------------------------------------
     2. Textarea Auto-Resize
  -------------------------------------------------- */
    const textarea = document.getElementById("chatTextarea");
    const sendBtn = document.getElementById("sendBtn");
    const MAX_HEIGHT = 200;

    const autoResize = () => {
        textarea.style.height = "auto";
        const newHeight = Math.min(textarea.scrollHeight, MAX_HEIGHT);
        textarea.style.height = `${newHeight}px`;
    };

    const updateSendState = () => {
        const hasText = textarea.value.trim().length > 0;
        sendBtn.disabled = !hasText;
    };

    if (textarea) {
        textarea.addEventListener("input", () => {
            autoResize();
            updateSendState();
        });

        // Enter to "send" (UI only) — Shift+Enter for newline
        textarea.addEventListener("keydown", (e) => {
            if (e.key === "Enter" && !e.shiftKey) {
                e.preventDefault();
                if (!sendBtn.disabled) {
                    document.getElementById("chatInputForm").requestSubmit();
                }
            }
        });
    }

    /* --------------------------------------------------
     3. Form Submit (UI only — no network / no storage)
  -------------------------------------------------- */
    // const chatInputForm = document.getElementById("chatInputForm");
    // if (chatInputForm) {
    //     chatInputForm.addEventListener("submit", (e) => {
    //         e.preventDefault();
    //         // Intentionally does nothing beyond UI feedback.
    //         // Backend integration (Laravel) will hook in here.
    //         triggerSendPulse();
    //         textarea.value = "";
    //         autoResize();
    //         updateSendState();
    //         textarea.focus();
    //     });
    // }

    function triggerSendPulse() {
        sendBtn.style.transform = "scale(0.9)";
        window.setTimeout(() => {
            sendBtn.style.transform = "";
        }, 150);
    }

    /* --------------------------------------------------
     4. Button Ripple Effect
  -------------------------------------------------- */
    const rippleTargets = document.querySelectorAll(
        ".send-btn, .btn-new-chat, .suggestion-card",
    );

    rippleTargets.forEach((btn) => {
        btn.addEventListener("click", function (e) {
            const rect = this.getBoundingClientRect();
            const ripple = document.createElement("span");
            const size = Math.max(rect.width, rect.height);
            const x =
                (e.clientX ?? rect.left + rect.width / 2) -
                rect.left -
                size / 2;
            const y =
                (e.clientY ?? rect.top + rect.height / 2) - rect.top - size / 2;

            ripple.className = "ripple";
            ripple.style.width = ripple.style.height = `${size}px`;
            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;

            this.style.position = this.style.position || "relative";
            this.style.overflow = "hidden";
            this.appendChild(ripple);

            window.setTimeout(() => ripple.remove(), 550);
        });
    });

    /* --------------------------------------------------
     5. Dark Mode UI Toggle (visual only)
  -------------------------------------------------- */
    const themeToggle = document.getElementById("themeToggle");
    const rootHtml = document.documentElement;

    if (themeToggle) {
        themeToggle.addEventListener("click", () => {
            const isDark = rootHtml.getAttribute("data-theme") === "dark";
            rootHtml.setAttribute("data-theme", isDark ? "light" : "dark");

            const icon = themeToggle.querySelector("i");
            icon.classList.toggle("bi-moon-stars", isDark);
            icon.classList.toggle("bi-sun", !isDark);
        });
    }

    /* --------------------------------------------------
     6. Conversation Item Selection (visual state only)
  -------------------------------------------------- */
    const conversationItems = document.querySelectorAll(".conversation-item");
    const chatTitleText = document.getElementById("chatTitleText");

    // conversationItems.forEach((item) => {
    //     item.addEventListener("click", (e) => {
    //         // Ignore clicks on the dropdown trigger itself
    //         if (e.target.closest(".conv-menu-btn")) return;
    //         e.preventDefault();

    //         conversationItems.forEach((el) => {
    //             el.classList.remove("active");
    //             el.removeAttribute("aria-current");
    //         });
    //         item.classList.add("active");
    //         item.setAttribute("aria-current", "true");

    //         const titleSpan = item.querySelector(".conversation-title");
    //         if (titleSpan && chatTitleText) {
    //             chatTitleText.textContent = titleSpan.textContent;
    //         }

    //         // Close mobile offcanvas after selecting a conversation
    //         const sidebarEl = document.getElementById("sidebar");
    //         const offcanvasInstance =
    //             bootstrap.Offcanvas.getInstance(sidebarEl);
    //         if (offcanvasInstance && window.innerWidth < 992) {
    //             offcanvasInstance.hide();
    //         }
    //     });
    // });

    /* --------------------------------------------------
     7. Suggestion Cards -> Prefill Input (UI only)
  -------------------------------------------------- */
    const suggestionCards = document.querySelectorAll(".suggestion-card");
    suggestionCards.forEach((card) => {
        card.addEventListener("click", () => {
            const title =
                card.querySelector(".suggestion-title")?.textContent ?? "";
            if (textarea) {
                textarea.value = title;
                autoResize();
                updateSendState();
                textarea.focus();
            }
        });
    });

    /* --------------------------------------------------
     8. Copy Buttons (visual feedback only, no clipboard writes required)
  -------------------------------------------------- */
    const copyButtons = document.querySelectorAll(
        '.code-copy-btn, .msg-action-btn[aria-label="Copy message"]',
    );
    copyButtons.forEach((btn) => {
        btn.addEventListener("click", () => {
            const icon = btn.querySelector("i");
            const originalClass = icon.className;
            icon.className = "bi bi-check2";
            window.setTimeout(() => {
                icon.className = originalClass;
            }, 1400);
        });
    });

    /* --------------------------------------------------
     9. Smooth Scroll to Bottom of Thread on Load
  -------------------------------------------------- */
    const chatThread = document.getElementById("chatThread");
    if (chatThread) {
        chatThread.scrollTo({
            top: chatThread.scrollHeight,
            behavior: "smooth",
        });
    }

    /* --------------------------------------------------
     10. Sidebar Search Filter (client-side visual filter only)
  -------------------------------------------------- */
    const searchInput = document.getElementById("conversationSearch");
    if (searchInput) {
        searchInput.addEventListener("input", () => {
            const query = searchInput.value.trim().toLowerCase();
            conversationItems.forEach((item) => {
                const title =
                    item
                        .querySelector(".conversation-title")
                        ?.textContent.toLowerCase() ?? "";
                const match = title.includes(query);
                item.parentElement.style.display = match ? "" : "none";
            });
        });
    }

    /* --------------------------------------------------
     11. New Chat Button — visual reset to Empty State
     (Demonstration of UI-only state toggle; no data cleared)
  -------------------------------------------------- */
    const newChatBtn = document.getElementById("newChatBtn");
    const emptyState = document.getElementById("emptyState");

    if (newChatBtn && emptyState && chatThread) {
        newChatBtn.addEventListener("click", () => {
            const showingEmpty = !emptyState.classList.contains("d-none");
            if (showingEmpty) return;

            chatThread.classList.add("d-none");
            document
                .querySelector(".chat-input-area")
                ?.classList.remove("d-none");
            emptyState.classList.remove("d-none");

            conversationItems.forEach((el) => {
                el.classList.remove("active");
                el.removeAttribute("aria-current");
            });

            if (chatTitleText) chatTitleText.textContent = "New chat";
        });
    }
});

document
.getElementById('conversation_id')
.value = response.conversation_id;