<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('customerlogin.php');
include('customersignup.php');

// if (isset($_SESSION['sid'])) {
//     // echo "<script>alert('You are staff')</script>";
//     echo "<script>window.location='adminkit/static/index.php'</script>";
// }

// if (isset($_SESSION['cid'])) {
//     // echo "<script>alert('You are Customer')</script>";
//     echo "<script>window.location='customerprofile.php'</script>";
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!--====== Font Awsome css ======-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css?v=7857324">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> -->

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            background: #f6f5f7;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Montserrat', sans-serif;
            height: 100%;
            padding-top: 10vh;
            margin: -20px 0 50px;
        }

        h1 {
            font-weight: bold;
            margin: 0;
        }

        h2 {
            text-align: center;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }

        span {
            font-size: 12px;
        }

        a {

            color: #333;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
        }

        button {
            border-radius: 20px;
            border: 1px solid #fe7865;
            background-color: #fe7865;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background-color: transparent;
            border-color: #FFFFFF;
        }

        form {
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            text-align: center;
        }

        input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }

        textarea {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }


        .containerr {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                0 10px 10px rgba(0, 0, 0, 0.22);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 600px;
        }

        .form-containerr {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-containerr {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .containerr.right-panel-active .sign-in-containerr {
            transform: translateX(100%);
        }

        .sign-up-containerr {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .containerr.right-panel-active .sign-up-containerr {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .overlay-containerr {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .containerr.right-panel-active .overlay-containerr {
            transform: translateX(-100%);
        }

        .overlay {
            background: #de640f;
            background: -webkit-linear-gradient(to right, #d78477, #ec7663);
            background: linear-gradient(to right, #d78477, #ec7663);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #FFFFFF;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .containerr.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .containerr.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .containerr.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        .social-containerr {
            margin: 20px 0;
        }

        .social-containerr a {
            border: 1px solid #DDDDDD;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            height: 40px;
            width: 40px;
        }

        .main-btn {
            border-radius: 20px;
            border: 1px solid #fe7865;
            background-color: #fe7865;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

        .bbut {
            padding-bottom: 1%;
            padding-left: 640px;
        }


        input[type="file"] {
            display: none;
        }

        label {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
            height: 48px;

            font-family: "Montserrat", sans-serif;
        }

        #selectedBanner {
            position: absolute;
            margin-top: 60%;
            margin-right: 60%;
            z-index: 10;
        }
    </style>


</head>

<body>

    <div class="containerr" id="containerr">
        <div class="form-containerr sign-up-containerr">
            <form action="accountchoose.php" method="POST" enctype="multipart/form-data">
                <!-- <h1>Sign in as Staff or Admin</h1> -->

                <!-- <span>or use your email for registration</span> -->

                <input type="text" name="txtname" required placeholder="Enter Your Name">
                <input type="email" name="txtmail" required placeholder=" Email Address">
                <input type="Password" name="txtpassword" required placeholder="Password">
                <input type="text" name="txtnumber" required placeholder="Phonenumber">
                <textarea rows="1" cols="20" name="txtaddress" required placeholder="Address"></textarea>

                <div id="selectedBanner"></div>

                <input type="file" name="filecusimage" class="img" id="file" required accept="image/*">
                <label id="file" for="file">
                    <i class="fa fa-image"></i> &nbsp
                    Choose Profile Pic</label>
                <a href="#"></a>
                <button name="btnSignUp">Sign Up</button>

            </form>
        </div>




        <div class="form-containerr sign-in-containerr">

            <form action="accountchoose.php" method="POST">

                <h1>Sign in as Customer</h1>
                <div class="social-containerr">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>

                <span>or use your account</span>
                <input type="email" name="txtemail" required placeholder="Enter Email">
                <input type="Password" name="txtpassword" required placeholder="Password">
                <a href="#">Forgot your password?</a>
                <button name="btnClogin">Sign In</button>

            </form>
        </div>
        <div class="overlay-containerr">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Sign in as Customer!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                    <a href="index.php">
                        <button class="ghost"> Back </button>
                    </a>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Sign up new account!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                    <a href="index.php">
                        <button class="ghost"> Back </button>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const containerr = document.getElementById('containerr');

        signUpButton.addEventListener('click', () => {
            containerr.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            containerr.classList.remove("right-panel-active");
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        var selDiv = "";
        var storedFiles = [];
        $(document).ready(function() {
            $(".img").on("change", handleFileSelect);
            selDiv = $("#selectedBanner");
        });

        function handleFileSelect(e) {
            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);
            filesArr.forEach(function(f) {
                if (!f.type.match("image.*")) {
                    return;
                }
                storedFiles.push(f);

                var reader = new FileReader();
                reader.onload = function(e) {
                    var html =
                        '<img src="' +
                        e.target.result +
                        "\" data-file='" +
                        f.name +
                        "' class='avatar rounded lg' alt='Category Image' height='50px' width='50px'>";
                    selDiv.html(html);
                };
                reader.readAsDataURL(f);
            });
        }
    </script>


</body>

</html>