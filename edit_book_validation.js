$(document).ready(function () {
    //create user validate
    $("#edit_book_form").validate({
        rules: {
            book_isbn: {
                required: true,
                min: 1000000000000,
                max: 9999999999999,
                digits: true
            },
            book_title: "required",
            edition: {
                required: true,
                min: 1,
                digits: true
            },
            num_of_pages: {
                required: true,
                min: 0,
                digits: true
            }
        },
        messages: {
            book_isbn: {
                required: "Required",
                min: "ISBN must be 13 numbers long",
                max: "ISBN must be 13 numbers long",
                number: "ISBN cannot contain decimals"
            },
            book_title: "Required",
            edition: {
                required: "Required",
                min: "Edition cannot be less than 1",
                number: "Edition cannot contain decimals"
            },
            author_name: "Required",
            num_of_pages: {
                required: "Required",
                min: "Number of Pages cannot be less than 0",
                number: "Number of Pages must be a whole number"
            }
        },
    });

    $("#copyModalForm").validate({
        rules: {
            unit_price: {
                required: true,
                min: 0,
            },
            supplier: "required",
            published_date: {
                required: true
            },
        },
        messages: {
            unit_price: {
                required: "Required",
                min: "Enter a Valid Price"
            },
            supplier: "Required",
            published_date: {
                required: "Required",
                latest: "Enter a valid date."
            },
        },
    });


    $("#edit_book_form").valid();

    $('#editCopyModal').on('show.bs.modal', function (event) {
        if ($("#copyModalForm").valid()) {
            $('#updateCopyButton').prop('disabled', false);
        } else {
            $('#updateCopyButton').prop('disabled', true);
        }
    });

    $("#edit_book_form input").on('blur keyup', function () {
        if ($("#edit_book_form").valid()) {
            $('#submit-form').prop('disabled', false);
        } else {
            $('#submit-form').prop('disabled', true);
        }
    });

    // Validate the copyModalForm on keyup and blur
    $("#copyModalForm input").on('blur keyup', function () {
        if ($("#copyModalForm").valid()) {
            $('#updateCopyButton').prop('disabled', false);
        } else {
            $('#updateCopyButton').prop('disabled', true);
        }
    });


});