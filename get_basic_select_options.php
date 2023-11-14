<?php
include 'db_connection.php';
include 'session_check.php';

if ($_GET["author_id"]) {
    $author_id = $_GET["author_id"];
    $query = "SELECT author_id, author_first_name, author_last_name FROM author;";
    $author_result = $mysqli->query($query);
    if (mysqli_num_rows($author_result) == 0) {
        $authors = "No Authors Found";
    } else {
        while ($rowA = $author_result->fetch_assoc()) {
            if ($rowA['author_id'] == $author_id) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            echo "<option value=" . $rowA['author_id'] . " " . $selected . ">" . $rowA["author_first_name"] . " " . $rowA["author_last_name"] . "</option>";
        }
    }
} else if ($_GET["genre_id"]) {
    $genre_id = $_GET["genre_id"];
    $query = "SELECT * FROM genre;";
    $genre_result = $mysqli->query($query);
    if (mysqli_num_rows($genre_result) == 0) {
        $genre = "No Genre Found";
    } else {
        while ($rowG = $genre_result->fetch_assoc()) {
            if ($rowG['genre_id'] == $genre_id) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            echo "<option value=" . $rowG['genre_id'] . " " . $selected . ">" . $rowG["genre_name"] . "</option>";
        }
    }
} else if ($_GET["publisher_id"]) {
    $publisher_id = $_GET["publisher_id"];
    $query = "SELECT * FROM publisher;";
    $publisher_result = $mysqli->query($query);
    if (mysqli_num_rows($publisher_result) == 0) {
        $publisher = "No publisher Found";
    } else {
        while ($rowP = $publisher_result->fetch_assoc()) {
            if ($rowP['publisher_id'] == $publisher_id) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            echo "<option value=" . $rowP['publisher_id'] . " " . $selected . ">" . $rowP["publisher_name"] . "</option>";
        }
    }
}else{
    echo "No property recieved";
}

$mysqli->close();
?>