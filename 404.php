<!DOCTYPE html>
<html lang="en">

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
    <link href="css/lib/chartist/chartist.min.css" rel="stylesheet">
    <link href="css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="css/lib/themify-icons.css" rel="stylesheet">
    <link href="css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="css/lib/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .countdown {
            font-size: 18px;
            color: #777;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <?php include 'sidebar.php';
    include 'header.php'; ?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="card">
                    <h1>404 Error</h1>
                    <p>The page you are looking for cannot be found. Redirecting you back to the dashboard in <span
                            id="countdown" class="countdown">5</span> seconds.</p>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer">
                            <p>2023 © Fortuna</p>
                        </div>
                    </div>
                </div>
                </section>
            </div>
        </div>
    </div>
    <script>
        // Countdown timer logic
        let seconds = 10;
        const countdownElement = document.getElementById('countdown');

        function updateCountdown() {
            countdownElement.textContent = seconds;
            seconds--;

            if (seconds < 0) {
                // Redirect to dashboard.php after countdown
                window.location.href = 'dashboard.php';
            } else {
                // Continue the countdown
                setTimeout(updateCountdown, 1000);
            }
        }

        // Start the countdown when the page is loaded
        document.addEventListener('DOMContentLoaded', function () {
            updateCountdown();
        });
    </script>
</body>

</html>