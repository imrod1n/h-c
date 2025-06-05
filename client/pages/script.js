        const socket = new WebSocket('ws://localhost:8080');

        socket.addEventListener('open', function(event) {
            console.log('Connected to server.');
        });

        socket.addEventListener('message', function(event) {
            const messages = document.getElementById('messages');
            const message = document.createElement('div');
            message.innerHTML = event.data;
            messages.appendChild(message);
        });

        const form = document.querySelector('form');
        const input = document.querySelector('input');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const message = input.value;
            socket.send(message);

            input.value = '';
        });