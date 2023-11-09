$(document).ready(function () {
    // Function to display the success modal
    function displaySuccessModal(dataType) {
        $("#successMessage").html(dataType + " Added Successfully"); // Set the success message
        $("#successModal").modal("show");
    }

    // Function to update supplier options
    function updateSupplierOptions() {
        console.log("Making AJAX request to get_supplier_list.php");
        $.ajax({
            type: "GET",
            url: "get_supplier_list.php", // PHP script to fetch the updated list of suppliers
            success: function (data) {
                console.log(data); // Log the response data to the console
                // Replace the options in the select element with the updated data
                $("#supplier_name").html(data);
                $("#supplier_name").select2(); // Initialize select2 after updating the options
            }
        });
    }

    // Click event for the submit button
    $("#submitSupplier").click(function () {
        var supplier_name = $("#new_supplier_name").val();
        var supplier_country = $("#supplier_country").val();
        var supplier_email_address = $("#supplier_email_address").val();
        var supplier_phone_number = $("#supplier_phone_number").val();

        var dataType = "Supplier"; // Define dataType for Supplier

        // Show processing message
        $("#processingMessage2").show();

        $.ajax({
            type: "POST",
            url: "insert_data_new_supplier.php",
            data: {
                supplier_name: supplier_name,
                supplier_country: supplier_country,
                supplier_email_address: supplier_email_address,
                supplier_phone_number: supplier_phone_number,
                dataType: dataType // Pass dataType parameter
            },
            success: function (data) {
                // Hide processing message
                $("#processingMessage2").hide();
                // Hide the current modal
                $("#newSupplier").modal('hide');
                updateSupplierOptions(); // Call the function to update the supplier options
                displaySuccessModal(dataType);
                $("#supplierSuccessMessage").html("New Supplier added successfully!");
                // Select the element
                var supplierSuccessMessage = document.getElementById("supplierSuccessMessage");

                // Hide the element after 5 seconds
                setTimeout(function () {
                    supplierSuccessMessage.style.display = "none";
                }, 5000); // 5000 milliseconds (5 seconds)

                // Reset the form
               
                $("#newSupplierForm")[0].reset();
                
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Error: " + errorThrown);
            }
        });
    });

    // Initialize select2 for supplier outside the click event
    $("#supplier_name").select2();
    updateSupplierOptions(); // Populate suppliers upon loading completion
});
