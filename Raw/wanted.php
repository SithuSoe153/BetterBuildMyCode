<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



session_start();
include('connect.php');

include('header.php');


?>


<!-- Registration -->
<div id="register" class="form-1">
    <div class="container">
        <div class="row">

            <div class="col-lg-9">

                <!-- Registration Form -->
                <div class="form-container">


                    <form action="wanted.php" method="POST">
                        <table class="button" align="center" width="100%">
                            <tr>
                                <td align="right" width="50%"><input type="text" name="txtSearch" placeholder="Search vehicle name"></td>
                                <td aligh="right" width="10%"><input type="submit" name="btnSearch" value="Search"></td>

                            </tr>
                        </table>

                        <style>
                            .car {

                                text-align: center;
                                background-color: seashell;
                                border-collapse: collapse;
                            }

                            .car th {
                                background-color: lavenderblush;
                                color: maroon;
                            }

                            .car td,
                            .car th {
                                padding: 10px;
                                border: 2px solid gainsboro;
                            }
                        </style>



                        <?php
                        if (isset($_POST['btnSearch'])) {
                            $VehicleName = $_POST['txtSearch'];
                            echo $VehicleName;
                            $query = "SELECT * FROM product WHERE productname LIKE '%$VehicleName%'";
                            $result = mysqli_query($connection, $query);
                            $count = mysqli_num_rows($result);

                            if ($count > 0) {
                                echo "<table class='car' align='center' width='65%'>";
                                for ($i = 0; $i < $count; $i += 1) {
                                    $query1 = "SELECT * FROM product 
                            WHERE productname LIKE '%$VehicleName%'
                            LIMIT $i,1";
                                    $result1 = mysqli_query($connection, $query1);
                                    $count1 = mysqli_num_rows($result1);
                                    echo "<tr>";
                                    for ($j = 0; $j < $count1; $j++) {
                                        $arr = mysqli_fetch_array($result1);
                                        echo "<td>";
                                        // echo "<a href='VehicleDetail.php?PID=" . $arr['ProductCode'] . "'>";
                                        echo "<img src='" . $arr['productprofile'] . "' width='450px'>";
                                        echo "<br>";
                                        echo "<br>";
                                        echo "<b>" . $arr['productname'] . "</b>";
                                        echo "<br>";
                                        echo $arr['unitprice'] . " <b>MMK</b>";
                                        echo "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";
                            } else {
                                echo "<h1><b><u>Search Record Not Found</u></b></h1>";
                            }
                        } else {

                            $query = "SELECT * FROM product WHERE productname LIKE '%$VehicleName%'";
                            $result = mysqli_query($connection, $query);
                            $count = mysqli_num_rows($result);





                            if ($count > 0) {
                                echo "<table class='car' align='center' width='70%'>";
                                for ($i = 0; $i < $count; $i += 1) {
                                    $query1 = "SELECT * FROM product ORDER BY productname
                            LIMIT $i,1";
                                    $result1 = mysqli_query($connection, $query1);
                                    $count1 = mysqli_num_rows($result1);
                                    echo "<tr>";
                                    for ($j = 0; $j < $count1; $j++) {
                                        $arr = mysqli_fetch_array($result1);
                                        // $productcode = $arr['ProductCode'];
                                        $productimage = $arr['productprofile'];
                                        $productname = $arr['productname'];
                                        $price = $arr['unitprice'];
                                        echo "<td>";
                                        // echo "<a href='ProductDetail.php?PID=$productcode'>";
                                        echo "<img src='$productimage' width='400px'>";
                                        echo "<br>";
                                        echo "<b>$productname</b></a>";
                                        echo "<br>";
                                        echo $price;
                                        echo "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";
                            }
                        }
                        ?>
                </div> <!-- end of form-container -->
                <!-- end of registration form -->

            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of form-1 -->
<!-- end of registration -->

</form>


<!-- Details Lightbox -->
<div id="details-lightbox" class="lightbox-basic zoom-anim-dialog mfp-hide">
    <div class="container">
        <div class="row">
            <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
            <div class="col-lg-8">
                <div class="image-container">
                    <img class="img-fluid" src="images/details-lightbox.jpg" alt="alternative">
                </div> <!-- end of image-container -->
            </div> <!-- end of col -->
            <div class="col-lg-4">
                <h3>SEO Training Course</h3>
                <hr>
                <h5>For everybody</h5>
                <p>The training course is dedicates to anyone passionate about the web and in need of improving their current online presence.</p>
                <ul class="list-unstyled li-space-lg">
                    <li class="media">
                        <i class="fas fa-square"></i>
                        <div class="media-body">Link building framework</div>
                    </li>
                    <li class="media">
                        <i class="fas fa-square"></i>
                        <div class="media-body">Know your current position</div>
                    </li>
                    <li class="media">
                        <i class="fas fa-square"></i>
                        <div class="media-body">Partnering with blogs</div>
                    </li>
                    <li class="media">
                        <i class="fas fa-square"></i>
                        <div class="media-body">Naming your images</div>
                    </li>
                    <li class="media">
                        <i class="fas fa-square"></i>
                        <div class="media-body">Creating good sitemaps</div>
                    </li>
                    <li class="media">
                        <i class="fas fa-square"></i>
                        <div class="media-body">Writing for humans</div>
                    </li>
                </ul>
                <a class="btn-solid-reg mfp-close page-scroll" href="#register">SIGN UP</a> <a class="btn-outline-reg mfp-close as-button" href="#screenshots">BACK</a>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of lightbox-basic -->
<!-- end of details lightbox -->


<?php
include('footer.php');
?>