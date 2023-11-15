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
    <link href="css/login.css" rel="stylesheet">
    <link href="css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="css/lib/themify-icons.css" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Replace Bootstrap JS with Popper.js and Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
    <link href="css/lib/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
    </style>
</head>

<body class="gradient-custom-2 d-flex justify-content-center align-items-center vh-100">
    <!--CONTAINER-->
    <div class="container" style="height: 75%;">
        <div class="row h-100">
            <!--LEFT COLUMN-->
            <div class="col-lg-6 d-flex align-items-center justify-content-center"
                style="background-image: url('images/login-background.jpg'); background-size: cover;">
                <div class="d-flex align-items-center justify-content-center w-70">
                    <div class="col-xl-12">
                        <div class="row  d-flex align-items-center justify-content-center">
                            <h1 class="mb-4 text-center">Welcome!</h1>
                        </div>
                        <div class="row">
                            <h6 class="mb-0 text-center" style="color:black;">Caribbean Public Library Ltd (CPL)
                                has been a cherished institution in our community for over five decades. Founded in
                                1970 by a group of passionate educators and advocates for literacy, CPL aimed to
                                provide access to knowledge and educational resources for all, regardless of their
                                socio-economic background.
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <!--RIGHT COLUMN-->
            <div class="col-lg-6 d-flex justify-content-center align-items-center" style="background-color: white;">
                <div class="col-10">
                    <div class="text-center">
                        <img src="images/Caribbean_PLL_Logo.png" style="width: 70%;" alt="logo">
                        <h4 class="mb-3 pb-1">Fortuna Library Management System</h4>
                        <?php if(isset($_GET["error"])) echo '<p class="color-danger">'.urldecode($_GET["error"]).'</p>'; ?>
                    </div>

                    <form action="login.php" method="post">
                        <p style="text-align: center; margin-bottom: 25px;">Please login to your account</p>

                        <div class="mb-4">
                            <label class="form-label" for="email" name="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" />
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="password" name="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" />
                        </div>

                        <div class="text-center pt-1 mb-5 pb-1">
                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Log
                                in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jquery vendor -->
    <script src="js/lib/jquery.min.js"></script>
</body>

</html>
