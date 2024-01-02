$(document).ready(function() {
    $('.register-page-btn').click(function(e) {
        e.preventDefault();
        window.open('http://localhost:8080/register');
    });

    $('.loginbtn').click(function(e) {
        e.preventDefault();

        var email = $('#email').val();
        var password = $('#password').val();
        var loginData = {
            "email": email,
            "password": password
        };
        $.ajax({
            url: 'http://localhost:8080/api/v1/login',
            method: 'POST',
            data: loginData,
            success: function(response) {
                if (response.token) {
                    localStorage.setItem('jwtToken', response.token);
                    console.log('JWT token saved to local storage:', response.token);
                    window.open('http://localhost:8080/blogs');

                } else {
                    console.error('No token found in the response.');
                }
            },
            error: function(error) {
                console.error('Error making GET request:', error);
            }
        });
    });

});