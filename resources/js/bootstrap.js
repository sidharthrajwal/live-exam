import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

if (Echo) {
    console.log('Echo initialized', window.Echo);
}

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});
console.log('Echo CREATED', window.Echo);

// Timer variable to control the interval
let timer;
const examStart = "16:35:00";

/* Convert "HH:MM:SS" → Date */
function getExamStartDate() {
    const [h, m, s] = examStart.split(':').map(Number);
    const date = new Date();
    date.setHours(h, m, s, 0);
    return date;
}

function updateCountdown() {
    const countdownEl = document.getElementById('countdown');
    const timerDisplay = countdownEl?.querySelector('.countdown-message');
    if (!countdownEl || !timerDisplay) return;

    const examStartDate = getExamStartDate();
    const currentTime = new Date();
    const diff = examStartDate - currentTime;

    // Exam started
    if (diff <= 0) {
        countdownEl.classList.remove('active');
        clearInterval(timer);
        console.log('Exam Started');
        return;
    }

    // Countdown active
    const secondsLeft = Math.ceil(diff / 1000);
    countdownEl.classList.add('active');
    timerDisplay.innerHTML = `<h2>${secondsLeft}</h2>`;
}

function startCountdown() {
    if (timer) clearInterval(timer);
    updateCountdown();
    timer = setInterval(updateCountdown, 1000);
}
window.Echo.channel('exam-started')
    .listen('.ExamStarted', (e) => {
        console.log('Exam event received:', e.message);

        if (e.message === 'exam started') {
            startCountdown();
        }

        if (e.message === 'exam ended') {
            clearInterval(timer);
            document.getElementById('countdown')?.classList.remove('active');
        }
    });
