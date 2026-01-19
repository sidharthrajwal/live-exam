import Echo from 'laravel-echo'
import Pusher from 'pusher-js'

window.Pusher = Pusher

window.Echo = new Echo({
    broadcaster: 'reverb',
    wsHost: '127.0.0.1',
    wsPort: 9000,
    forceTLS: false,
    enabledTransports: ['ws'],
})

console.log('Echo initialized', window.Echo)
