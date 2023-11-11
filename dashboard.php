<!DOCTYPE html>
<html lang="en">
<?php
//Query for total number of books in library collection and store it in $count
include 'db_connection.php';

$query = "SELECT COUNT(copy_id) AS count FROM `copy`";
$copy_result = $mysqli->query($query);

if ($copy_result) {
    $row = $copy_result->fetch_assoc();
    $count = $row["count"];
} else {

    $count = 0;
}

//Query for total number of books that checked out today and store it in $checked_out_today
$query = "SELECT COUNT(loan_log_id) AS count FROM `loan_log` WHERE date_checked_out = CURDATE()";
$checked_out_today_result = $mysqli->query($query);

if ($checked_out_today_result) {
    $row = $checked_out_today_result->fetch_assoc();
    $checked_out_today = $row["count"];
} else {
    $checked_out_today = 0;
}

//Query for total number of books that were returned today and store it in $returned
$query = "SELECT COUNT(loan_log_id) AS count FROM `loan_log` WHERE date_checked_in = CURDATE()";
$returned_today_result = $mysqli->query($query);

if ($returned_today_result) {
    $row = $returned_today_result->fetch_assoc();
    $returned = $row["count"];
} else {

    $returned = 0;
}

//Query for total number of books that are due today and store it in $due
$query = "SELECT COUNT(loan_log_id) AS count FROM `loan_log` WHERE due_date = CURDATE()";
$due_today_result = $mysqli->query($query);

if ($due_today_result) {
    $row = $due_today_result->fetch_assoc();
    $due = $row["count"];
} else {
    $due = 0;
}

//Query for total number of books that are overdue and storre it in $overdue                             
$query = "SELECT COUNT(loan_log_id) AS count FROM `loan_log` WHERE date_checked_in IS NULL AND due_date < CURDATE()";
$overdue_result = $mysqli->query($query);

