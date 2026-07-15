<style>
    :root {
        --gj-primary: #1a3c6e;
        --gj-primary-light: #2557a7;
        --gj-accent: #e8a020;
        --gj-accent-light: #f5b942;
        --gj-surface: #ffffff;
        --gj-surface-alt: #f0f4fb;
        --gj-text: #1c2b40;
        --gj-text-muted: #6b7a8d;
        --gj-border: #e2e8f0;
        --gj-shadow: 0 8px 40px rgba(26, 60, 110, 0.15);
        --gj-radius: 16px;
        --gj-radius-sm: 10px;
    }

    #gj-chat-launcher {
        position: fixed;
        bottom: 28px;
        right: 28px;
        z-index: 9998;
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--gj-primary) 0%, var(--gj-primary-light) 100%);
        border-radius: 50%;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 20px rgba(26, 60, 110, 0.35);
        display: flex;
        align-items: center;
        justify-content: center;
        outline: none;
        transition: transform 0.5s cubic-bezier(0.5, 0, 0.3, 1.5), box-shadow 0.2s ease;
    }

    #gj-chat-launcher:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 32px rgba(26, 60, 110, 0.5);
    }

    #gj-chat-launcher svg {
        width: 28px;
        height: 28px;
        fill: #fff;
        transition: opacity 0.2s;
    }

    #gj-chat-launcher .icon-close { display: none; }
    #gj-chat-launcher.open .icon-chat { display: none; }
    #gj-chat-launcher.open .icon-close { display: block; }

    #gj-notif-dot {
        position: absolute;
        top: 4px;
        right: 4px;
        width: 12px;
        height: 12px;
        background: var(--gj-accent);
        border-radius: 50%;
        border: 2px solid #fff;
        animation: gj-pulse 2s infinite;
    }

    @keyframes gj-pulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.15); opacity: 0.75; }
    }

    #gj-chat-window {
        position: fixed;
        bottom: 100px;
        right: 28px;
        z-index: 9999;
        width: 380px;
        max-width: calc(100vw - 40px);
        max-height: 600px;
        background: var(--gj-surface);
        border-radius: var(--gj-radius);
        box-shadow: var(--gj-shadow);
        display: none;
        flex-direction: column;
        overflow: hidden;
        border: 1px solid var(--gj-border);
        animation: gj-slide-up 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    #gj-chat-window.visible { display: flex; }

    @keyframes gj-slide-up {
        from { opacity: 0; transform: translateY(24px) scale(0.96); }
        to   { opacity: 1; transform: translateY(0)   scale(1);    }
    }

    #gj-chat-header {
        background: linear-gradient(135deg, var(--gj-primary) 0%, #1e4d8a 100%);
        padding: 14px 18px;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }

    .gj-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        overflow: hidden;
        flex-shrink: 0;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    .gj-avatar img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .gj-header-info {
        display: flex;
        flex-direction: column;
        gap: 1px;
    }

    .gj-header-info h4 {
        color: #fff;
        font-size: 15px;
        font-weight: 700;
        margin: 0;
        font-family: "Poppins", sans-serif;
        letter-spacing: 0.01em;
        line-height: 1.3;
    }

    .gj-header-info span {
        color: rgba(255,255,255,0.7);
        font-size: 11.5px;
        display: flex;
        align-items: center;
        gap: 5px;
        font-family: "Poppins", sans-serif;
        font-weight: 400;
    }

    .gj-online-dot {
        width: 7px;
        height: 7px;
        background: #4ade80;
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 6px rgba(74, 222, 128, 0.5);
    }

    #gj-messages {
        flex: 1;
        overflow-y: auto;
        padding: 16px;
        display: flex;
        flex-direction: column;
        gap: 14px;
        background:
            radial-gradient(ellipse at 20% 0%, rgba(26, 60, 110, 0.03) 0%, transparent 60%),
            radial-gradient(ellipse at 80% 100%, rgba(232, 160, 32, 0.03) 0%, transparent 60%),
            var(--gj-surface-alt);
        scroll-behavior: smooth;
    }

    #gj-messages::-webkit-scrollbar { width: 5px; }
    #gj-messages::-webkit-scrollbar-track { background: transparent; }
    #gj-messages::-webkit-scrollbar-thumb { background: var(--gj-border); border-radius: 8px; }
    #gj-messages::-webkit-scrollbar-thumb:hover { background: #c5cfdb; }

    .gj-msg {
        max-width: 85%;
        display: flex;
        flex-direction: column;
        animation: gj-msg-in 0.25s ease;
    }

    @keyframes gj-msg-in {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .gj-msg.bot { align-self: flex-start; }
    .gj-msg.user { align-self: flex-end; }

    .gj-msg.bot .gj-msg-row {
        display: flex;
        align-items: flex-end;
        gap: 8px;
    }

    .gj-msg.bot .gj-msg-avatar {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        flex-shrink: 0;
        overflow: hidden;
        background: #fff;
        border: 1px solid var(--gj-border);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    }

    .gj-msg.bot .gj-msg-avatar img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .gj-bubble {
        padding: 12px 16px;
        border-radius: var(--gj-radius-sm);
        font-size: 14px;
        line-height: 1.6;
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        overflow-wrap: break-word;
        word-wrap: break-word;
        -ms-word-break: break-word;
    }

    .gj-bubble a {
        overflow-wrap: break-word;
        word-wrap: break-word;
    }

    .gj-msg.bot .gj-bubble {
        background: var(--gj-surface);
        color: var(--gj-text);
        border-bottom-left-radius: 4px;
        border: 1px solid var(--gj-border);
        box-shadow: 0 1px 4px rgba(0,0,0,0.04);
    }

    .gj-msg.user .gj-bubble {
        background: linear-gradient(135deg, var(--gj-primary) 0%, var(--gj-primary-light) 100%);
        color: #fff;
        border-bottom-right-radius: 4px;
        box-shadow: 0 2px 8px rgba(26, 60, 110, 0.2);
    }

    .gj-msg-time {
        font-size: 10px;
        color: var(--gj-text-muted);
        margin-top: 4px;
        padding: 0 4px;
        font-weight: 500;
        letter-spacing: 0.02em;
    }

    .gj-msg.user .gj-msg-time {
        text-align: right;
        color: rgba(107, 122, 141, 0.8);
    }

    .gj-bubble a {
        color: var(--gj-accent-light);
        text-decoration: underline;
        font-weight: 500;
        transition: opacity 0.15s;
        overflow-wrap: break-word;
        word-wrap: break-word;
        word-break: break-all;
    }

    .gj-bubble a:hover { opacity: 0.8; }

    .gj-msg.bot .gj-bubble a {
        color: var(--gj-primary-light);
        text-decoration: underline;
        font-weight: 500;
    }

    .gj-bubble a[href^="tel"] {
        color: #059669 !important;
        text-decoration: none;
        font-weight: 700;
        word-break: keep-all;
        cursor: pointer;
    }

    .gj-bubble a[href^="tel"]:hover {
        text-decoration: underline;
        color: #047857 !important;
    }

    .gj-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 10px;
    }

    .gj-chip {
        background: var(--gj-surface);
        border: 1.5px solid var(--gj-primary-light);
        color: var(--gj-primary);
        border-radius: 20px;
        padding: 7px 14px;
        font-size: 12.5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.15s ease;
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        white-space: nowrap;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }

    .gj-chip:hover {
        background: var(--gj-primary);
        color: #fff;
        border-color: var(--gj-primary);
        box-shadow: 0 2px 8px rgba(26, 60, 110, 0.2);
        transform: translateY(-1px);
    }

    .gj-typing {
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 14px 18px;
        background: var(--gj-surface);
        border-radius: var(--gj-radius-sm);
        border-bottom-left-radius: 4px;
        border: 1px solid var(--gj-border);
        align-self: flex-start;
        width: fit-content;
        box-shadow: 0 1px 4px rgba(0,0,0,0.04);
    }

    .gj-typing span {
        width: 8px;
        height: 8px;
        background: var(--gj-text-muted);
        border-radius: 50%;
        display: inline-block;
        animation: gj-bounce 1.3s infinite;
    }

    .gj-typing span:nth-child(2) { animation-delay: 0.2s; }
    .gj-typing span:nth-child(3) { animation-delay: 0.4s; }

    @keyframes gj-bounce {
        0%, 80%, 100% { transform: translateY(0); opacity: 0.4; }
        40%           { transform: translateY(-7px); opacity: 1; }
    }

    #gj-chat-input-area {
        padding: 12px 14px;
        background: var(--gj-surface);
        border-top: 1px solid var(--gj-border);
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    #gj-user-input {
        flex: 1;
        border: 1.5px solid var(--gj-border);
        border-radius: 24px;
        padding: 10px 16px;
        font-size: 14px;
        outline: none;
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        color: var(--gj-text);
        background: var(--gj-surface-alt);
        transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        resize: none;
    }

    #gj-user-input:focus {
        border-color: var(--gj-primary-light);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(37, 87, 167, 0.1);
    }

    #gj-user-input::placeholder { color: var(--gj-text-muted); }

    #gj-send-btn {
        width: 42px;
        height: 42px;
        background: linear-gradient(135deg, var(--gj-primary) 0%, var(--gj-primary-light) 100%);
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: transform 0.15s, opacity 0.15s, box-shadow 0.15s;
        box-shadow: 0 2px 8px rgba(26, 60, 110, 0.2);
    }

    #gj-send-btn:hover:not(:disabled) {
        transform: scale(1.08);
        box-shadow: 0 4px 14px rgba(26, 60, 110, 0.3);
    }

    #gj-send-btn:disabled { opacity: 0.4; cursor: default; box-shadow: none; }

    #gj-send-btn svg {
        width: 19px;
        height: 19px;
        fill: #fff;
        margin-left: 2px;
    }

    #gj-chat-footer {
        text-align: center;
        padding: 7px 0 9px;
        font-size: 10.5px;
        color: var(--gj-text-muted);
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        background: var(--gj-surface);
        border-top: 1px solid var(--gj-border);
        letter-spacing: 0.01em;
    }

    #gj-chat-footer a {
        color: var(--gj-primary-light);
        font-weight: 600;
        text-decoration: none;
    }

    #gj-chat-footer a:hover {
        text-decoration: underline;
    }

    @media (max-width: 480px) {
        #gj-chat-window {
            bottom: 90px;
            right: 12px;
            left: 12px;
            width: auto;
            max-height: 75vh;
        }
        #gj-chat-launcher { bottom: 18px; right: 18px; }
    }
