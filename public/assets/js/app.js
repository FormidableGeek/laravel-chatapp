let searchInput = document.getElementById('search');
let searchTrigger = document.querySelectorAll('.search-trigger');
let modal = document.querySelector(".modal");
let modalContent = document.querySelector(".modal-content");
let searchResult = document.querySelector(".search-result");
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');



// Loop through each element with the class "search-trigger" and add an event listener
searchTrigger.forEach(trigger => {
    trigger.addEventListener("click", (event) => {
        if (modal) {
            modalSwitch=1;
            modal.style.display = "flex";
        }
    });
});
modal.addEventListener("click", (event) => {

    if (event.target !== modalContent && !modalContent.contains(event.target)) {
        modal.style.display = "none";
    }
});


searchInput.addEventListener("keyup", () => {
    fetch('/fetch/users', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN':csrfToken

        },
        body: JSON.stringify({
            data: searchInput.value
        })
    })
    .then(response => response.json())
    .then(data => {
        let item=`<li>No matching result</li>`;

        if(data.status=="success"){
            searchResult.innerHTML="";
            let users=data.data;
            users.forEach(element => {
                item=`<a href="/chat/${element.id}"><li>Name: ${element.name} <br>
                 Email:${element.email}</li></a>`;
                
            });
            
            
        }else{ 
    }
        searchResult.insertAdjacentHTML('beforeend', item);

        
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

