$(document).ready(function () {
    var table = $('#check_out-table').DataTable({
        "dom": "<'dataTables_wrapper dt-bootstrap no-footer' ft>",
        "buttons": [
            'excel',
            'pdf',
            'print'
        ],
        "paging": false,
        "info": false,
        "ajax": {
            "url": "get_checkout_table.php",
            "dataSrc": "" // Use an empty string to indicate that the data array is at the root of the returned JSON
        },
        "columns": [
            { "data": "copy_id" },
            { "data": "book_title" },
            { "data": "authors" },
            { "data": "check_out_button" }
        ],
        responsive: true
    });

    var buttons = new $.fn.dataTable.Buttons(table, {
        buttons: [
            'excel',
            'pdf',
            'print'
        ]
    }).container().appendTo($('.export-options'));

    $('#checkout_button').on('click', function () {
        // Display a confirmation SweetAlert
        Swal.fire({
            title: "Are you sure you want to check out this book?",
            text: "Please make sure that all of the information in the form is correct.",
            showDenyButton: true,
            confirmButtonText: "Check-Out",
            denyButtonText: `Cancel`
        }).then((result) => {
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

                console.log("Sending Ajax");

                // Use AJAX to submit the form
                $.ajax({
                    type: 'POST',
                    url: 'check_out_processor.php',
                    data: $('#modalForm').serialize(),
                    success: function (response) {
                        console.log(response);
                        Swal.close(); // Close the loading SweetAlert

                        // Check if the response indicates success
                        // Check if the response indicates success
                        if (response.includes('successfully')) {
                            // Display a success SweetAlert with the blue button
                            Swal.fire({
                                title: 'Success',
                                text: 'Data submitted successfully',
                                icon: 'success',
                                confirmButtonClass: 'swal2-confirm'
                            });
                            $('#checkOutModal').modal('hide');
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                            $('#modalForm')[0].reset();
                            table.ajax.reload();
                        } else {
                            // Display an error SweetAlert with the blue button
                            Swal.fire({
                                title: 'Error',
                                text: 'Book Check-In Failed',
                                icon: 'error',
                                confirmButtonClass: 'swal2-confirm'
                            });
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log("Error: " + errorThrown);
                        Swal.fire({
                            title: 'Error',
                            text: 'Data submission failed',
                            icon: 'error',
                            confirmButtonClass: 'swal2-confirm'
                        });
                    }
                }).fail(function (error) {
                    console.error(error);
                });
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        });
    });
});