</style>

<button id="gj-chat-launcher" aria-label="Open chat support">
    <div id="gj-notif-dot"></div>
    <svg class="icon-chat" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M20 2H4C2.9 2 2 2.9 2 4v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>
    </svg>
    <svg class="icon-close" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
    </svg>
</button>

<div id="gj-chat-window" role="dialog" aria-label="Global Journey Chat Support">
    <div id="gj-chat-header">
        <div class="gj-avatar">
            @if (is_object($setting) && isset($setting->favicon) && $setting->favicon)
                <img src="{{ asset('uploaded-images/site-setting-images/' . $setting->favicon) }}" alt="{{ $setting->favicon_alt ?? 'Favicon' }}">
            @else
                <img src="{{ asset('frontend/assets/img/global-icon-only.png') }}" alt="Global Journey">
            @endif
        </div>
        <div class="gj-header-info">
            <h4>Global Journey Advisor</h4>
            <span><span class="gj-online-dot"></span> Online</span>
        </div>
    </div>

    <div id="gj-messages" aria-live="polite" aria-label="Chat messages"></div>

    <div id="gj-chat-input-area">
        <input type="text" id="gj-user-input" placeholder="Ask about studying abroad…" autocomplete="off" maxlength="400" />
        <button id="gj-send-btn" aria-label="Send message" disabled>
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
            </svg>
        </button>
    </div>

    <div id="gj-chat-footer">Powered by Global Journey Education · <a href="https://www.globaljourneyedu.com.np/contact-us" target="_blank">Book a free consult</a></div>
