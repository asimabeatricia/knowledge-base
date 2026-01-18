<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Chatbot Knowledge Base</title>
</head>

<body>
    <div class="chatbot-container">
        <div class="chatbot-header">
            <img src="img/logoWarna.png" alt="BPJS Logo" class="logo">
            <span>Chatbot Knowledge Base</span>
        </div>
        <div class="chatbot-body" id="chat-box">
        </div>
        <div class="chatbot-footer">
            <input type="text" id="user-input" placeholder="Masukkan pesan Anda..." autocomplete="off">
            <button onclick="sendMessage()" class="send-btn">
                <svg width="32" height="32" viewBox="0 0 24 24">
                    <path fill="#1976d2" d="M2 21l21-9-21-9v7l15 2-15 2z" />
                </svg>
            </button>
        </div>
    </div>
</body>

</html>

<script>
    const chatBox = document.getElementById('chat-box');
    const inputField = document.getElementById('user-input');

    function formatBotReply(text) {
        const items = text.split(/(?:\r?\n)+(?=\d+\.\s)/g);
        if (items.length > 1) {
            let html = '<ol>';
            items.forEach(item => {
                html += `<li>${item.replace(/^\d+\.\s*/, '')}</li>`;
            });
            html += '</ol>';
            return html;
        }
        return text.replace(/\n/g, '<br>');
    }

    function appendMessage(text, sender) {
        const msgDiv = document.createElement('div');
        msgDiv.className = sender === 'user' ? 'user-msg' : 'bot-msg';

        // Avatar
        const avatar = document.createElement('div');
        avatar.className = 'avatar';
        avatar.innerHTML = sender === 'bot' ?
            '<img src="img/chat-bot.png" alt="bot" style="width:28px;">' :
            '<img src="img/profile.png" alt="user" style="width:20px;">';

        // Bubble
        const bubble = document.createElement('div');
        bubble.className = 'bubble';
        bubble.innerHTML = text.replace(/\n/g, '<br>');

        if (sender === 'bot') {
            msgDiv.appendChild(avatar);
            msgDiv.appendChild(bubble);
        } else {
            msgDiv.appendChild(bubble);
            msgDiv.appendChild(avatar);
        }
        chatBox.appendChild(msgDiv);
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    function sendMessage() {
        const text = inputField.value.trim();
        if (!text) return;

        appendMessage(text, 'user');
        inputField.value = '';

        fetch('/chatbot/sendMessage', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'message=' + encodeURIComponent(text)
            })
            .then(response => response.json())
            .then(data => {
                appendMessage(data.reply, 'bot');
            });
    }

    // function sendQuick(text) {
    //     inputField.value = text;
    //     sendMessage();
    // }

    inputField.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            sendMessage();
        }
    });

    window.addEventListener('DOMContentLoaded', function() {
        // Chat default bot
        appendMessage(
            'Selamat datang di Chatbot Knowledge Base! Ada yang bisa dibantu?',
            'bot'
        );

        // Add quick reply after chat default
        // const quickReplyDiv = document.createElement('div');
        // quickReplyDiv.className = 'quick-reply';
        // quickReplyDiv.innerHTML = `
        //     <button onclick="sendQuick('Electronic Payment System')">Electronic Payment System</button>
        //     <button onclick="sendQuick('Reset Password EPS')">Reset Password EPS</button>
        // `;
        // chatBox.appendChild(quickReplyDiv);
    });
</script>

<style>
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    body {
        font-family: sans-serif;
        background: transparent;
    }

    .chatbot-container {
        width: 100vw;
        height: 100vh;
        min-height: 0;
        min-width: 0;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
    }

    .chatbot-header {
        background: #2986f5;
        color: #fff;
        border-radius: 24px 24px 0 0;
        padding: 14px 10px 14px 48px;
        font-size: 1.05rem;
        font-weight: bold;
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .chatbot-header .logo {
        height: 28px;
        width: auto;
        margin-right: 6px;
    }

    .chatbot-body {
        flex: 1 1 auto;
        display: flex;
        flex-direction: column;
        gap: 10px;
        min-height: 0;
        overflow-y: auto;
        padding: 20px;
        background: #e3eef8;
        width: 100%;
    }

    /* .quick-reply {
        display: flex;
        gap: 10px;
        padding: 12px 0 0 0;
        flex-wrap: wrap;
        background: transparent;
        margin: 0;
    }

    .quick-reply button {
        background: #fff;
        border: none;
        border-radius: 18px;
        padding: 8px 18px;
        font-size: 1rem;
        color: #2986f5;
        cursor: pointer;
        margin-bottom: 4px;
        transition: background 0.2s;
    } */

    /* .quick-reply button:hover {
        background: #d6e94b;
    } */

    .chatbot-footer {
        display: flex;
        align-items: center;
        padding: 16px 20px;
        border-top: 1px solid #dbeafe;
        background: #e3eef8;
        border-radius: 0 0 24px 24px;
        margin: 0;
    }

    #user-input {
        flex: 1;
        border: none;
        border-radius: 18px;
        padding: 12px 18px;
        font-size: 1rem;
        background: #f4f8fb;
        color: #888;
        outline: none;
    }

    .send-btn {
        background: none;
        border: none;
        margin-left: 8px;
        cursor: pointer;
        padding: 0;
        display: flex;
        align-items: center;
    }

    /* Chat bubble */
    .bot-msg,
    .user-msg {
        display: flex;
        align-items: flex-end;
        gap: 12px;
        width: 100%;
    }

    .bot-msg .bubble,
    .user-msg .bubble {
        max-width: 75%;
        padding: 10px 16px;
        border-radius: 18px;
        font-size: 1rem;
        word-break: break-word;
        white-space: pre-line;
        background: #fff;
        color: #222;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        margin: 0;
    }

    .bot-msg {
        flex-direction: row;
    }

    .bot-msg .bubble {
        background: #fff;
        color: #222;
        border-bottom-left-radius: 4px;
    }

    .bot-msg .avatar {
        background: #8fd19e;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
    }

    .user-msg {
        flex-direction: row-reverse;
    }

    .user-msg .bubble {
        background: #fff;
        color: #222;
        border-bottom-right-radius: 4px;
    }

    .user-msg .avatar {
        background: #b7e0f7;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
    }

    @media (max-width: 600px) {
        .chatbot-container {
            width: 100vw !important;
            height: 100vh !important;
            border-radius: 8px !important;
        }
    }
</style>