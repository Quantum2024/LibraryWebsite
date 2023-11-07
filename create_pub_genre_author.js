$(document).ready(function () {
    $("#submitAuthor").click(function () {
        var author_first_name = $("#author_first_name").val();
        var author_last_name = $("#author_last_name").val();
        var dataType = "Author"; // Define dataType for Author

        // Show processing message
        $("#processingMessage").show();


        $.ajax({
            type: "POST",
            url: "insert_data_new_author.php",
            data: {
                author_first_name: author_first_name,
                author_last_name: author_last_name,
                dataType: dataType // Pass dataType parameter
            },
            success: function (data) {
                // Hide processing message
                $("#processingMessage").hide();
                // Hide the current modal
                $("#NewAuthor").modal('hide');
                displaySuccessModal(dataType);

                // Call the function to update the author options
                updateAuthorOptions();
                $("#authorSuccessMessage").html("New Author added successfully!");
                 // Select the element
                 var authorSuccessMessage = document.getElementById("authorSuccessMessage");

                 // Hide the element after 5 seconds
                 setTimeout(function () {
                     authorSuccessMessage.style.display = "none";
                 }, 5000); // 5000 milliseconds (5 seconds)

                //reset the form
                $("#newAuthorForm")[0].reset();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Error: " + errorThrown);
            }
        });
    });

    $("#submitGenre").click(function () {
        var genre_name = $("#genre_name").val();
        var dataType = "Genre"; // Define dataType for Genre

        // Show processing message
        $("#processingMessage3").show();
        $.ajax({
            type: "POST",
            url: "insert_data_new_genre.php",
            data: {
                genre_name: genre_name
            },
            success: function (data) {
                //hide processing message
                $("#processingMessage3").hide();
                // Update the modal or display a success message
                $("#NewGenre").modal('hide'); // Close the modal
                displaySuccessModal(dataType);
                updateGenreOptions();
                $("#genreSuccessMessage").html("New Genre added successfully!");

                // Select the element
                var genreSuccessMessage = document.getElementById("genreSuccessMessage");

                // Hide the element after 5 seconds
                setTimeout(function () {
                    genreSuccessMessage.style.display = "none";
                }, 5000); // 5000 milliseconds (5 seconds)

            },
            error: function (xhr, status, error) {
                console.log("Error: " + errorThrown);
            }
        });
    });

    $("#submitPublisher").click(function () {
        var publisher_name = $("#new_publisher_name").val();
        var publisher_country = $("#publisher_country").val();
        var email_address = $("#email_address").val();
        var phone_number = $("#phone_number").val()
        var dataType = "Publisher"; // Define dataType for Publisher

        // Show processing message
        $("#processingMessage2").show();

        $.ajax({
            type: "POST",
            url: "insert_data_new_publisher.php",
            data: {
                publisher_name: publisher_name,
                publisher_country: publisher_country,
                email_address: email_address,
                phone_number: phone_number,
                dataType: dataType // Pass dataType parameter
            },
            success: function (data) {
                // Hide processing message
                $("#processingMessage2").hide();
                // Hide the current modal
                $("#NewPublisher").modal('hide');
                displaySuccessModal(dataType);
                updatePublisherOptions(); // Call the function to update the publisher options
                $("#publisherSuccessMessage").html("New Publisher added successfully!");
                // Select the element
                var publisherSuccessMessage = document.getElementById("publisherSuccessMessage");

                // Hide the element after 5 seconds
                setTimeout(function () {
                    publisherSuccessMessage.style.display = "none";
                }, 5000); // 5000 milliseconds (5 seconds)

                // Optionally, you can reset the form
                $("#newPublisherForm")[0].reset();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Error: " + errorThrown);
            }
        });
    });

    // Function to display the success modal
    function displaySuccessModal(dataType) {
        $("#successMessage").html(dataType + " Added Successfully"); // Set the success message
        $("#successModal").modal("show");
    }

    //Author Options Update
    function updateAuthorOptions() {
        console.log("Making AJAX request to get_author_list.php");
        $.ajax({
            type: "GET",
            url: "get_author_list.php", // PHP script to fetch the updated list of authors
            dataType: 'json',
            success: function (data) {
                console.log(data); // Log the response data to the console
                // Replace the options in the select element with the updated data
                $("#author_name").select2({
                    placeholder: "Select an Author",
                    data: data
                })
            }
        });
    }

    updateAuthorOptions();

    //Genre Options Update
    function updateGenreOptions() {
        console.log("Making AJAX request to get_genre_list.php");
        $.ajax({
            type: "GET",
            url: "get_genre_list.php", // PHP script to fetch the updated list of authors
            success: function (data) {
                console.log(data); // Log the response data to the console
                // Replace the options in the select element with the updated data
                $("#genre_name_primary").html(data);
            }
        });
    }
    $("#genre_name_primary").select2(); //initialises select2 for genre
    updateGenreOptions(); //Populates genre upon loading completion


    //Publisher Options Update 

    function updatePublisherOptions() {
        console.log("Making AJAX request to get_publisher_list.php");
        $.ajax({
            type: "GET",
            url: "get_publisher_list.php", // PHP script to fetch the updated list of publishers
            success: function (data) {
                console.log(data); // Log the response data to the console
                // Replace the options in the select element with the updated data
                $("#publisher_name").html(data);
            }
        });
    }
    $("#publisher_name").select2();  //initialises select2 for publisher
    updatePublisherOptions(); //Populates publishers upon loading completion

})
