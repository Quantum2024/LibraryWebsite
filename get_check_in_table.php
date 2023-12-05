<?php
include 'db_connection.php';
// Step 2: Query the database for book information
$query = "SELECT c.copy_id, b.book_isbn, c.book_condition, b.book_title, m.first_name, m.last_name, l.due_date, l.loan_log_id
        FROM loan_log AS l
        JOIN `copy` AS c ON l.copy_id = c.copy_id
        JOIN book AS b ON b.book_isbn = c.book_isbn                                                           
        JOIN member AS m ON m.member_id = l.member_id 
        WHERE l.date_checked_in IS NULL;";
$loaned_result = $mysqli->query($query);

$rows = array();
$rowData[] = array();
while ($row = $loaned_result->fetch_assoc()) {
    $i = 0;

    $rowData["loan_log_id"] = $row['loan_log_id'];
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
    $rowData["member_name"] = $row['first_name'] . " " . $row["last_name"];
    $rowData["due_date"] = date("m/d/Y", strtotime(($row['due_date'])));
    $rowData["check_in_button"] = '<button type="button" class="btn btn-success btn-sm" id="check_in' . $i . '"
data-bs-toggle="modal" loan_log_id="' . $row["loan_log_id"] . '" copy_id="' . $row["copy_id"] . '"
loaned_condition="' . $row["book_condition"] . '" data-bs-target="#checkInModal">Check
In</button>';
    $rows[] = $rowData;
}
header('Content-Type: application/json');
echo json_encode($rows);
$mysqli->close();
?>