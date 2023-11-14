<?php
include 'db_connection.php';
include 'session_check.php';
if ($_GET["book_isbn"]) {
    $book_isbn = $_GET["book_isbn"];
    // Step 2: Query the database for copies of books
    $query = "SELECT c.copy_id, c.supplier_name, c.unit_price, c.published_date, c.book_condition, l.due_date, l.date_checked_in FROM  `copy` AS c
            LEFT JOIN (
                        SELECT copy_id, MAX(date_checked_out) AS recent_date_checked_out
                        FROM loan_log GROUP BY copy_id) most_recent ON c.copy_id = most_recent.copy_id
            LEFT JOIN loan_log AS l ON c.copy_id = l.copy_id AND l.date_checked_out = most_recent.recent_date_checked_out
            LEFT JOIN book AS b ON b.book_isbn = c.book_isbn
            WHERE b.book_isbn = " . $book_isbn . ";";
    $copy_result = $mysqli->query($query);

    if ($copy_result->num_rows == 0) {
        echo "<tr><td >No Copies</td>";
        echo "<td ></td>";
        echo "<td ></td>";
        echo "<td ></td>";
        echo "<td ></td>";
        echo "<td ></td></tr>";
    } else {
        while ($row = $copy_result->fetch_assoc()) {
            $i = 0;
            $copy_id = $row["copy_id"];
            $supplier_name = $row["supplier_name"];
            $unit_price = $row["unit_price"];
            $published_date = $row["published_date"];
            $book_condition = $row["book_condition"];
            $due_date = $row["due_date"];
            $date_checked_in = $row["date_checked_in"];
            echo "<tr>";
            echo '<td>' . $copy_id . '
            <a href=# id="copy' . $i . '"data-bs-toggle="modal" 
            copy_id="' . $copy_id . '"
            condition="' . $row["book_condition"] . '"
            supplier_name="' . $supplier_name . '"
            unit_price="' . $unit_price . '" 
            published_date="' . $published_date . '"
            data-bs-target="#editCopyModal">' . '<i class="fa-solid fa-pencil"></i></a></td>';
            echo "<td>" . $supplier_name . "</td>";
            echo "<td>" . $unit_price . "</td>";
            echo "<td>" . date("m/d/Y", strtotime($published_date)) . "</td>";
            echo "<td>" . $book_condition . "</td>";
            $i++;
            if ($date_checked_in === null) {
                $current_date = date("m/d/Y");
                if (strtotime($due_date) >= strtotime($current_date)) {
                    $badge = '<td><span class="badge badge-warning">Borrowed</span></td>';
                } else {
                    $badge = '<td><span class="badge badge-danger">Overdue</span></td>';
                }
            } else {
                $badge = '<td><span class="badge badge-success">Returned</span></td>';
            }
            echo $badge;
            echo "</tr>";
        }
    }
    $mysqli->close();
} else {
    $response = array('error' => 'No Book ISBN specified!');
    http_response_code(500); // Set HTTP status code to indicate an error
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>