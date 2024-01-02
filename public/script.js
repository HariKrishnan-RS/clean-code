// fetch("http://localhost:8080/api/posts")
//     .then((response) => response.json())
//     .then((posts) => {
//         const postsContainer = document.getElementById("card-pack");
//
//         posts.forEach((post) => {
//             const card = document.createElement("div");
//             card.classList.add("card");
//
//             const cardImg = document.createElement("img");
//             cardImg.classList.add("card-img");
//             cardImg.classList.add("card-img-top");
//             cardImg.src = "images/post-img.jpg"; // Replace with your image source
//             cardImg.alt = "Placeholder Image";
//
//             const cardBody = document.createElement("div");
//             cardBody.classList.add("card-body");
//
//             const title = document.createElement("h5");
//             title.classList.add("card-title");
//             title.textContent = post.title;
//
//             const smallDescription = document.createElement("p");
//             smallDescription.classList.add("card-text");
//             smallDescription.textContent = post.small_description;
//
//             const readButton = document.createElement("a");
//             readButton.classList.add("btn", "btn-primary");
//             readButton.href = "blog/read/" + post.id;
//             readButton.textContent = "Read";
//
//             // Append elements to the card
//             card.appendChild(cardImg);
//             cardBody.appendChild(title);
//             cardBody.appendChild(smallDescription);
//             cardBody.appendChild(readButton);
//             card.appendChild(cardBody);
//
//             // Append the card to the container
//             if (post.approved) {
//                 postsContainer.appendChild(card);
//             }
//         });
//     })
//     .catch((error) => {
//         console.error("Error fetching posts:", error);
//     });
// Function to save selected tag IDs to local storage
function saveSelectedTags() {
    const checkboxes = document.querySelectorAll('.btn-check');
    const selectedTags = [];
    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            selectedTags.push(checkbox.value);
        }
    });
    localStorage.setItem('selectedTags', JSON.stringify(selectedTags));
}

function loadSelectedTags() {
    const selectedTags = JSON.parse(localStorage.getItem('selectedTags'));
    if (selectedTags) {
        selectedTags.forEach(function(tagId) {
            const checkbox = document.getElementById(`tag_${tagId}`);
            if (checkbox) {
                checkbox.checked = true;
            }
        });
    }
}


window.addEventListener('load', function() {
    loadSelectedTags();
});
document.getElementById('searchButton').addEventListener('click', function() {
    saveSelectedTags();
});


function decodeToken(token) {
    const base64Url = token.split('.')[1]; // Extract the payload part of the JWT
    const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/'); // Fix URL encoding
    const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join('')); // Decode base64 and parse JSON

    return JSON.parse(jsonPayload); // Return the decoded payload as a JavaScript object
}

// Replace with your actual JWT token
// const decodedToken = decodeToken(localStorage.getItem('jwtToken'));





$(document).ready(function() {
    $('.readbtn').click(function(e) {
        e.preventDefault();
        console.log("read button");
        // debugger;
        var jwtToken = localStorage.getItem('jwtToken');
        if(jwtToken){
            $.ajax({
                url: 'http://localhost:8080/api/v1/blog/7',
                method: 'GET',
                    headers: {"Authorization": "Bearer "+localStorage.getItem('jwtToken')},
                success: function(response) {
                    window.open().document.write(response);
                },
                error: function(error) {
                    console.error('Error making GET request:', error);
                }
            });
        }
        else {
            $.ajax({
                href: 'http://localhost:8080/api/v1/login',
                method: 'GET',
                success: function(response) {
                    window.open('http://localhost:8080/api/v1/login');
                },
                error: function(error) {
                    console.error('Error making GET request:', error);
                }
            });

        }

    });

    if(localStorage.getItem('jwtToken')) {
        let decodedToken =  decodeToken(localStorage.getItem('jwtToken'));
        if (decodedToken && decodedToken.role === 'admin') {
            $('#welcomeMessage').text('Welcome Admin!');
        } else if (decodedToken && decodedToken.role === 'editor') { debugger;
            $('#welcomeMessage').text('Welcome Editor!');
        } else if (decodedToken) {
            $('#welcomeMessage').text('Welcome User: ' + decodedToken.name);
        } else {
            $('#welcomeMessage').text('Welcome Guest!');
        }
    }


});

// $(document).ready(function() {
//     $(document).on('click', '#remember', function(e) {
//         e.preventDefault();
//         debugger;
//         console.log("Reached here");
//         // Your AJAX code or any other functionality
//     });
// });



// var token = response.token;
// if (token) {
//     localStorage.setItem('jwtToken', token);
//     console.log('JWT token saved to local storage:', token);
// } else {
//     console.error('No token found in the response.');
// }