<?php
include('connect.php');
include('header.php');

if (isset($_POST['btnregister'])) {
    $customername = $_POST['customername'];
    $customerpassword = $_POST['customerpassword'];
    $customeremail = $_POST['customeremail'];
    $customerphonenumber = $_POST['customerphonenumber'];
    $customeraddress = $_POST['customeraddress'];

    //////////////////////////////////Image/////////////////////////////////

    $Image = $_FILES['customerprofile']['name'];
    $Folder = "image/";
    $filename = $Folder . '_' . $Image;
    $image = copy($_FILES['customerprofile']['tmp_name'], $filename);
    if (!$image) {
        echo "<p>Cannot Upload  Customer Profile</p>";
        exit();
    }


    /////////////////////////////////////////////////////////////////////////

    $select = "SELECT * FROM customer where customeremail='$customeremail'";
    $query1 = mysqli_query($connection, $select);
    $count = mysqli_num_rows($query1);
    if ($count > 0) {
        echo "<script>alert('Duplicate Customer')</script>";
    } else {
        $insert = "INSERT INTO customer
        (customername,customerpassword,customeremail,customerphonenumber,customeraddress,customerprofile)
        VALUES
        ('$customername','$customerpassword','$customeremail','$customerphonenumber','$customeraddress','$filename')";
        $query = mysqli_query($connection, $insert);
        if ($query) {
            echo "<script>alert('Customer Register Successfully!')</script>";
        }
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
                    <h2 class="title">Customer Register</h2>
                </div> <!-- contact title -->
            </div>
        </div> <!-- row -->
        <div class="contact-box mt-70">
            <div class="row">

                <div class="col-lg-12">
                    <div class="contact-form">
                        <form action="customer.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="single-form form-group">
                                        <input type="file" name="customerprofile" placeholder="Enter Customer Profile">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- single form -->
                                </div>

                                <div class="col-lg-6">
                                    <div class="single-form form-group">
                                        <input type="text" name="customername" placeholder="Enter Customer Name" required="required">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-form form-group">
                                        <input type="email" name="customeremail" placeholder="Customer-Email" require>
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-form form-group">
                                        <input type="text" name="customerphonenumber" placeholder="Enter Phone Number" required="required">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-form form-group">
                                        <input type="Password" name="customerpassword" placeholder="Enter Password" required="required">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-lg-12">
                                    <div class="single-form form-group">
                                        <textarea name="customeraddress" placeholder="Address" required="required"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- single form -->
                                </div>

                                <p class="form-message"></p>
                                <div class="col-lg-12">
                                    <div class="single-form form-group">
                                        <button name="btnregister" class="main-btn" type="submit">Register</button>
                                        <button name="btnclear" class="main-btn" type="reset">Clear</button>
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