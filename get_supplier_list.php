<?php include 'db_connection.php';
// Fetch suppliers from the database
$supplierQuery = "SELECT supplier_name FROM supplier";
$supplierResult = mysqli_query($mysqli, $supplierQuery);

if ($supplierResult) {
    while ($row = mysqli_fetch_assoc($supplierResult)) {
        echo "<option value='" . $row['supplier_name'] . "'>" . $row['supplier_name'] . "</option>";
    }
} else {
    echo "Error: " . mysqli_error($mysqli);
}
?>