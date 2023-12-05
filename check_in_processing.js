$(document).ready(function () {

    var table = $('#check_in-table').DataTable({
        "dom": "<'dataTables_wrapper dt-bootstrap no-footer' ft>",
        "buttons": [
            'excel',
            'pdf',
            'print'
        ],
        "paging": false,
        "info": false,
        "ajax": {
            "url": "get_check_in_table.php",
            "dataSrc": "" // Use an empty string to indicate that the data array is at the root of the returned JSON
        },
        "columns": [
            {"data": "loan_log_id"},
            {"data": "copy_id"},
            {"data": "book_title"},
            {"data": "authors"},
            {"data": "member_name"},
            {"data": "due_date"},
            {"data": "check_in_button"}
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

    $('#checkInModal').on('show.bs.modal', function (e) {
        // get information to update quickly to modal view as loading begins
        var opener = e.relatedTarget;//this holds the element who called the modal

        //we get details from attributes
        var loan_log_id = $(opener).attr('loan_log_id');
        var copy_id = $(opener).attr('copy_id');
        var loaned_condition = $(opener).attr('loaned_condition');

        //set what we got to our form
        $('#modalForm').find('[name="loan_log_id"]').val(loan_log_id);
        $('#modalForm').find('[name="copy_id"]').val(copy_id);
        $('#modalForm').find('[name="loaned_condition"]').val(loaned_condition);
        $('#modalForm').find('[id="condition_returned"]').val(loaned_condition);

    });

    $("#checkInModal").on("hidden.bs.modal", function () {
        $('body').css('padding-right', 0);
    });

    $('#check_in_table_submit').on('click', function () {
        // Display a confirmation SweetAlert
        Swal.fire({
            title: "Are you sure you want to check in this book?",
            text: "Please make sure that you are checking in the correct book.",
            showDenyButton: true,
            confirmButtonText: "Check-In",
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
                    url: 'check_in_processor.php',
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
                            });
                            $('#checkInModal').modal('hide');
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                            $('#modalForm')[0].reset();
                            console.log("Reloading Table");
                            table.ajax.reload();
                            console.log("table successfully reloaded");
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