 <?php
    include('connect.php');
    include('header.php');

    if (isset($_POST['btnregister'])) {
        $rawtype = $_POST['rawtype'];
        $rawdes = $_POST['rawdes'];
        $rawtp = $_POST['rawtp'];
        $rawqtyleft = $_POST['rawqtyleft'];


        $select = "SELECT * FROM raw where rawtp='$rawtp'";
        $query1 = mysqli_query($connection, $select);
        $count = mysqli_num_rows($query1);
        if ($count > 0) {
            echo "<script>alert('Duplicate Raw')</script>";
        } else {
            $insert = "INSERT INTO raw
        (rawtype,rawdes,rawtp,rawqtyleft)
        VALUES
        ('$rawtype','$rawdes','$rawtp','$rawqtyleft')";
            $query = mysqli_query($connection, $insert);
            if ($query) {
                echo "<script>alert('Raw Register Successful!')</script>";
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
                     <h2 class="title">Raw Register</h2>
                 </div> <!-- contact title -->
             </div>
         </div> <!-- row -->
         <div class="contact-box mt-70">
             <div class="row">

                 <div class="col-lg-12">
                     <div class="contact-form">
                         <form action="raw.php" method="post" data-toggle="validator">
                             <div class="row">

                                 <div class="col-lg-6">
                                     <div class="single-form form-group">
                                         <input type="name" name="rawtype" placeholder="Raw Type" data-error="Valid email is required." required>
                                         <div class="help-block with-errors"></div>
                                     </div> <!-- single form -->
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="single-form form-group">
                                         <input type="text" name="rawdes" placeholder="Raw Description" data-error="Valid email is required." required="required">
                                         <div class="help-block with-errors"></div>
                                     </div> <!-- single form -->
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="single-form form-group">
                                         <input type="type" name="rawtp" placeholder="Total Price" data-error="Valid email is required." required="required">
                                         <div class="help-block with-errors"></div>
                                     </div> <!-- single form -->
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="single-form form-group">
                                         <input type="text" name="rawqtyleft" placeholder="QTY Left" data-error="Valid email is required." required="required">
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