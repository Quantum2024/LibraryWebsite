<?php
// Include the database connection
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the HTML form
    $supplier_name = $_POST['supplier_name'];
    $supplier_country = $_POST['supplier_country'];
    $supplier_email_address = $_POST['supplier_email_address'];
    $supplier_phone_number = $_POST['supplier_phone_number'];

    // Insert data into the "publisher" table
    $insertSupplierQuery = "INSERT INTO supplier (supplier_name, supplier_country, supplier_email_address, supplier_phone_number) VALUES (?, ?, ?, ?)";

    $stmtSupplier = $mysqli->prepare($insertSupplierQuery);
    $stmtSupplier->bind_param("sssi", $supplier_name, $supplier_country, $supplier_email_address, $supplier_phone_number);

    // Execute the prepared statement
    if ($stmtSupplier->execute()) {
        echo "Supplier data inserted successfully.";

    } else {
        echo "Error: " . $mysqli->error;
    }

    // Close the prepared statement and the database connection
    $stmtSupplier->close();
    $mysqli->close();
}
?>
