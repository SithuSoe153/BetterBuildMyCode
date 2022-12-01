<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="js/html2canvas.js"></script>

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="./assets/images/new_logo.png" type="image/png">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!--====== Animate css ======-->
    <link rel="stylesheet" href="assets/css/animate.css">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">

    <!--====== Slick css ======-->
    <link rel="stylesheet" href="assets/css/slick.css">

    <!--====== Line Icons css ======-->
    <link rel="stylesheet" href="assets/css/LineIcons.css">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="assets/css/default.css">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="assets/css/style.css">

    <!--====== Responsive css ======-->
    <link rel="stylesheet" href="assets/css/responsive.cube1ss">

    <!--====== Double Slider css ======-->
    <link rel="stylesheet" href="assets/css/double_slider.css">

    <!--====== Font Awsome css ======-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css?v=7857324">

    <style>
        nav ul li ul {
            animation: fadeIIn 0.5s;
            width: 100%;
            left: 0;
            z-index: 1;
            background-color: white;
            position: absolute;
            border-bottom: 5px inset black;
            border-right: 5px inset black;
            border-radius: 0 10px 23px 23px;
            display: none;
        }

        nav ul li:hover>ul {
            display: block;
        }

        nav ul li ul li {
            padding-top: 10px;
            padding-right: 30px;
            padding-left: 10px;
            width: 20%;
            height: auto;
            float: left;
            display: list-item;

        }

        nav ul li ul li a {
            display: block;
        }

        nav ul li ul li a:hover {
            font-size: 80px
        }

        hr {
            /* padding-bottom: 80px; */
            border-top: 1.5px solid #fe7865;
        }

        @keyframes fadeIIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>


</head>

<body>

    <!--====== PRELOADER PART START ======-->

    <!-- <div class="preloader">
        <div class="spin">
            <div class="cube1"></div>
            <div class="cube2"></div>
        </div>
    </div> -->

    <!--====== PRELOADER PART END======-->

    <form action="sheader.php" method="POST">
        <header class="header-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <nav class="navbar navbar-expand-lg">

                            <a class="navbar-brand" href="index.php">
                                <img src="assets/images/new_word.png" height="75px" alt="Logo">
                            </a>
                            <!-- Logo -->
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="bar-icon"></span>
                                <span class="bar-icon"></span>
                                <span class="bar-icon"></span>

                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                                <ul id="nav" class="navbar-nav ml-auto">
                                    <li class="nav-item">
                                        <a data-scroll-nav="0" href="index.php">Home</a>
                                    </li>

                                    <li class="nav-item"> <a href="store.php">Store</a>
                                        <ul>

                                            <!-- <div class=" main-wrapper"> -->
                                            <!-- <div class="container"> -->

                                            <li>
                                                <img src="./assets/images/products/chair.png">

                                                Chair
                                                <hr>
                                                <a href="armchair.php">Arm chair</a>
                                                <a href="accentchair.php">Accent chair</a>
                                                <a href="#">Sleeper chair</a>
                                            </li>

                                            <li> <img src="./assets/images/products/sofa.png" alt=""> Sofa
                                                <hr>
                                                <a href="#">Section chair</a>
                                                <a href="#">Big chair</a>
                                                <a href="#">Small chair</a>
                                            </li>

                                            <li>
                                                <img src="./assets/images/products/table.png">
                                                Table
                                                <hr>
                                                <a href="#">Section chair</a>
                                                <a href="#">Big chair</a>
                                                <a href="#">Small chair</a>
                                            </li>

                                            <li> <img src="./assets/images/products/bed1.png" width="20"> Bed
                                                <hr>
                                            </li>

                                            <li> <img src="./assets/images/products/bed.png" alt=""> Bed
                                                <hr>
                                            </li>

                                        </ul>
                                    </li>


                                    <li class="nav-item">
                                        <a data-scroll-nav="0" href="gallary.php">Gallary</a>
                                    </li>

                                    <li class="nav-item">
                                        <a data-scroll-nav="0" href="Advise">Advise</a>
                                    </li>

                                    <li class="nav-item">
                                        <a data-scroll-nav="0" href="plan.php">Plan</a>
                                    </li>

                                    <li class="nav-item">
                                        <a data-scroll-nav="0" href="cart.php">Cart</a>
                                    </li>

                                    <li class="nav-item">
                                        <a data-scroll-nav="0" href="aboutus.php">About Us</a>
                                    </li>

                                    </li>
                                    <li class="nav-item">
                                        <a data-scroll-nav="0" href="accountchoose.php">Account</a>
                                    </li>
                                </ul> <!-- navbar nav -->
                            </div>
                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </header>

        <script>
            const activePage = window.location.pathname;
            const navLinks = document.querySelectorAll('nav a').forEach(link => {
                if (link.href.includes(`${activePage}`)) {
                    link.classList.add('active-navbar');
                    console.log(link);
                }
            })
        </script>

    </form>