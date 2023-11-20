$(document).ready(function () {
    //create user validate
    $("#newBookForm").validate({
        rules: {
            book_isbn:{
                required: true,
                min: 1000000000000,
                max: 9999999999999,
                digits: true
            },
            book_title: "required",
            edition:{
                required: true,
                min: 1,
                digits: true
            },
            num_of_pages:{
                required: true,
                min: 0,
                digits: true
            }
        },
        messages: {
            book_isbn:{
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

    $("#newBookForm").valid();
    

    $('input').on('blur keyup', function () {
        if ($("#newBookForm").valid()) {
            $('#bookSubmission').prop('disabled', false);
        } else {
            $('#bookSubmission').prop('disabled', 'disabled');
        }
    });

       // New author form validation
       $("#newAuthorForm").validate({
        rules: {
            author_first_name: {
                required: true,
                minlength: 2,
            },
            author_last_name: {
                required: true,
                minlength: 2,
            },
        },
        messages: {
            author_first_name: {
                required: "Please enter Author's first name",
                minlength: "Author's first name must be at least 2 characters",
            },
            author_last_name: {
                required: "Please enter Author's last name",
                minlength: "Author's last name must be at least 2 characters",
            },
        },
    });

     
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

    // Handle blur and keyup events for specific input elements
    $('#newAuthorForm input').on('blur keyup', function () {
        if ($("#newAuthorForm").valid()) {
            $('#submitAuthor').prop('disabled', false);
        } else {
            $('#submitAuthor').prop('disabled', true);
        }
});
});