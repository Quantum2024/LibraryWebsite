document.addEventListener("DOMContentLoaded", function () {
    // Get the phone number input element
    const phoneNumberInput = document.getElementById("phone_number");

    // Add an event listener to the input element
    phoneNumberInput.addEventListener("input", function () {
        // Get the input value
        let inputValue = phoneNumberInput.value;

        // Remove any non-digit characters
        inputValue = inputValue.replace(/\D/g, "");

        // Check if the input value is empty
        if (inputValue.length === 0) {
            phoneNumberInput.value = "";
        } else {
            // Format the phone number
            phoneNumberInput.value = formatPhoneNumber(inputValue);
        }
    });

    // Function to format the phone number
    function formatPhoneNumber(value) {
        const formattedValue = value.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
        return formattedValue;
    }
});

$(document).ready(function () {
    // Handle form submission
    $('#submit_form').on('click', function () {
        // Display a confirmation SweetAlert
        Swal.fire({
            title: "Do you want to save the changes?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Save",
            denyButtonText: `Don't save`
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
                    url: 'edit_member_processor.php',
                    data: $('#editMemberForm').serialize(),
                    success: function (response) {
                        console.log(response);
                        Swal.close(); // Close the loading SweetAlert

                        // Check if the response indicates success
                        if (response.success) {
                            Swal.fire({
                                title: 'Success',
                                text: response.success,
                                icon: 'success',
                                confirmButtonClass: 'swal2-confirm'
                            });
                        } else if (response.error) {
                            Swal.fire({
                                title: 'Error',
                                text: response.error,
                                icon: 'error',
                                confirmButtonClass: 'swal2-confirm'
                            });
                        } else {
                            // Handle unexpected response
                            console.error('Unexpected response:', response);
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

    var table = $('#loan-table').DataTable({
        "dom": 'frtip',
        "buttons": [
            'excel',
            'pdf',
            'print'
        ],
        "paging": false,
        "info": false,
    });

    var buttons = new $.fn.dataTable.Buttons(table, {
        buttons: [
            'excel',
            'pdf',
            'print'
        ]
    }).container().appendTo($('.export-options'));
});
