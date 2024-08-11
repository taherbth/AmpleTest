import './bootstrap';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY, // Ensure this matches your .env file
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
});
