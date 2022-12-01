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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>


    <fieldset>
        <legend>Product List:</legend>
        <table align="center" cellpadding="10px">
            <?php
            $query = "SELECT * FROM product ORDER BY productid DESC";
            $ret = mysqli_query($connection, $query);
            $count = mysqli_num_rows($ret);
            if ($count < 1) {
                echo "<p>No Product Data Found.</p>";
                exit();
            }
            for ($a = 0; $a < $count; $a += 3) {
                $query1 = "SELECT * FROM product ORDER BY productid DESC LIMIT $a,4";
                $ret1 = mysqli_query($connection, $query1);
                $count1 = mysqli_num_rows($ret1);
                echo "<tr>";
                for ($b = 0; $b < $count1; $b++) {
                    $arr = mysqli_fetch_array($ret1);
                    $productid = $arr['productid'];
                    $productname = $arr['productname'];
                    $price = $arr['unitprice'];
                    $Image = $arr['productprofile'];

            ?>
                    <td>

                        <div class="item">
                            <div class="item-img">
                                <img src="<?php echo $Image ?>" width="200px" height="200px">
                                <div class="icon-list">
                                    <button type="button">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                    <button type="button">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                    <button type="button">
                                        <i class="far fa-heart"></i>
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

                    </td>
            <?php
                }
                echo "</tr>";
            }

            ?>
        </table>
    </fieldset>

    <!-- ========================== FOOTER PART START ==========================  -->

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

    <!--====== Script js ======-->
    <script src="assets/js/script.js"></script>

</body>

</html>