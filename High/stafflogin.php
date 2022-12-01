<?php
include('connect.php');
include('header.php');
if (isset($_POST['btnlogin'])) {
    $email = $_POST['txtemail'];
    $password = $_POST['txtpassword'];

    $select = "SELECT * FROM staff where staffemail='$email' and password='$password'";
    $query = mysqli_query($connection, $select);
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        echo "<script>alert('Staff Login Successful')</script>";
        echo "<script>window.location='staffhome.php'</script>";
    } else {
        echo "<script>alert('Invalid Staff Login')</script>";
        echo "<script>window.location='staffloginraw.php'</script>";
    }
}
?>


<!--====== TITLE PART START ======-->

<title>Better Build - Furniture and Decor Website Template</title>

<!--====== CONTACT PART START ======-->

<section id="contact" class="contact-area pt-115">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="contact-title text-center">
                    <h2 class="title">Staff Login</h2>
                </div> <!-- contact title -->
            </div>
        </div> <!-- row -->
        <div class="contact-box mt-70">
            <div class="row">

                <div class="col-lg-12">
                    <div class="contact-form">
                        <form action="stafflogin.php" method="post" data-toggle="validator">
                            <div class="row">


                                <div class="col-lg-6">
                                    <div class="single-form form-group">
                                        <input type="email" name="txtemail" required placeholder="Enter Email Address">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- single form -->
                                </div>


                                <div class="col-lg-6">
                                    <div class="single-form form-group">
                                        <input type="Password" name="txtpassword" required placeholder="Enter Password">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- single form -->
                                </div>

                                <p class="form-message"></p>
                                <div class="col-lg-12">
                                    <div class="single-form form-group">
                                        <button name="btnlogin" class="main-btn" type="submit">Login</button>
                                    </div> <!-- single form -->
                                </div>

                            </div> <!-- row -->
                        </form>
                    </div> <!-- row -->
                </div>
            </div> <!-- row -->
        </div> <!-- contact box -->
    </div> <!-- container -->
</section>

<!--====== CONTACT PART ENDS ======-->



<?php
include('footer.php');
?>




<!--====== jquery js ======-->
<script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
<script src="assets/js/vendor/jquery-1.12.4.min.js"></script>

<!--====== Bootstrap js ======-->
<script src="assets/js/bootstrap.min.js"></script>


<!--====== Slick js ======-->
<script src="assets/js/slick.min.js"></script>

<!--====== Magnific Popup js ======-->
<script src="assets/js/jquery.magnific-popup.min.js"></script>


<!--====== nav js ======-->
<script src="assets/js/jquery.nav.js"></script>

<!--====== Nice Number js ======-->
<script src="assets/js/jquery.nice-number.min.js"></script>

<!--====== Main js ======-->
<script src="assets/js/main.js"></script>

</body>

</html>