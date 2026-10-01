<div id="chatbot-widget" class="chatbot-widget">

    <!-- Floating Button -->
    <button type="button" id="chatbot-toggle" class="chatbot-toggle" aria-label="Open Riviera Golf Club Assistant"
        aria-expanded="false">
        <i class="bi bi-chat-dots-fill"></i>
    </button>


    <!-- Chat Window -->
    <div id="chatbot-window" class="chatbot-window" aria-hidden="true">

        <!-- Header -->
        <div class="chatbot-header">

            <div class="chatbot-header-info">

                <div class="chatbot-avatar">
                    <i class="bi bi-stars"></i>
                </div>

                <div>
                    <div class="chatbot-title">
                        Riviera Assistant
                    </div>

                    <div class="chatbot-status">
                        <span class="chatbot-status-dot"></span>
                        Online
                    </div>
                </div>

            </div>


            <button type="button" id="chatbot-close" class="chatbot-close" aria-label="Close chatbot">
                <i class="bi bi-x-lg"></i>
            </button>

        </div>


        <!-- Messages -->
        <div id="chatbot-messages" class="chatbot-messages" aria-live="polite">

            <!-- Welcome message -->
            <div class="chatbot-message chatbot-message-assistant">

                <div class="chatbot-message-avatar">
                    <i class="bi bi-stars"></i>
                </div>

                <div class="chatbot-message-content">
                    Hello! 👋<br><br>

                    I'm the Riviera Golf Club website assistant.
                    How can I help you today?
                </div>

            </div>

        </div>


        <!-- Typing indicator -->
        <div id="chatbot-typing" class="chatbot-typing" hidden>
            <div class="chatbot-message-avatar">
                <i class="bi bi-stars"></i>
            </div>

            <div class="chatbot-typing-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>


        <!-- Input Area -->
        <div class="chatbot-input-area">

            <form id="chatbot-form">

                <div class="chatbot-input-wrapper">

                    <textarea id="chatbot-input" name="message" class="chatbot-input" rows="1" maxlength="2000"
                        placeholder="Ask me something..." autocomplete="off"></textarea>

                    <button type="submit" id="chatbot-send" class="chatbot-send" aria-label="Send message">
                        <i class="bi bi-send-fill"></i>
                    </button>

                </div>

            </form>

            <div class="chatbot-disclaimer">
                AI-generated responses may occasionally be inaccurate.
            </div>

        </div>

    </div>

</div>
