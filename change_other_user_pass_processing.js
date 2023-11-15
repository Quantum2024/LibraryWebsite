$(document).ready(function () {
    $('#resetPasswordModal').on('show.bs.modal', function (e) {
        // get information to update quickly to modal view as loading begins
        var opener = e.relatedTarget; //this holds the element who called the modal

        //we get details from attributes
        var user_id = $(opener).attr('user_id');

        //set what we got to our form
        $('#resetPasswordForm').find('[name="user_id"]').val(user_id);

    });
    $('#changePasswordButton').click(function () {
        Swal.fire({
            title: "Are you sure you want to change this user's password? ",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Save",
            denyButtonText: `Don't save`
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                // Continue with the processing SweetAlert
                Swal.fire({
                    title: 'Processing',
                    html: 'Please wait...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });
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
                            // Reset the form
                            $('#resetPasswordForm')[0].reset();
                            $('#resetPasswordModal').modal('hide');
                            updateUsersTable();
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
            } else {
                Swal.fire("Changes are not saved", "", "info");
            }
        });
    });
});
