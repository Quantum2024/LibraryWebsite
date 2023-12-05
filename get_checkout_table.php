<?php
include 'db_connection.php';
// Step 2: Query the database for book information
$query = "SELECT c.copy_id, b.book_isbn, c.book_condition, b.book_title
FROM `copy` AS c
JOIN book AS b ON b.book_isbn = c.book_isbn;";
$copy_result = $mysqli->query($query);

$rows = array();
$rowData[] = array();
while ($row = $copy_result->fetch_assoc()) {
    //check to see if book is checked out already
    $query = "SELECT *
FROM `loan_log` AS l
WHERE l.date_checked_in IS NULL AND l.copy_id=" . $row["copy_id"] . ";";
    $copies_checked_out = $mysqli->query($query);
    //if the query returns any values, the copy is checked out, so it should be skipped
    if ($copies_checked_out->num_rows > 0) {
        continue;
    }
    $rowData["copy_id"] = $row['copy_id'];
    $rowData["book_title"] = $row['book_title'];

    //query the wrote table for authors
    $query = "SELECT a.author_first_name, a.author_last_name, a.author_id
FROM author AS a
JOIN wrote AS w ON a.author_id= w.author_id
JOIN book AS b ON b.book_isbn = w.book_isbn
WHERE b.book_isbn=" . $row['book_isbn'] . ";";
    $author_result = $mysqli->query($query);
    if (mysqli_num_rows($author_result) == 0) {
        $authors = "No Authors Found";
    } else {
        $authors = "";
        while ($rowA = $author_result->fetch_assoc()) {
            $authors .= $authors . "<a href=edit_author.php?author_id=" . $rowA['author_id'] . ">" . $rowA["author_first_name"] . " " . $rowA["author_last_name"] . "<br>";
        }
    }
    $rowData["authors"] = $authors;
    $rowData["check_out_button"] = '<button type="button" class="btn btn-danger btn-sm" 
data-bs-toggle="modal" copy_id="' . $row["copy_id"] . '"
loaned_condition="' . $row["book_condition"] . '" data-bs-target="#checkOutModal">Check
Out</button>';
    $rows[] = $rowData;
}
header('Content-Type: application/json');
echo json_encode($rows);
$mysqli->close();
?>