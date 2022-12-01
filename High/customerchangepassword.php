<?php
session_start();
include('connect.php');
include('header.php');

if (isset($_SESSION['cid'])) {
    $cusid = $_SESSION['cid'];

    $select = "SELECT * FROM customer where customerid='$cusid'";
    $query = mysqli_query($connection, $select);
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        $data = mysqli_fetch_array($query);
        $password = $data['customerpassword'];
    }
}
if (isset($_POST['btnchange'])) {
    $npassword = $_POST['txtnewpassword'];
    $customerid = $_POST['txtcustomerid'];
    $update = "UPDATE customer set customerpassword='$npassword'
    where customerid = '$customerid'";

    $query = mysqli_query($connection, $update);

    if ($query) {
        echo "<script>alert('Customer Password Change Successful')</script>";
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
                    <h2 class="title">Customer Change Password</h2>
                </div> <!-- contact title -->
            </div>
        </div> <!-- row -->
        <div class="contact-box mt-70">
            <div class="row">

                <div class="col-lg-12">
                    <div class="contact-form">
                        <form action="customerchangepassword.php" method="post">
                            <div class="row">

                                <input type="hidden" name="txtcustomerid" value="<?php echo $cusid ?>">


                                <!-- Old Password -->
                                <div class="col-lg-6">
                                    <div class="single-form form-group">
                                        <input type="text" name="txtoldpassword" value="<?php echo $password ?>" readonly>
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- single form -->
                                </div>

                                <!-- New Password -->
                                <div class="col-lg-6">
                                    <div class="single-form form-group">
                                        <input type="Password" name="txtnewpassword" required placeholder="Enter new password">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- single form -->
                                </div>


                                <p class="form-message"></p>
                                <div class="col-lg-12">
                                    <div class="single-form form-group">
                                        <button name="btnchange" class="main-btn" type="submit">Change</button>
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