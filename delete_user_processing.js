
function updateUsersTable() {
    $("#users-table-body").load("get_users_table.php");
}
function deleteUser(link) {

    // Display processing message using SweetAlert
    // Display a confirmation SweetAlert
    Swal.fire({
        title: "Are you sure you want to PERMANENTLY DELETE this user? ",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Delete",
        denyButtonText: `Don't Delete`
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
            // Perform AJAX request
            $.ajax({
                type: 'POST',
                url: 'delete_user_processor.php', // Your PHP script handling the form submission
                data: {
                    user_id: link.getAttribute('user_id')
                },
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
            Swal.fire("User Not Deleted", "", "info");
        }
    });
};
