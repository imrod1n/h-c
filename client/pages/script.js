        const socket = new WebSocket('ws://localhost:8080');

        function getCookie(name){
            const cookies = document.cookie.split(';');
            for (let i = 0; i < cookies.length; i++) {
                let cookie = cookies[i].trim();
                if(cookie.startsWith(name + '=')){
                    return cookie.substring(name.length+1);
                }
            }
        }

        const params = new URLSearchParams(window.location.search);
        let param = params.get('name');

        socket.addEventListener('open', function(event) {
            console.log('Connected to server.');
        });

        socket.addEventListener('message', function(event) {
            const messages = document.getElementById('messages');
            const message = document.createElement('div');
            const cont = document.createElement('h6')
            let msg = JSON.parse(event.data);
            if (msg.sender == getCookie('login')){
                message.className = 'bg-primary text-white p-3 mt-1';
                message.style.cssText = 'width: fit-content; height: fit-content; margin-left: auto; border-radius:15px'
            }else{
                message.className = 'bg-black text-white p-3 mt-1';
                message.style.cssText = 'width: fit-content; height: fit-content; border-radius:15px';
                let send = document.createElement('p');
                send.innerHTML = msg.sender  + ':';
                send.className = 'm-0 p-0';
                message.appendChild(send);
            }
            cont.innerHTML = msg.content;
            cont.className = 'm-0 p-0';
            message.appendChild(cont);
            messages.appendChild(message);
        });

        const form = document.querySelector('form');
        const input = document.querySelector('input');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const message = {content: input.value, sender: getCookie('login'), chat: param};
            socket.send(JSON.stringify(message));
            console.log(message);

            input.value = '';
        });