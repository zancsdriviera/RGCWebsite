document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById("chatbot-toggle");
    const closeButton = document.getElementById("chatbot-close");

    const chatbotWindow = document.getElementById("chatbot-window");

    const chatbotForm = document.getElementById("chatbot-form");
    const chatbotInput = document.getElementById("chatbot-input");
    const chatbotSend = document.getElementById("chatbot-send");

    const messagesContainer = document.getElementById("chatbot-messages");

    const typingIndicator = document.getElementById("chatbot-typing");

    /*
     * Conversation history.
     *
     * This remains in the browser during the current page visit.
     */
    let conversationHistory = [];

    /*
     * ---------------------------------------------------------
     * OPEN CHATBOT
     * ---------------------------------------------------------
     */

    function openChatbot() {
        chatbotWindow.classList.add("is-open");

        chatbotWindow.setAttribute("aria-hidden", "false");

        toggleButton.setAttribute("aria-expanded", "true");

        setTimeout(function () {
            chatbotInput.focus();
        }, 200);
    }

    /*
     * ---------------------------------------------------------
     * CLOSE CHATBOT
     * ---------------------------------------------------------
     */

    function closeChatbot() {
        chatbotWindow.classList.remove("is-open");

        chatbotWindow.setAttribute("aria-hidden", "true");

        toggleButton.setAttribute("aria-expanded", "false");
    }

    /*
     * ---------------------------------------------------------
     * TOGGLE
     * ---------------------------------------------------------
     */

    toggleButton.addEventListener("click", function () {
        if (chatbotWindow.classList.contains("is-open")) {
            closeChatbot();
        } else {
            openChatbot();
        }
    });

    closeButton.addEventListener("click", function () {
        closeChatbot();
    });

    /*
     * ---------------------------------------------------------
     * ADD MESSAGE
     * ---------------------------------------------------------
     */

    function addMessage(text, sender) {
        const messageWrapper = document.createElement("div");

        messageWrapper.classList.add(
            "chatbot-message",
            sender === "user"
                ? "chatbot-message-user"
                : "chatbot-message-assistant",
        );

        const avatar = document.createElement("div");

        avatar.classList.add("chatbot-message-avatar");

        avatar.innerHTML =
            sender === "user"
                ? '<i class="bi bi-person-fill"></i>'
                : '<i class="bi bi-stars"></i>';

        const content = document.createElement("div");

        content.classList.add("chatbot-message-content");

        /*
         * Use textContent rather than innerHTML.
         *
         * This prevents AI/user text from being interpreted
         * as HTML/JavaScript.
         */
        content.textContent = text;

        messageWrapper.appendChild(avatar);

        messageWrapper.appendChild(content);

        messagesContainer.appendChild(messageWrapper);

        scrollMessagesToBottom();
    }

    /*
     * ---------------------------------------------------------
     * SCROLL
     * ---------------------------------------------------------
     */

    function scrollMessagesToBottom() {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    /*
     * ---------------------------------------------------------
     * TYPING INDICATOR
     * ---------------------------------------------------------
     */

    function showTyping() {
        typingIndicator.hidden = false;

        scrollMessagesToBottom();
    }

    function hideTyping() {
        typingIndicator.hidden = true;
    }

    /*
     * ---------------------------------------------------------
     * INPUT HEIGHT
     * ---------------------------------------------------------
     */

    chatbotInput.addEventListener("input", function () {
        this.style.height = "auto";

        this.style.height = Math.min(this.scrollHeight, 100) + "px";
    });

    /*
     * ---------------------------------------------------------
     * ENTER KEY
     * ---------------------------------------------------------
     *
     * Enter = send
     * Shift + Enter = new line
     */

    chatbotInput.addEventListener("keydown", function (event) {
        if (event.key === "Enter" && !event.shiftKey) {
            event.preventDefault();

            chatbotForm.requestSubmit();
        }
    });

    /*
     * ---------------------------------------------------------
     * SEND MESSAGE
     * ---------------------------------------------------------
     */

    chatbotForm.addEventListener("submit", async function (event) {
        event.preventDefault();

        const message = chatbotInput.value.trim();

        /*
         * Don't send empty messages.
         */

        if (!message) {
            return;
        }

        /*
         * Disable input while waiting.
         */

        chatbotInput.disabled = true;

        chatbotSend.disabled = true;

        /*
         * Display visitor message.
         */

        addMessage(message, "user");

        /*
         * Save visitor message to history.
         */

        conversationHistory.push({
            role: "user",
            content: message,
        });

        /*
         * Clear input.
         */

        chatbotInput.value = "";

        chatbotInput.style.height = "auto";

        /*
         * Show typing animation.
         */

        showTyping();

        try {
            /*
             * Laravel's CSRF token.
             */

            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                ?.getAttribute("content");

            /*
             * Send request to Laravel.
             */

            const response = await fetch("/chatbot", {
                method: "POST",

                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },

                body: JSON.stringify({
                    message: message,

                    /*
                     * Send only the most recent messages.
                     */

                    history: conversationHistory.slice(-10),
                }),
            });

            /*
             * Parse JSON.
             */

            const data = await response.json();

            /*
             * Handle Laravel validation errors.
             */

            if (!response.ok) {
                if (response.status === 422) {
                    throw new Error("Please check your message and try again.");
                }

                throw new Error(
                    data.message || "Unable to contact the chatbot.",
                );
            }

            /*
             * Check chatbot response.
             */

            if (!data.success || !data.reply) {
                throw new Error("The chatbot returned an invalid response.");
            }

            /*
             * Display Gemini response.
             */

            addMessage(data.reply, "assistant");

            /*
             * Save assistant response.
             */

            conversationHistory.push({
                role: "assistant",
                content: data.reply,
            });

            /*
             * Keep history manageable.
             */

            conversationHistory = conversationHistory.slice(-10);
        } catch (error) {
            console.error("Chatbot error:", error);

            addMessage(
                "I’m sorry, but I’m having trouble responding right now. Please try again in a moment.",
                "assistant",
            );
        } finally {
            hideTyping();

            chatbotInput.disabled = false;

            chatbotSend.disabled = false;

            chatbotInput.focus();
        }
    });
});
