<?php
include('connect.php');
include('header.php');
$select = "SELECT * FROM staff";
$query = mysqli_query($connection, $select);
$count = mysqli_num_rows($query);



if ($count > 0) {
?>

    <section id="contact" class="contact-area pt-115">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="contact-title text-center">
                        <h2 class="title">Staff List</h2>
                    </div> <!-- contact title -->
                </div>
            </div> <!-- row -->
            <div class="contact-box mt-70">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="contact-form">
                            <form action="staff.php" method="post" data-toggle="validator">
                                <div class="row">

                                    <style>
                                        tr:hover {
                                            background-color: #cad6e8;
                                        }
                                    </style>

                                    <table border="1">
                                        <tr>
                                            <th>Staff Id</th>
                                            <th>Staff Name</th>
                                            <th>Staff Email</th>
                                            <th>Password</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Staff Profile</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php
                                        for ($i = 0; $i < $count; $i++) {
                                            $data = mysqli_fetch_array($query);
                                            $staffid = $data['staffid'];
                                            $staffname = $data['staffname'];
                                            $staffemail = $data['staffemail'];
                                            $password = $data['password'];
                                            $phonenumber = $data['phonenumber'];
                                            $address = $data['address'];
                                            $staffprofile = $data['staffprofile']
                                        ?>

                                            <tr>
                                                <td><?php echo $data['staffid']; ?></td>
                                                <td><?php echo $data['staffname']; ?></td>
                                                <td><?php echo $data['staffemail']; ?></td>
                                                <td><?php echo $data['password']; ?></td>
                                                <td><?php echo $data['phonenumber']; ?></td>
                                                <td><?php echo $data['address']; ?></td>
                                                <td><?php echo $data['staffprofile']; ?></td>
                                                <td>

                                                <?php
                                                echo "<a href='updatestaff.php?sid= $staffid' class='main-btn'> Update </a>
                                                    <a href='deletestaff.php?sid= $staffid' class='main-btn'> Delete </a>
                                                </td>
                                            </tr> ";
                                            }
                                                ?>
                                    </table>
                                <?php
                            }
                                ?>


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