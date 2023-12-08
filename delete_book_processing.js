//Delete User Functions
function isValueInTable(tableId, value) {
    var table = document.getElementById(tableId);
    var rows = table.getElementsByTagName('tr');
    if (rows[1].getElementsByTagName('td').length == 1) {
        return false;
    }
    
    for (var i = 1; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        if (cells[5].innerHTML.includes(value)) {
            return true;
        }

    }

    return false;
}

function deleteBook(button) {
    if (isValueInTable('copies-table', 'Overdue') || isValueInTable('copies-table', 'Borrowed')) {
        console.log("entered");
        Swal.fire({
            title: 'Cannot Delete Book',
            text: 'A Book cannot be deleted if any of it\'s copies are overdue or borrowed.',
            icon: "error",
            allowOutsideClick: false,
            showConfirmButton: false,
            showCancelButton: true,
        });
    } else {
        // Display processing message using SweetAlert
        // Display a confirmation SweetAlert
        Swal.fire({
            title: "Are you sure you want to PERMINANTLY DELETE this book, all of its copies, and any records related to this book (including loan history)? ",
            showDenyButton: true,
            icon: "warning",
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
                    url: 'delete_book_processor.php', // Your PHP script handling the form submission
                    data: {
                        book_isbn: button.getAttribute('book_isbn')
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
                            setTimeout(function () {
                                window.location.href = "inventory.php";
                            }, 3000); // 3000 milliseconds = 3 seconds
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
                Swal.fire("Book Not Deleted", "", "info");
            }
        });
    };
};