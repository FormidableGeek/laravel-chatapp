const chatId = document.querySelector('meta[name="chatId"]').getAttribute('content');
const user_id = document.querySelector('meta[name="user_id"]').getAttribute('content');
const receiver_id = $('#receiver_id').val();
let messages = document.getElementById("messages");
let page=1;

    $('#message-form').on('submit', function(e) {
        e.preventDefault();
        const message = $('#message-input').val();
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        $.post('/messages', 
        {    _token: csrfToken,
             message: message,
             receiver_id:receiver_id }, 
             function(data) {
            const messageElement = document.createElement('div');
            messageElement.classList.add('sender-message')
            messageElement.textContent = message;
            $('#message-input').val('');
            document.getElementById('messages').appendChild(messageElement);
            const messagesContainer = document.getElementById('messages');
            messagesContainer.scrollTop = messagesContainer.scrollHeight; // Scroll to the bottom
            //fetchMessages();
        });
    });



    function loadMessagesOnScroll(){
        messages.addEventListener("scroll", () => {
            if(messages.scrollTop==0){
                page++;
                loadMessages();
                
            }
        })
    }
    
    function loadMessages(){
        fetch(`/fetch/messages/${receiver_id}?page=${page}`, {
            method: 'GET',
        })
        .then(response => response.json())
        .then(data => {
            messageData=data.data;
            console.table(messageData);
            messageData.forEach(message => {
                if(message.receiver_id==receiver_id){
                    const messageElement = document.createElement('div');
                    messageElement.classList.add('receiver-message')
                    messageElement.textContent = message.message;
                    document.getElementById('messages').prepend(messageElement);

                }
                if(message.receiver_id==user_id){
                    const messageElement = document.createElement('div');
                    messageElement.classList.add('sender-message')
                    messageElement.textContent = message.message;
                    document.getElementById('messages').prepend(messageElement);

                }

                
            });
            
        })
        .catch(error => {
            console.error('Error:', error);
        });//end of fetch

    }

    loadMessages();
    loadMessagesOnScroll();


    window.Echo.channel(`send-message.${chatId}`)
        .listen('.message.sent', (e) => {
            const messageElement = document.createElement('div');
            messageElement.classList.add('receiver-message')
            messageElement.textContent = e.message.message;
            document.getElementById('messages').appendChild(messageElement);
            const messagesContainer = document.getElementById('messages');
            messagesContainer.scrollTop = messagesContainer.scrollHeight; // Scroll to the bottom
        });


