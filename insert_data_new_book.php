<?php
//  Include the database connection
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the combined author name from the form
    $author_name = $_POST['author_name'];
    // Split the combined author name into first name and last name
    list($author_first_name, $author_last_name) = explode(' ', $author_name);

    // Get data from the form
    $book_isbn = $_POST['book_isbn'];
    $book_title = $_POST['book_title'];
    $language = $_POST['language'];
    $edition = $_POST['edition'];
    $num_of_pages = $_POST['num_of_pages'];
    $genre_name = $_POST['genre_name'];
    $publisher_name = $_POST['publisher_name'];

    // Perform data validation and sanitization as needed

    // Start a database transaction
    $mysqli->begin_transaction();

    // Retrieve the genre_id based on the selected genre_name
    $selectGenreIdQuery = "SELECT genre_id FROM genre WHERE genre_name = ?";
    $stmtSelectGenreId = $mysqli->prepare($selectGenreIdQuery);
    $stmtSelectGenreId->bind_param("s", $genre_name);
    $stmtSelectGenreId->execute();
    $stmtSelectGenreId->bind_result($genre_id);
    $stmtSelectGenreId->fetch();
    $stmtSelectGenreId->close();

    // Retrieve the publisher_id based on the selected publisher_name
    $selectPublisherIdQuery = "SELECT publisher_id FROM publisher WHERE publisher_name = ?";
    $stmtSelectPublisherId = $mysqli->prepare($selectPublisherIdQuery);
    $stmtSelectPublisherId->bind_param("s", $publisher_name);
    $stmtSelectPublisherId->execute();
    $stmtSelectPublisherId->bind_result($publisher_id);
    $stmtSelectPublisherId->fetch();
    $stmtSelectPublisherId->close();

    // Retrieve the author_id based on the selected author_first_name and author_last_name
    $selectAuthorIdQuery = "SELECT author_id FROM author WHERE author_first_name = ? AND author_last_name = ?";
    $stmtSelectAuthorId = $mysqli->prepare($selectAuthorIdQuery);
    $stmtSelectAuthorId->bind_param("ss", $author_first_name, $author_last_name);
    $stmtSelectAuthorId->execute();
    $stmtSelectAuthorId->bind_result($author_id);

    if ($stmtSelectAuthorId->fetch()) {
        // Author already exists, use the retrieved author_id
        $stmtSelectAuthorId->close();
    } else {
        // Author doesn't exist, insert a new author and retrieve their auto-generated ID
        $stmtSelectAuthorId->close();

        // Insert a new author
        $insertNewAuthorQuery = "INSERT INTO author (author_first_name, author_last_name) VALUES (?, ?)";
        $stmtInsertNewAuthor = $mysqli->prepare($insertNewAuthorQuery);
        $stmtInsertNewAuthor->bind_param("ss", $author_first_name, $author_last_name);
        $stmtInsertNewAuthor->execute();
        $stmtInsertNewAuthor->close();

        // Now, retrieve the newly inserted author_id
        $stmtSelectAuthorId = $mysqli->prepare($selectAuthorIdQuery);
        $stmtSelectAuthorId->bind_param("ss", $author_first_name, $author_last_name);
        $stmtSelectAuthorId->execute();
        $stmtSelectAuthorId->bind_result($author_id);
        $stmtSelectAuthorId->fetch();
        $stmtSelectAuthorId->close();
    }

    // Insert data into the "book" table
    $insertBookQuery = "INSERT INTO book (book_isbn, book_title, language, edition, num_of_pages,  genre_id, publisher_id) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmtBook = $mysqli->prepare($insertBookQuery);
    $stmtBook->bind_param("issiiii", $book_isbn, $book_title, $language, $edition, $num_of_pages, $genre_id, $publisher_id);

    // Insert data into the "wrote" table to associate the author with the book
    $insertWroteQuery = "INSERT INTO wrote (book_isbn, author_id) VALUES (?, ?)";
    $stmtWrote = $mysqli->prepare($insertWroteQuery);
    $stmtWrote->bind_param("ii", $book_isbn, $author_id);

    // Execute the prepared statements
    if ($stmtBook->execute() && $stmtWrote->execute()) {
        // Commit the transaction if all inserts are successful
        $mysqli->commit();
        echo "Data inserted successfully.";
    } else {
        // Rollback the transaction if any insert fails
        $mysqli->rollback();
        echo "Error: " . $mysqli->error;
    }

    // Close the prepared statements and the database connection
    $stmtBook->close();
    $stmtWrote->close();
    $mysqli->close();
}
?>