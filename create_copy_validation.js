  //////Validation//////
  $("#newCopyForm").validate({
    rules: {
        supplier_name: {
            required: true,
            minlength: 2,
        },
        published_date: {
            required: true,
        },
        unit_price: {
            required: true,
            number: true,
            min: 0,
        },
        book_condition: {
            required: true,
        },
    },
    messages: {
        supplier_name: {
            required: "Please enter the supplier name",
            minlength: "Supplier name must be at least 2 characters",
        },
        published_date: {
            required: "Please enter the published date",
        },
        unit_price: {
            required: "Please enter the unit price",
            number: "Please enter a valid number",
            min: "Unit price cannot be negative",
        },
        book_condition: {
            required: "Please select the book condition",
        },
    },
    
    
});

// Handle blur and keyup events for specific input elements
$('#newCopyForm input, #newCopyForm select').on('blur keyup change', function () {
    if ($("#newCopyForm").valid()) {
        $('#copySubmission').prop('disabled', false);
    } else {
        $('#copySubmission').prop('disabled', 'disabled');
    }
});

// Handle the submit button state when the page loads
if ($("#newCopyForm").valid()) {
    $('#copySubmission').prop('disabled', false);
} else {
    $('#copySubmission').prop('disabled', 'disabled');
}
