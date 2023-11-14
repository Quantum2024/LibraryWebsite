var table = $('#user-table').DataTable({
    "dom": 'frtip',
    "buttons": [
        'excel',
        'pdf',
        'print'
    ],
    "paging": false,
    "info": false,
});

$(document).ready(function () {
    function updateUsersTable() {
        $("#users-table-body").load("get_users_table.php");
    }



    updateUsersTable();
    // Handle form submission
    $('#create_user_form').submit(function (event) {
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
                    url: 'create_user_processor.php',
                    data: $('#create_user_form').serialize(),
                    success: function (response) {
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
                            $('#create_user_form')[0].reset();
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
