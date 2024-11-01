let page = 1;
const inboxContainer = document.getElementById('inbox-container');

function inbox() {
    fetch(`/inbox?page=${page}`, {
        method: 'GET',
    })
    .then(response => response.json())
    .then(data => {
        const messageData = data.latest_messages; // Assuming the server returns this structure

       // inboxContainer.innerHTML = ''; // Clear previous content
        messageData.forEach(message => {
            const otherUser = message.other_user; // Get other user details
            const chatTime = new Date(message.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }); // Format the time

            // Create chat HTML structure
            const chatDiv = document.createElement('div');
            chatDiv.className = 'chat';
            chatDiv.onclick = function() {
                location.href = `/chat/${otherUser.id}`; // Navigate to chat page
            };
            // Correctly formatted template literal
            chatDiv.innerHTML = `
                <div class="user-logo">
                    <img src="/storage/user/${otherUser.photo}" alt="${otherUser.name}">
                </div>
                <div class="">
                    <h4>${otherUser.name}</h4>
                    <p>${message.message}</p>
                </div>
                <div class="chat-time-detail">
                    <p class="chat-time">${chatTime}</p>
                </div>
            `;

            // Append the chatDiv to the inboxContainer
            inboxContainer.appendChild(chatDiv);
        });

       
    })
    .catch(error => {
        console.error('Error:', error);
    }); // end of fetch
}
function loadMessagesOnScroll(){
    inboxContainer.addEventListener("scroll", () => {
      
            page++;
            inbox();
   
    })
}
inbox(); // Call the function to load the chats
loadMessagesOnScroll();
