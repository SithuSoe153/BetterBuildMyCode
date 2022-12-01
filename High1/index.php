<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('connect.php');
include('cheader.php');
include('slider.php');

$file_pointer = "images/captureimage.jpeg";

// Use unlink() function to delete a file
if (!unlink($file_pointer)) {
    // echo ("$file_pointer cannot be deleted due to an error");
} else {
    // echo ("$file_pointer has been deleted");
}


?>

<form action="index.php" method="POST">


    <div class=" main-wrapper">
        <div class="container">

            <table class="searchbar" align="center" width="100%">
                <tr>
                    <td align="right" width="50%"><input type="text" name="txtSearch" placeholder="Search furniture name"></td>
                    <td aligh="right" width="10%"><input class="main-btn" type="submit" name="btnSearch" value="Search"></td>

                </tr>

            </table>

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
                if (isset($_POST['btnSearch'])) {
                    $VehicleName = $_POST['txtSearch'];
                    $query = "SELECT * FROM product WHERE productname LIKE '%$VehicleName%'";
                    $result = mysqli_query($connection, $query);
                    $count = mysqli_num_rows($result);


                    if ($count > 0) {
                        for ($i = 0; $i < $count; $i += 1) {
                            $query1 = "SELECT * FROM product 
                            WHERE productname LIKE '%$VehicleName%'
                            LIMIT $i,1";

                            $result1 = mysqli_query($connection, $query1);
                            $count1 = mysqli_num_rows($result1);

                            for ($j = 0; $j < $count1; $j++) {
                                $arr = mysqli_fetch_array($result1);
                                $productid = $arr['productid'];
                                $productname = $arr['productname'];
                                $price = $arr['unitprice'];
                                $Image = $arr['productprofile'];
                ?>

                                <div class="item">
                                    <div class="item-img">
                                        <a href="productdetail.php?productid=<?php echo $productid ?>">
                                            <img src="<?php echo $Image ?>">
                                        </a>
                                        <div class="icon-list">
                                            <a href="#">
                                                <button type="button">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                            </a>
                                            <a href="#">
                                                <button type="button">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </button>
                                            </a>
                                            <a href="#">
                                                <button type="button">
                                                    <i class="fab fa-facebook-f"></i>
                                                </button>
                                            </a>
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
                    } else {
                        echo "<h1><b><u>Search Record Not Found</u></b></h1>";
                    }
                } else {


                    $query = "SELECT * FROM product ORDER BY productid";
                    $result = mysqli_query($connection, $query);
                    $count = mysqli_num_rows($result);

                    if ($count > 0) {
                        for ($i = 0; $i < $count; $i += 1) {
                            $query1 = "SELECT * FROM product ORDER BY productname LIMIT $i,1";
                            $result1 = mysqli_query($connection, $query1);
                            $count1 = mysqli_num_rows($result1);

                            for ($j = 0; $j < $count1; $j++) {
                                $arr = mysqli_fetch_array($result1);
                                $productid = $arr['productid'];
                                $productname = $arr['productname'];
                                $price = $arr['unitprice'];
                                $Image = $arr['productprofile'];
                                $itemdetail = $arr['productdescription'];

                            ?>
                                <div class="item">
                                    <div class="item-img">
                                        <a href="productdetail.php?productid=<?php echo $productid ?>">
                                            <img src="<?php echo $Image ?>">
                                        </a>
                                        <div class="icon-list">
                                            <a href="#">
                                                <button type="button">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                            </a>

                                            <a href="#">
                                                <button type="button">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </button>
                                            </a>
                                            <a href="#">
                                                <button type="button">
                                                    <i class="fab fa-facebook-f"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="item-detail">
                                        <a href="#" class="item-name"><?php echo $productname ?></a>
                                        <div class="item-price">
                                            <span class="new-price"><?php echo $price ?> MMK</span>
                                            <!-- <span class="old-price">$275.60</span> -->
                                        </div>
                                        <?php
                                        echo " <p> $itemdetail </p> ";

                                        ?>
                                        <button type="button" class="add-btn">add to cart</button>
                                    </div>
                                </div>


                <?php


                            }
                        }
                    }
                }
                ?>

            </div>

        </div>
    </div>


</form>


<?php
include('footer.php');
?>