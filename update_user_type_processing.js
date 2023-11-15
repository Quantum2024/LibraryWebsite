$(document).ready(function () {
    $('#changeUserTypeModal').on('show.bs.modal', function (e) {
        // get information to update quickly to modal view as loading begins
        var opener = e.relatedTarget; //this holds the element who called the modal

        //we get details from attributes
        var user_id = $(opener).attr('user_id');
        var user_name = $(opener).attr('user_name');
        var user_type = $(opener).attr('user_type');
        //set what we got to our form

        $('#update_user_type_form').find('[name="user_id"]').val(user_id);
        $('#update_user_type_form').find('[name="name"]').val(user_name);
        $('#update_user_type_form').find('[name="user_type_select"]').val(user_type);

    });
    // Handle form submission
    $('#update_user_type_form').submit(function (event) {
        event.preventDefault();

        // Display a confirmation SweetAlert
        Swal.fire({
            title: "Do you want to save the changes?",
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

                // Use AJAX to submit the form
                $.ajax({
                    type: 'POST',
                    url: 'update_type_processor.php',
                    data: $('#update_user_type_form').serialize(),
                    success: function (response) {
                        // Close the loading SweetAlert
                        Swal.close();

                        // Check if the response indicates success
                        if (response.includes('successfully')) {
                            console.log("Success");
                            // Display a success SweetAlert with the blue button
                            Swal.fire({
                                title: 'Success',
                                text: 'Data submitted successfully',
                                icon: 'success',
                                confirmButtonClass: 'swal2-confirm'
                            });
                            // Reset the form
                            $('#update_user_type_form')[0].reset();
                            $('#changeUserTypeModal').modal('hide');
                            updateUsersTable();
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
                    error: function (jqXHR, textStatus, error) {

                        // Log the error to the console
                        console.log("Error: " + error);

                        // Display an error SweetAlert with the blue button
                        Swal.fire({
                            title: 'Error',
                            text: 'Data submission failed',
                            icon: 'error',
                            confirmButtonClass: 'swal2-confirm'
                        });
                    }
                }).fail(function (error) {
                    // Log the error to the console
                    console.error(error);
                });
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        });
    });

});
