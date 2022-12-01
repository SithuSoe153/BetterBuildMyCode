<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('connect.php');
include('cheader.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Better Build - Furniture and Decor Website Template</title>

    <style>
        #searchBar {
            width: 100%;
            height: 32px;
            border-radius: 3px;
            border: 1px solid #eaeaea;
            padding: 5px 10px;
            font-size: 12px;
        }

        #searchWrapper {
            position: relative;
        }

        #searchWrapper::after {
            content: '🔍';
            position: absolute;
            top: 7px;
            right: 15px;
        }
    </style>

</head>

<body>

    <div class=" main-wrapper">
        <div class="container">

            <!-- 
            <form action="wanted.php" method="POST">
                <table class="button" align="center" width="100%">
                    <tr>
                        <td align="right" width="50%"><input type="text" name="txtSearch" placeholder="Search vehicle name"></td>
                        <td aligh="right" width="10%"><input type="submit" name="btnSearch" value="Search"></td>

                    </tr>
                </table>


                <?php
                if (isset($_POST['btnSearch'])) {
                    $VehicleName = $_POST['txtSearch'];
                    $query = "SELECT * FROM product WHERE productname LIKE '%$VehicleName%'";
                    $result = mysqli_query($connection, $query);
                    $count = mysqli_num_rows($result);

                    if ($count > 0) {
                        // echo "<table class='car' align='center' width='65%'>";
                        for ($i = 0; $i < $count; $i += 1) {
                            $query1 = "SELECT * FROM product 
                            WHERE productname LIKE '%$VehicleName%'
                            LIMIT $i,1";
                            $result1 = mysqli_query($connection, $query1);
                            $count1 = mysqli_num_rows($result1);
                            // echo "<tr>";
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
                            // echo "</tr>";
                        }
                        // echo "</table>";
                    } else {
                        // echo "<h1><b><u>Search Record Not Found</u></b></h1>";
                    }
                } else {

                    $query = "SELECT * FROM product WHERE productname LIKE '%$VehicleName%'";
                    $result = mysqli_query($connection, $query);
                    $count = mysqli_num_rows($result);

                    if ($count > 0) {
                        // echo "<table class='car' align='center' width='70%'>";
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
                            // echo "</tr>";
                        }
                        // echo "</table>";
                    }
                }
                ?> -->



            <div class="display-style-btns">
                <button type="button" id="grid-active-btn">
                    <i class="fas fa-th"></i>
                </button>
                <button type="button" id="details-active-btn">
                    <i class="fas fa-list-ul"></i>
                </button>
            </div>

            <div class="item-list">

                <?php
                $query = "SELECT * FROM product ORDER BY productid DESC";
                $ret = mysqli_query($connection, $query);
                $count = mysqli_num_rows($ret);
                if ($count < 1) {
                    echo "<p>No Product Data Found.</p>";
                    exit();
                }

                for ($a = 0; $a < $count; $a += 3) {
                    $query1 = "SELECT * FROM product ORDER BY productid DESC LIMIT $a,3";
                    $ret1 = mysqli_query($connection, $query1);
                    $count1 = mysqli_num_rows($ret1);

                    for ($b = 0; $b < $count1; $b++) {
                        $arr = mysqli_fetch_array($ret1);
                        $productid = $arr['productid'];
                        $productname = $arr['productname'];
                        $price = $arr['unitprice'];
                        $Image = $arr['productprofile'];

                ?>


                        <div class="item">
                            <div class="item-img">
                                <img src="<?php echo $Image ?>">
                                <div class="icon-list">
                                    <button type="button">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                    <button type="button">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                    <button type="button">
                                        <i class="fab fa-facebook-f"></i>
                                        <!-- <i class="far fa-heart"></i> -->
                                        <!-- <i class="fa fa-plus" aria-hidden="true"></i> -->

                                    </button>
                                </div>
                            </div>
                            <div class="item-detail">
                                <a href="#" class="item-name"><?php echo $productname ?></a>
                                <div class="item-price">
                                    <span class="new-price"><?php echo $price ?> MMK</span>
                                    <!-- <span class="old-price">$275.60</span> -->
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim consectetur cum?</p>
                                <button type="button" class="add-btn">add to cart</button>
                            </div>
                        </div>

                <?php
                    }
                }

                ?>

            </div>

        </div>
    </div>

    <?php
    include('footer.php');
    ?>

</body>

</html>