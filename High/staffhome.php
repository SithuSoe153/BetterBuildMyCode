<?php
include('connect.php');
include('header.php');

if (isset($_POST['btnregister'])) {
    $customername = $_POST['customername'];
    $customerpassword = $_POST['customerpassword'];
    $customeremail = $_POST['customeremail'];
    $customerphonenumber = $_POST['customerphonenumber'];
    $customeraddress = $_POST['customeraddress'];

    $select = "SELECT * FROM customer where customeremail='$customeremail'";
    $query1 = mysqli_query($connection, $select);
    $count = mysqli_num_rows($query1);
    if ($count > 0) {
        echo "<script>alert('Duplicate Customer')</script>";
    } else {
        $insert = "INSERT INTO customer
            (customername,customerpassword,customeremail,customerphonenumber,customeraddress)
            VALUES
            ('$customername','$customerpassword','$customeremail','$customerphonenumber','$customeraddress')";
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
                    <h2 class="title">Staff Home</h2>
                </div> <!-- contact title -->
            </div>
        </div> <!-- row -->
        <div class="contact-box mt-70">
            <div class="row">

                <div class="col-lg-12">
                    <div class="contact-form">
                        <form action="customer.php" method="post" data-toggle="validator">
                            <div class="row">


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