if ($overdue_result) {
    $row = $overdue_result->fetch_assoc();
    $overdue = $row["count"];
} else {

    $overdue = 0;
}

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- theme meta -->
    <meta name="theme-name" content="focus" />
    <title>Caribbean Library Management System</title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">
    <!-- Styles -->
    <link href="css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
    <link href="css/lib/chartist/chartist.min.css" rel="stylesheet">
    <link href="css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="css/lib/themify-icons.css" rel="stylesheet">
    <link href="css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="css/lib/weather-icons.css" rel="stylesheet" />
    <link href="css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="css/lib/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'sidebar.php';
    include 'header.php'; ?>
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">

                <!-- /# row -->
                <section id="main-content">
                    <div class="row mt-3">
                        <div class="col">
                            <h4>Welcome to LMS Dashboard</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-book color-primary border-primary"></i>
                                    </div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Books In Library Collection</div>
                                        <div class="stat-digit">
                                            <?php echo $count ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i
                                            class="ti-exchange-vertical color-dark border-dark"></i>
                                    </div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Books Checked Out Today</div>
                                        <div class="stat-digit">
                                            <?php echo $checked_out_today ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-calendar color-warning border-warning"></i>
                                    </div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Books Due Today</div>
                                        <div class="stat-digit">
                                            <?php echo $due ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-check color-success border-success"></i>
                                    </div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Books Returned Today</div>
                                        <div class="stat-digit">
                                            <?php echo $returned ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-alert color-danger border-danger"></i>
                                    </div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Overdue Books</div>
                                        <div class="stat-digit">
                                            <?php echo $overdue ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="row justify-content-center">
                                    <h5>Book Transaction Overview</h5>
                                </div>
                                <div class="row justify-content-center" style="height: 30em">
                                    <!--<div class="col-6">-->
                                    <canvas id="inoutchart"></canvas>
                                    <!--</div>-->
                                    <!--<div class="col-6">
                                        <canvas id="inchart"></canvas>
                                    </div>-->
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="table-responsive">
                                    <h3 class="text-center color-warning ">Books Due Today</h3>
                                    <table id="due-table" class="table table-striped table-bordered"
                                        style="margin-top: 10px">
                                        <thead>
                                            <tr>
                                                <th>Book Title</th>
                                                <th>Copy ID</th>
                                                <th>Borrower</th>
                                                <th>Date Borrowed</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT b.book_title, c.copy_id, CONCAT(m.first_name, ' ', m.last_name), l.date_checked_out FROM `loan_log` AS l 
                                                      LEFT JOIN `copy` AS c ON c.copy_id = l.copy_id
                                                      LEFT JOIN book AS b ON b.book_isbn = c.book_isbn
                                                      LEFT JOIN member AS m ON m.member_id = l.member_id
                                                      WHERE l.date_checked_in IS NULL AND l.due_date = CURDATE()";
                                                $due_today_result_table = $mysqli->query($query);
                                                //if the query returns any values, the copy is checked out, so it should be skipped
                                                if ($due_today_result_table->num_rows > 0) {
                                                    while ($row = $due_today_result_table->fetch_assoc()) {
                                                        echo "<tr>";
                                                        echo "<td>" . $row['book_title'] . "</td>";
                                                        echo "<td>" . $row['copy_id'] . "</td>";
                                                        echo "<td>". $row["CONCAT(m.first_name, ' ', m.last_name)"] . "</td>";
                                                        echo "<td>". date("m/d/Y", strtotime($row["date_checked_out"])) . "</td>";
                                                        echo "</tr>";
                                                    }
                                                }else{
                                                        echo "<tr>";
                                                        echo "<td>No Books Due Today</td>";
                                                        echo "<td> </td>";
                                                        echo "<td></td>";
                                                        echo "<td></td>";
                                                        echo "</tr>";
                                                }
                                                
                                                ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="export-options" style="margin-top: 20px">
                                    <p>Export as: </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="table-responsive">
                                    <h3 class="text-center color-danger">Overdue Books</h3>
                                    <table id="overdue-table" class="table table-striped table-bordered"
                                        style="margin-top: 10px">
                                        <thead>
                                            <tr>
                                                <th>Book Title</th>
                                                <th>Copy ID</th>
                                                <th>Borrower</th>
                                                <th>Due Date</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $query = "SELECT b.book_title, c.copy_id, CONCAT(m.first_name, ' ', m.last_name), l.due_date FROM `loan_log` AS l 
                                                      LEFT JOIN `copy` AS c ON c.copy_id = l.copy_id
                                                      LEFT JOIN book AS b ON b.book_isbn = c.book_isbn
                                                      LEFT JOIN member AS m ON m.member_id = l.member_id
                                                      WHERE l.date_checked_in IS NULL AND l.due_date IS NOT NULL AND l.due_date < CURDATE()";
                                                $overdue_result_table = $mysqli->query($query);
                                                //if the query returns any values, the copy is checked out, so it should be skipped
                                                if ($overdue_result_table->num_rows > 0) {
                                                    while ($overrow = $overdue_result_table->fetch_assoc()) {
                                                        echo "<tr>";
                                                        echo "<td>" . $overrow['book_title'] . "</td>";
                                                        echo "<td>" . $overrow['copy_id'] . "</td>";
                                                        echo "<td>". $overrow["CONCAT(m.first_name, ' ', m.last_name)"] . "</td>";
                                                        echo "<td>". date("m/d/Y", strtotime($overrow["due_date"])) . "</td>";
                                                        echo "</tr>";
                                                    }
                                                }else{
                                                        echo "<tr>";
                                                        echo "<td>No Overdue Books</td>";
                                                        echo "<td> </td>";
                                                        echo "<td></td>";
                                                        echo "<td></td>";
                                                        echo "</tr>";
                                                }
                                                
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="export-options" style="margin-top: 20px">
                                    <p>Export as: </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer">
                                <p>2018 © Admin Board. - <a href="#">example.com</a></p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- jquery vendor -->
    <script src="js/lib/jquery.min.js"></script>
    <script src="js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="js/lib/menubar/sidebar.js"></script>
    <script src="js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="js/lib/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <!-- bootstrap -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="js/lib/data-table/datatables.min.js"></script>
    <script src="js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="js/lib/data-table/buttons.flash.min.js"></script>
    <script src="js/lib/data-table/jszip.min.js"></script>
    <script src="js/lib/data-table/pdfmake.min.js"></script>
    <script src="js/lib/data-table/vfs_fonts.js"></script>
    <script src="js/lib/data-table/buttons.html5.min.js"></script>
    <script src="js/lib/data-table/buttons.print.min.js"></script>
    <script src="js/lib/data-table/datatables-init.js"></script>
    <script>
        //__________________________________ JAVASCRIPT FOR TABLES __________________________________
        $(document).ready(function () {
            var table = $('#overdue-table').DataTable({
                "dom": 'frtip',
                "buttons": [
                    'excel',
                    'pdf',
                    'print'
                ],
                "paging": false,
                "info": false,
            });

            var table = $('#due-table').DataTable({
                "dom": 'frtip',
                "buttons": [
                    'excel',
                    'pdf',
                    'print'
                ],
                "paging": false,
                "info": false,
            });

            var buttons = new $.fn.dataTable.Buttons(table, {
                buttons: [
                    'excel',
                    'pdf',
                    'print'
                ]
            }).container().appendTo($('.export-options'));
        });

        //__________________________________ JAVASCRIPT FOR CHARTS __________________________________

        const ctx = document.getElementById('inoutchart');
        const labels = [];
        const today = new Date();

        for (let i = 6; i >= 0; i--) {
            const date = new Date(today);
            date.setDate(today.getDate() - i);

            const mm = String(date.getMonth() + 1).padStart(2, '0'); // Month
            const dd = String(date.getDate()).padStart(2, '0'); // Day
            const yy = String(date.getFullYear()).slice(-2); // Year

            const formattedDate = `${mm}/${dd}/${yy}`;

            labels.push(formattedDate);
        }

        <?php
        include 'db_connection.php';
        $today = date('Y-m-d');
        $checked_in_data = [];
        for ($i = 6; $i > -1; $i--) {
            $dateToCheck = date('Y-m-d', strtotime("-$i days", strtotime($today)));

            $query = "SELECT COUNT(loan_log_id) AS count 
                FROM loan_log
                WHERE date_checked_in = '$dateToCheck'
                ORDER BY date_checked_in ASC";

            $result = $mysqli->query($query);
            if ($result) {
                $row = $result->fetch_assoc();
                array_push($checked_in_data, (int)$row["count"]);
            } else {
                die("Error in chart js.");
            }

        }
        $checked_in_data_final = json_encode($checked_in_data);

        $checked_out_data = [];
        for ($i = 6; $i > -1; $i--) {
            $dateToCheck = date('Y-m-d', strtotime("-$i days", strtotime($today)));

            $query = "SELECT COUNT(loan_log_id) AS count
                FROM loan_log
                WHERE date_checked_out = '$dateToCheck'
                ORDER BY date_checked_out ASC";

            $result2 = $mysqli->query($query);
            if ($result2) {
                $row = $result2->fetch_assoc();
                array_push($checked_out_data, (int)$row["count"]);
            } else {
                die("Error in chart js.");
            }

        }
        $checked_out_data_final = json_encode($checked_out_data);
        $mysqli->close();
        ?>

        var checkedIn = {
            label: 'Books Checked In',
            data: <?php echo $checked_in_data_final; ?>,
            backgroundColor: 'rgba(40, 167, 69, 0.6)',
            borderColor: 'rgba(40, 167, 69, 1)'
        }
        var checkedOut = {
            label: 'Books Checked Out',
            data: <?php echo $checked_out_data_final; ?>,
            backgroundColor: 'rgba(220, 53, 69, 0.6)',
            borderColor: 'rgba(220, 53, 69, 1)'

        }

        var bookData = {
            labels: labels,
            datasets: [checkedIn, checkedOut]
        };

        var chartOptions = {
            responsive: true,
            scales: {
                x: {
                    barPercentage: 1,
                    categoryPercentage: 0.6,
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    beginAtZero: true,
                    suggestedMax: 10,
                    title: {
                        display: true,
                        text: 'Number of Books' // Title for the y-axis
                    }
                }
            }
        };

        var InOutChart = new Chart(ctx, {
            type: 'bar',
            data: bookData,
            options: chartOptions
        });;

    </script>
</body>

</html>