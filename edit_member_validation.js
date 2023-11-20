$(document).ready(function () {
    $("#editMemberForm").validate({
        rules: {
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            DOB: "required",
            published_date: {
                required: true,
            },
            phone_number: {
                required: true,
                phoneUS: true
            },
            email_address: {
                required: true,
                email: true
            }
        },
        messages: {
            first_name: {
                required: "Required",
            },
            last_name: {
                required: "Required",
            },
            DOB: {
                required: "Required",
            },
            published_date: {
                required: "Required",
            },
            phone_number: {
                required: "Required",
                phoneUS: "Please enter a valid U.S. phone number.",
            },
            email_address: {
                required: "Required",
                email: "Please enter a valid email address.",
            },
        },
    });

    $.validator.addMethod(
        "phoneUS",
        function (phone_number, element) {
            phone_number = phone_number.replace(/\s+/g, "");
            return (
                this.optional(element) ||
                phone_number.match(
                    /^(1\s?)?(\([0-9]{3}\)|[0-9]{3})[\s\-]?[0-9]{3}[\s\-]?[0-9]{4}$/
                )
            );
        },
        "Please enter a valid U.S. phone number."
    );


    $("#editMemberForm").valid();

    $("#editMemberForm input").on('blur keyup', function () {
        if ($("#editMemberForm").valid()) {
            $('#submit_form').prop('disabled', false);
        } else {
            $('#submit_form').prop('disabled', true);
        }
    });
});
