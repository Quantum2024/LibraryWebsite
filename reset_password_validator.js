//change password validate
$(document).ready(function () {
    $("#resetPasswordForm").validate({
        rules: {
            new_password: {
                required: true,
                minlength: 8
            },
            retype_password: {
                required: true,
                minlength: 8,
                equalTo: "#new_password"
            }
        },
        messages: {
            new_password: {
                required: "Please enter a password",
                minlength: "Password must be at least 8 characters long"
            },
            retype_password: {
                required: "Please re-enter password",
                equalTo: "Passwords must match."
            }
        },
    });

    $('#resetPasswordModal').on('shown.bs.modal', function () {
        // Trigger form validation when the modal is shown
        $("#resetPasswordForm").valid();
    });

    $('input').on('blur keyup', function () {
        if ($("#resetPasswordForm").valid()) {
            $('#changePasswordButton').prop('disabled', false);
        } else {
            $('#changePasswordButton').prop('disabled', 'disabled');
        }
    });
});