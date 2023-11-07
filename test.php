<!DOCTYPE html>
<html>
<head>
    <title>Add New Publisher</title>
</head>
<body>
    <h2>Add New Publisher</h2>
    <form id="publisherForm" action="insert_data_new_publisher.php" method="post">
        <div class="mb-3">
            <label for="publisher_name" class="form-label">Publisher Name</label>
            <input type="text" id="publisher_name" name="publisher_name" class="form-control">
        </div>
        <div class="mb-3">
            <label for="publisher_country" class="form-label">Publisher Country</label>
            <input type="text" id="publisher_country" name="publisher_country" class="form-control">
        </div>
        <div class="mb-3">
            <label for="email_address" class="form-label">Email Address</label>
            <input type="text" id="email_address" name="email_address" class="form-control">
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Save Publisher</button>
    </form>
</body>
</html>
