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
let countdownInterval = null;
function startExamTimer() {

    const timerEl = document.getElementById('exam-timer');
    const duration = timerEl.dataset.duration;
    if (!duration) return;
    let [m, s] = duration.split(':').map(Number);
    let totalSeconds = m * 60 + s;
    countdownInterval = setInterval(() => {
        totalSeconds--;

        if (totalSeconds <= 0) {
            clearInterval(countdownInterval);
            countdownInterval = null;


            return;
        }

        const currentMinutes = Math.floor(totalSeconds / 60);
        const currentSeconds = totalSeconds % 60;
        timerEl.textContent = `${currentMinutes}:${currentSeconds < 10 ? '0' : ''}${currentSeconds}`;
    }, 1000);
}

function startCountdown() {

    const countdownEl = document.getElementById('countdown');
    const timerDisplay = countdownEl?.querySelector('.countdown-message');
    if (!countdownEl || !timerDisplay) return;

    if (timer) clearTimeout(timer);

    countdownEl.classList.add('active');
    timerDisplay.innerHTML = `<h2>10</h2>`;

    let secondsLeft = 10;
    const interval = setInterval(() => {
        secondsLeft--;
        timerDisplay.innerHTML = `<h2>${secondsLeft}</h2>`;

        if (secondsLeft <= 0) {
            clearInterval(interval);
        }
    }, 1000);


    timer = setTimeout(() => {
        countdownEl.classList.remove('active');
        startExamTimer();
    }, 10000);
}


const examId = document.getElementById('exam-timer')?.dataset.examId;

if (examId) {
    window.Echo
        .channel(`exam.${examId}`)
        .listen('.ExamStarted', (e) => {
            console.log('Exam event received:', e);

            if (e.message === 'exam started') {
                startCountdown();
            }

            if (e.message === 'exam ended') {
                if (typeof timer !== 'undefined') clearTimeout(timer);
                document.getElementById('countdown')?.classList.remove('active');
            }
        });
}

