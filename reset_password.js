$(document).ready(function () {
    $('#changePasswordButton').click(function () {
       
        console.log($(this).serialize());

        // Display processing message using SweetAlert
        Swal.fire({
            title: 'Processing...',
            text: 'Please wait',
            allowOutsideClick: false,
            showConfirmButton: false,
            onBeforeOpen: () => {
                Swal.showLoading();
            },
        });

        // Perform AJAX request
        $.ajax({
            type: 'POST',
            url: 'insert_data_new_password.php', // Your PHP script handling the form submission
            data: $('#resetPasswordForm').serialize(), // Serialize the form data 
            success: function (response) {
                // Close the processing SweetAlert
                Swal.close();

                // Handle the response from the server
                if (response.includes('success')) {
                    // Display success message using SweetAlert
                    Swal.fire({
                        title: 'Success',
                        text: response,
                        icon: 'success',
                        confirmButtonClass: 'swal2-confirm'
                    });
                } else {
                    // Display error message using SweetAlert
                    Swal.fire({
                        title: 'Error',
                        text: response,
                        icon: 'error',
                        confirmButtonClass: 'swal2-confirm'
                    });
                }
            },
            error: function (xhr, status, error) {
                // Close the processing SweetAlert
                Swal.close();

                // Handle AJAX error
                console.error(xhr.responseText);
            }
        });
    });
});