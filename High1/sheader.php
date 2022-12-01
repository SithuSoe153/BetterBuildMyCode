<?php

include('connect.php');

$select = "SELECT * FROM staff";
$query = mysqli_query($connection, $select);
$count = mysqli_num_rows($query);

$data = mysqli_fetch_array($query);
$staffid = $data['staffid'];

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="report.css">

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
        .headerblock {
            display: inline-block;
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
        <div class="headerblock">
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
                                            <a data-scroll-nav="0" href="indexstaff.php">Home</a>
                                        </li>

                                        <li class="nav-item">
                                            <a data-scroll-nav="0" href="category.php">Category</a>
                                        </li>

                                        <li class="nav-item">
                                            <a data-scroll-nav="0" href="product.php">Product</a>
                                        </li>

                                        <li class="nav-item">
                                            <a data-scroll-nav="0" href="supplier.php">Supplier</a>
                                        </li>

                                        <li class="nav-item">
                                            <a data-scroll-nav="0" href="purchase.php">Purchase</a>
                                        </li>

                                        <li class="nav-item">
                                            <a data-scroll-nav="0" href="purchasereport.php">Purchase Report</a>
                                        </li>

                                        <li class="nav-item">
                                            <a data-scroll-nav="0" href="orderreport.php">Order Report</a>
                                        </li>

                                        <li class="nav-item">
                                            <a data-scroll-nav="0" href="stafflist.php">Staff</a>
                                        </li>

                                        </li>
                                        <li class="nav-item">
                                            <?php
                                            // adminkit/static/pages-profile.php
                                            echo "<a href='adminkit/static/pages-profile.php?sid=$staffid'>Account</a>";
                                            ?>
                                        </li>

                                        <!-- echo "<td>
                                        <a href='updatestaff.php?sid=$staffid'>
                                            Update
                                        </a> -->

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
        </div>
    </form>