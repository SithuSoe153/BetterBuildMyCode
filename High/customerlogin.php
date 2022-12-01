<?php
session_start();
include('connect.php');
include('header.php');

if (isset($_POST['btnlogin'])) {
    $email = $_POST['txtemail'];
    $password = $_POST['txtpassword'];

    $select = "SELECT * FROM customer where customeremail='$email' and customerpassword='$password'";
    $query = mysqli_query($connection, $select);
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        $data = mysqli_fetch_array($query);
        $customerid = $data['customerid'];
        $_SESSION['cid'] = $customerid;
        echo "<script>alert('Customer Login Successful')</script>";
        echo "<script>window.location='customerhome.php'</script>";
    } else {
        echo "<script>alert('Invalid Customer Login')</script>";
        echo "<script>window.location='customerlogin.php'</script>";
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
                    <h2 class="title">Customer login</h2>
                </div> <!-- contact title -->
            </div>
        </div> <!-- row -->
        <div class="contact-box mt-70">
            <div class="row">

                <div class="col-lg-12">
                    <div class="contact-form">
                        <form action="customerlogin.php" method="post" data-toggle="validator">
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
                                        <button name="btnlogin" class="main-btn" type="submit">Register</button>
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