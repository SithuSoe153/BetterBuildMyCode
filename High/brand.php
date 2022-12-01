<?php
include('connect.php');
include('header.php');
if (isset($_POST['btnsave'])) {
    $brand = $_POST['brand'];

    $select = "SELECT * FROM brand where brandname='$brand'";
    $query1 = mysqli_query($connection, $select);
    $count = mysqli_num_rows($query1);
    if ($count > 0) {
        echo "<script>alert('Duplicate Brand')</script>";
    } else {
        $insert = "INSERT INTO brand(brandname) values('$brand')";
        $query = mysqli_query($connection, $insert);
        if ($query) {
            echo "<script>alert('Brand Record Successful')</script>";
        }
    }
}
?>



<!--====== CONTACT PART START ======-->

<section id="contact" class="contact-area pt-115">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="contact-title text-center">
                    <h2 class="title">Brand Register</h2>
                </div> <!-- contact title -->
            </div>
        </div> <!-- row -->
        <div class="contact-box mt-70">
            <div class="row">

                <div class="col-lg-12">
                    <div class="contact-form">
                        <form action="brand.php" method="post" data-toggle="validator">
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="single-form form-group">


                                        <input type="text" name="brand" required placeholder="Enter Brand Name">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- single form -->
                                </div>


                                <p class="form-message"></p>
                                <div class="col-lg-12">
                                    <div class="single-form form-group">
                                        <button name="btnregister" class="main-btn" type="submit">Register</button>
                                        <button name="btnclear" class="main-btn" type="reset">Clear</button>
                                    </div> <!-- single form -->


                                    <p class="form-message"></p>
                                    <div class="col-lg-12">
                                        <div class="single-form form-group">
                                            <input type="submit" name="btnsave" value="Save">
                                        </div> <!-- single form -->
                                        <div class="col-lg-12">
                                            <div class="single-form form-group">
                                                <input type="reset" name="btnreset" value="Reset">
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