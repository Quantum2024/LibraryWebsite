$(document).ready(function () {
    // New author form validation
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

    // Handle the submit button state when the modal is hidden
    $('#NewAuthor').on('hidden.bs.modal', function () {
        $('#submitAuthor').prop('disabled', true);
    });
});
