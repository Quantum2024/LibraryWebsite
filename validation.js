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

    
});