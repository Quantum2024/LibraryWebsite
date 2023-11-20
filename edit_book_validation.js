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

    

     //Author Modal Validation
    $("#newAuthorForm").validate({
        rules: {
            author_first_name: "required",
            author_last_name: "required",
        },
        messages: {
            author_first_name: "Please enter Author's first name",
            author_last_name: "Please enter Author's last name",
        },
    });

    // Trigger form validation when the modal is shown
    $('#NewAuthor').on('shown.bs.modal', function () {
        // Enable the Save button if the form is valid
        if ($("#newAuthorForm").valid()) {
            $('#submitAuthor').prop('disabled', false);
        } else {
            $('#submitAuthor').prop('disabled', true);
        }
    });


   // Validate newPublisherForm
   $("#newPublisherForm").validate({
    rules: {
        publisher_name: {
            required: true,
            minlength: 2,
        },
        publisher_country: {
            required: true,
            minlength: 2,
        },
        email_address: {
            required: true,
            email: true,
        },
        phone_number: {
            required: true,
            minlength: 10,
        },
    },
    messages: {
        publisher_name: {
            required: "Please enter the publisher's name",
            minlength: "Publisher's name must be at least 2 characters",
        },
        publisher_country: {
            required: "Please enter the publisher's country",
            minlength: "Publisher's country must be at least 2 characters",
        },
        email_address: {
            required: "Please enter a valid email address",
            email: "Please enter a valid email address",
        },
        phone_number: {
            required: "Please enter a valid phone number",
            minlength: "Phone number must be at least 10 characters",
        },
    },
   
});


$('#NewPublisher').on('shown.bs.modal', function () {
    if ($("#newPublisherForm").valid()) {
        $('#submitPublisher').prop('disabled', false);
    } else {
        $('#submitPublisher').prop('disabled', 'disabled');
    }
});

//Validate Genre Modal
$("#modalForm").validate({
    rules: {
        genre_name: {
            required: true,
            minlength: 2,
        },
    },
    messages: {
        genre_name: {
            required: "Please enter the genre name",
            minlength: "Genre name must be at least 2 characters",
        },
    },
    
});


$('#NewGenre').on('shown.bs.modal', function () {
    if ($("#modalForm").valid()) {
        $('#submitGenre').prop('disabled', false);
    } else {
        $('#submitGenre').prop('disabled', 'disabled');
    }
});
});