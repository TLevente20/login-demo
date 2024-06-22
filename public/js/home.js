$(document).ready(function() {

    //Get token from local storage
    const token = localStorage.getItem('jwt');

    // Validate token on page load
    if (!token) {
        window.location.href = '/login'; // Redirect if token is missing
    } else {
        $.ajax({
            type: 'POST',
            url: '/validate-token',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function(response) {

                if (typeof response === 'string') {
                    response = JSON.parse(response);
                }
                
                if (response.status !== 'success') {

                    // Redirect if token is invalid
                    window.location.href = '/login';
                }
            },
            error: function(xhr, status, error) {

                // Redirect on error
                window.location.href = '/login'; 
            }
        });
    }


    // Function to refresh token
    function refreshToken() {

        // Get the current token from localStorage
        const currentToken = localStorage.getItem('jwt');
        $.ajax({
            type: 'POST',
            url: '/refresh-token',
            headers: {
                'Authorization': 'Bearer '+ currentToken 
            },
            
            success: function(response) {

                //Parsing JSON
                if (typeof response === 'string') {
                    response = JSON.parse(response);
                }

                // Check if response contains new token
                if (response.token) {
                    localStorage.setItem('jwt', response.token); // Store the new token
                    console.log('Token is refreshed');
                } else {
                    console.error('Failed to refresh token.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error refreshing token:', error);
            }
        });
    }

    $(document).ready(function() {

        // Function to handle click on refresh token link
        $('#navigate').on('click', function(e) {
            e.preventDefault(); 

            // Call refreshToken function from refreshToken.js
            refreshToken();
        });
    });

    // Refresh token every 30 seconds
    setInterval(refreshToken, 30000);
});