</div>

<script>
(function () {
    'use strict';

    const API_URL = '{{ route("chatbot.reply") }}';
    const FAVICON_URL = '@if (is_object($setting) && isset($setting->favicon) && $setting->favicon){{ asset("uploaded-images/site-setting-images/" . $setting->favicon) }}@else{{ asset("frontend/assets/img/global-icon-only.png") }}@endif';
    const STORAGE_KEY = 'gj_chat_session';
    let isTyping = false;

    function loadSession() {
        try {
            const raw = sessionStorage.getItem(STORAGE_KEY);
            return raw ? JSON.parse(raw) : null;
        } catch { return null; }
    }

    function saveSession(data) {
        try { sessionStorage.setItem(STORAGE_KEY, JSON.stringify(data)); } catch {}
    }

    function clearSession() {
        try { sessionStorage.removeItem(STORAGE_KEY); } catch {}
    }

    let session = loadSession();
    let conversationHistory = session?.history ?? [];
    let faqList = session?.faq ?? [];
    let initialized = session?.initialized ?? false;

    const launcher   = document.getElementById('gj-chat-launcher');
    const chatWindow = document.getElementById('gj-chat-window');
    const messagesEl = document.getElementById('gj-messages');
    const inputEl    = document.getElementById('gj-user-input');
    const sendBtn    = document.getElementById('gj-send-btn');
    const notifDot   = document.getElementById('gj-notif-dot');

    function getTime() {
        return new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
    }

    function scrollBottom() {
        messagesEl.scrollTop = messagesEl.scrollHeight;
    }

    function linkifyText(text) {
        let result = text.replace(/\n/g, '<br>');

        if (!/<[aA]/.test(result)) {
            result = result.replace(
                /(\+|00)\d{1,4}[-\u2010-\u2015\s]?\d{6,12}|0\d{1,2}[-\u2010-\u2015\s]?\d{6,8}/g,
                function (match) {
                    const digits = match.replace(/[-\u2010-\u2015\s]/g, '');
                    return '<a href="tel:' + digits + '">' + match + '</a>';
                }
            );

            result = result.replace(
                /(https?:\/\/[^\s<]+)/g,
                '<a href="$1" target="_blank" rel="noopener">$1</a>'
            );
        }

        result = result.replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>');
        result = result.replace(/\*(.+?)\*/g, '<em>$1</em>');

        return result;
    }

    function addMessage(text, role, chips = []) {
        const wrapper = document.createElement('div');
        wrapper.className = 'gj-msg ' + role;

        if (role === 'bot') {
            const row = document.createElement('div');
            row.className = 'gj-msg-row';

            const avatar = document.createElement('div');
            avatar.className = 'gj-msg-avatar';
            const img = document.createElement('img');
            img.src = FAVICON_URL;
            img.alt = 'Bot';
            avatar.appendChild(img);
            row.appendChild(avatar);

            const col = document.createElement('div');
            col.style.flex = '1';
            col.style.minWidth = '0';

            const bubble = document.createElement('div');
            bubble.className = 'gj-bubble';
            bubble.innerHTML = linkifyText(text);
            col.appendChild(bubble);

            const timeEl = document.createElement('div');
            timeEl.className = 'gj-msg-time';
            timeEl.textContent = getTime();
            col.appendChild(timeEl);

            row.appendChild(col);
            wrapper.appendChild(row);
        } else {
            const bubble = document.createElement('div');
            bubble.className = 'gj-bubble';
            bubble.innerHTML = linkifyText(text);

            const timeEl = document.createElement('div');
            timeEl.className = 'gj-msg-time';
            timeEl.textContent = getTime();

            wrapper.appendChild(bubble);
            wrapper.appendChild(timeEl);
        }

        if (chips.length > 0) {
            const chipsEl = document.createElement('div');
            chipsEl.className = 'gj-chips';
            chips.forEach(label => {
                const btn = document.createElement('button');
                btn.className = 'gj-chip';
                btn.textContent = label;
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    handleUserMessage(label);
                });
                chipsEl.appendChild(btn);
            });
            wrapper.appendChild(chipsEl);
        }

        messagesEl.appendChild(wrapper);
        scrollBottom();
        return wrapper;
    }

    function showTyping() {
        const el = document.createElement('div');
        el.className = 'gj-typing';
        el.id = 'gj-typing-indicator';
        el.innerHTML = '<span></span><span></span><span></span>';
        messagesEl.appendChild(el);
        scrollBottom();
    }

    function hideTyping() {
        const el = document.getElementById('gj-typing-indicator');
        if (el) el.remove();
    }

    function setInputDisabled(disabled) {
        inputEl.disabled = disabled;
        sendBtn.disabled = disabled || inputEl.value.trim() === '';
    }

    function syncSession() {
        saveSession({ history: conversationHistory, faq: faqList, initialized });
    }

    async function callOpenRouterAPI(userMessage) {
        conversationHistory.push({ role: 'user', content: userMessage });
        syncSession();

        const response = await fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ message: userMessage, history: conversationHistory }),
        });

        const data = await response.json();

        conversationHistory.push({ role: 'assistant', content: data.reply });

        if (data.faq && faqList.length === 0) {
            faqList = data.faq;
        }

        syncSession();
        return data.reply;
    }

    async function handleUserMessage(text) {
        text = text.trim();
        if (!text || isTyping) return;

        document.querySelectorAll('.gj-chips').forEach(c => c.remove());

        addMessage(text, 'user');
        inputEl.value = '';
        sendBtn.disabled = true;

        isTyping = true;
        setInputDisabled(true);
        showTyping();

        try {
            const reply = await callOpenRouterAPI(text);
            hideTyping();
            addMessage(reply, 'bot');
        } catch (err) {
            hideTyping();
            addMessage(
                'Sorry, I\'m having trouble connecting right now. Please call us at <a href="tel:014168345">01-4168345</a> or <a href="https://www.globaljourneyedu.com.np/contact-us" target="_blank">book a free consultation</a>.',
                'bot'
            );
        }

        isTyping = false;
        setInputDisabled(false);
        inputEl.focus();
    }

    function initGreeting() {
        const chips = faqList.length > 0 ? faqList.map(f => f.question) : getFallbackChips();

        addMessage(
            'Welcome to <strong>Global Journey Education</strong>.<br>I\'m your study-abroad advisor. How can I assist you today?',
            'bot',
            chips
        );

        conversationHistory.push({
            role: 'assistant',
            content: 'Welcome to **Global Journey Education**.\nI\'m your study-abroad advisor. How can I assist you today?'
        });
        initialized = true;
        syncSession();
    }

    function getFallbackChips() {
        return [
            'What services do you offer?',
            'Which countries can I study in?',
            'How do I book a consultation?',
            'What is the visa success rate?',
            'Do you help with visa interviews?',
            'Is test preparation available?',
            'Where are your offices?',
            'Is the consultation free?',
        ];
    }

    function restoreMessages() {
        for (let i = 0; i < conversationHistory.length; i++) {
            const msg = conversationHistory[i];
            let chips = [];
            if (i === 0) {
                chips = faqList.length > 0 ? faqList.map(f => f.question) : getFallbackChips();
            }
            addMessage(msg.content, msg.role === 'user' ? 'user' : 'bot', chips);
        }
        if (conversationHistory.length === 0) {
            initGreeting();
        }
    }

    launcher.addEventListener('click', () => {
        const isOpen = chatWindow.classList.toggle('visible');
        launcher.classList.toggle('open', isOpen);

        if (isOpen) {
            if (notifDot) notifDot.style.display = 'none';
            if (!initialized) {
                initialized = true;
                setTimeout(initGreeting, 300);
            }
            setTimeout(() => inputEl.focus(), 350);
        }
    });

    sendBtn.addEventListener('click', () => handleUserMessage(inputEl.value));

    inputEl.addEventListener('keydown', e => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            if (!sendBtn.disabled) handleUserMessage(inputEl.value);
        }
    });

    inputEl.addEventListener('input', () => {
        sendBtn.disabled = inputEl.value.trim() === '' || isTyping;
    });

    document.addEventListener('click', e => {
        if (
            chatWindow.classList.contains('visible') &&
            !chatWindow.contains(e.target) &&
            !launcher.contains(e.target)
        ) {
            chatWindow.classList.remove('visible');
            launcher.classList.remove('open');
        }
    });

    if (initialized) {
        restoreMessages();
    }
})();
</script>
