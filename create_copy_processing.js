$(document).ready(function() {
    // Handle form submission
    $('#newCopyForm').submit(function(event) {
        event.preventDefault();

        // Display a loading SweetAlert while processing
        Swal.fire({
            title: 'Processing',
            html: 'Please wait...',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });

        // Use AJAX to submit the form
        $.ajax({
            type: 'POST',
            url: 'insert_data_new_copy.php',
            data: $('#newCopyForm').serialize(),
            success: function(response) {
                // Close the loading SweetAlert
                Swal.close();

                // Check if the response indicates success
                if (response.includes('successfully')) {
                    // Display a success SweetAlert with the blue button
                    Swal.fire({
                        title: 'Success',
                        text: 'Data submitted successfully',
                        icon: 'success',
                        confirmButtonClass: 'swal2-confirm'
                    });
                    // Reset the form
                    $('#newCopyForm')[0].reset();
                } else {
                    // Display an error SweetAlert with the blue button
                    Swal.fire({
                        title: 'Error',
                        text: 'Data submission failed',
                        icon: 'error',
                        confirmButtonClass: 'swal2-confirm'
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Close the loading SweetAlert
                Swal.close();
                
                // Log the error to the console
                console.log("Error: " + errorThrown);

                // Display an error SweetAlert with the blue button
                Swal.fire({
                    title: 'Error',
                    text: 'Data submission failed',
                    icon: 'error',
                    confirmButtonClass: 'swal2-confirm'
                });
            }
        }).fail(function(error) {
            // Log the error to the console
            console.error(error);
        });
    });
});
