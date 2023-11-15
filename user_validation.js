$(document).ready(function () {
    //create user validate
    $("#create_user_form").validate({
        rules: {
            first_name: "required",
            last_name: "required",
            email: {
                required: true,
                email: true
            },
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
            first_name: "Please enter user's first name",
            last_name: "Please enter user's last name",
            email: {
                required: "Please enter an email address",
                email: "Please enter a valid email address"
            },
            new_password: {
                required: "Please enter a password",
                minlength: "Password must be at least 8 characters long"
            },
            retype_password: {
                required: "Please re-enter password",
                equalTo: "Passwords must match."
            },
            user_type: "Please enter user type"
        },
    });

    $('#createUserModal').on('shown.bs.modal', function() {
        // Trigger form validation when the modal is shown
        $("#create_user_form").valid();
    });

    $('input').on('blur keyup', function () {
        if ($("#create_user_form").valid()) {
            $('#submit_new_user').prop('disabled', false);
        } else {
            $('#submit_new_user').prop('disabled', 'disabled');
        }
    });

    //change password validate
    $("#resetPasswordForm").validate({
        rules: {
            reset_new_password: {
                required: true,
                minlength: 8
            },
            reset_retype_password: {
                required: true,
                minlength: 8,
                equalTo: "#reset_new_password"
            }
        },
        messages: {
            reset_new_password: {
                required: "Please enter a password",
                minlength: "Password must be at least 8 characters long"
            },
            reset_retype_password: {
                required: "Please re-enter password",
                equalTo: "Passwords must match."
            }
        },
    });

    $('#resetPasswordModal').on('shown.bs.modal', function() {
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