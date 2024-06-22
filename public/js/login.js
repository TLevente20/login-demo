$(document).ready(function() {

    $('#loginForm').on('submit', function(e) {
        e.preventDefault(); 

        if($('#hidden').val().trim() === ""){

            /* Send Ajax Request */
            $.ajax({
                type: 'POST',
                url: '/login',
                data: $(this).serialize(),

                //The request succeded
                success: function(response) {
                    if (response.status === 'success') {

                        //Giving JSW Tokens For local storage
                        localStorage.setItem('jwt', response.jwt);
                        localStorage.setItem('refresh_token', response.refresh_token);

                        window.location.href = response.url;
                        
                    } else {

                        // Display error message
                        $('#error-message').text(response.message); 
                    }
                },

                //The request not succeded
                error: function(xhr, status, error) {
                if (xhr.status === 401) {

                    // Handle unauthorized error
                    $('#error-message').text('Invalid email or password');
                } else {

                    // Handle unexpected errors
                    $('#error-message').text('An unexpected error occurred');
                }
            }

            });
        }
        else{
            $('#error-message').text("Hidden input has a value!"); 
        }
    });
});