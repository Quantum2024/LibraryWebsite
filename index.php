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
    <link href="css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="css/lib/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
    </style>
</head>

<body class="gradient-custom-2 d-flex justify-content-center align-items-center vh-100">
    <!--CONTAINER-->
    <div class="container" style="height: 75%; width: 80%;">
        <div class="row m-0" style="height: 100%">
            <!--LEFT COLUMN-->
            <div class="col-lg-6 p-0 d-flex align-items-center justify-content-center"
                style="max-height: 100%; background-image: url('images/login-background.jpg'); background-size: cover;">
                <div class="d-flex align-items-center justify-content-center" style="height: 90%; width: 70%;">
                    <div class="col-xl-12">
                        <div class="row  d-flex align-items-center justify-content-center">
                            <h1 class="mb-4 text-center">Welcome!</h1>
                        </div>
                        <div class="row">
                            <h6 class="mb-0 text-center" style="color:black;">Caribbean Public Library Ltd (CPL)
                                has been a
                                cherished institution in our community for over five decades.
                                Founded in 1970 by a group of passionate educators and advocates for
                                literacy, CPL aimed to provide access to knowledge and educational
                                resources for all, regardless of their socio-economic background.
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <!--RIGHT COLUMN-->
            <div class="col-lg-6 p-0 d-flex justify-content-center align-items-center" style="background-color: white;">
                <div class="col-10">
                    <div class="text-center">
                        <img src="images/Caribbean_PLL_Logo.png" style="width: 70%;" alt="logo">
                        <h4 class="mb-3 pb-1">Fortuna Library Management System</h4>
                    </div>

                    <form action="login.php" method="post">
                        <p>Please login to your account</p>

                        <div class="form-outline mb-4">
                            <input type="email" id="email" class="form-control" placeholder="Email Address" />
                            <label class="form-label" for="email">Email</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" id="password" class="form-control" />
                            <label class="form-label" for="password">Password</label>
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
    <!-- sidebar -->
    <script src="js/lib/bootstrap.min.js"></script>
</body>

</html>

<!--<div class="container d-flex justify-content-center">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-xl-10">
                        <div class="card rounded-3 text-black">
                            <div class="row g-0">
                                <div class="col-lg-6 d-flex align-items-center">
                                    <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                        <h1 class="mb-4">Welcome!</h1>
                                        <p class="medium mb-0">Caribbean Public Library Ltd (CPL)
                                            has been a
                                            cherished institution in our community for over five decades.
                                            Founded in 1970 by a group of passionate educators and advocates for
                                            literacy, CPL aimed to provide access to knowledge and educational
                                            resources for all, regardless of their socio-economic background.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card-body p-md-5 mx-md-4">

                                        <div class="text-center">
                                            <img src="images/Caribbean_PLL_Logo.png" style="width: 100%;" alt="logo">
                                            <h4 class="mb-3 pb-1">Fortuna Library Management System</h4>
                                        </div>

                                        <form>
                                            <p>Please login to your account</p>

                                            <div class="form-outline mb-4">
                                                <input type="email" id="email" class="form-control"
                                                    placeholder="Email Address" />
                                                <label class="form-label" for="email">Email</label>
                                            </div>

                                            <div class="form-outline mb-4">
                                                <input type="password" id="password" class="form-control" />
                                                <label class="form-label" for="password">Password</label>
                                            </div>

                                            <div class="text-center pt-1 mb-5 pb-1">
                                                <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                                    type="button">Log
                                                    in</button>
                                                <a class="text-muted" href="#!">Forgot password?</a>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>-->