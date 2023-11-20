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
            },
            language: "required",
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
            },
            language:"Required",
                
            
        }
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