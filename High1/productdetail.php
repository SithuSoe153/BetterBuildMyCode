<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('connect.php');
include('cheader.php');

if (!isset($_SESSION['cid'])) {
    echo "<script>alert('Pls Login Again')</script>";
    echo "<script>window.location='accountchoose.php'</script>";
}


if (isset($_REQUEST['productid'])) {
    $productid = $_REQUEST['productid'];
    $query = "SELECT p.*,c.categoryid,c.categoryname
    FROM product p,category c
    WHERE p.categoryid=c.categoryid
    AND p.productid='$productid'";
    $ret = mysqli_query($connection, $query);
    $arr = mysqli_fetch_array($ret);

    $maxno = $arr['unitquantity'];

    $productid = $arr['productid'];
    $productname = $arr['productname'];
    $unitprice = $arr['unitprice'];
    $quantity = $arr['unitquantity'];
    $categoryname = $arr['categoryname'];
    $image1 = $arr['productprofile'];
    $TD = $arr['3D'];
} else {
    echo "<script>window.location='index.php'</script>";
}

?>


<div class=" main-wrapper">
    <div class="container" style="padding-top: 89px;">

        <form action="shoppingcart.php" method="get">
            <input type="hidden" name="productid" value="<?php echo $productid ?>" />
            <input type="hidden" name="action" value="buy" />

            <fieldset>
                <legend>Product Detail of <?php echo $productname ?></legend>
                <table align="center">
                    <tr>
                        <td>
                            <?php if (!$TD) { ?>
                                <img src="<?php echo $image1 ?>" width="$400px" height="400px" id="ImgPhoto" /><br />
                            <?php } else { ?>

                            <?php include('enter3D.php');
                            } ?>
                            <!-- <img src="<?php echo $image1 ?>" width="$400px" height="400px" id="ImgPhoto" /><br /> -->
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td>Product Name</td>
                                    <td>
                                        :<b><?php echo $productname ?></b>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Category Name</td>
                                    <td><?php echo $categoryname ?></td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>
                                        :<b style="colour:blue;"><?php echo $unitprice ?></b>MMK
                                    </td>
                                </tr>
                                <tr>
                                    <td>Quantity</td>
                                    <td>
                                        :<b>
                                            <?php
                                            if ($quantity < 1) {
                                                echo "Out Of Stock";
                                                exit();
                                            }
                                            echo $maxno ?>

                                        </b>Pcs

                                    </td>
                                </tr>
                                <tr>
                                    <td>Buying Quantity</td>
                                    <td>
                                        :
                                        <?php
                                        echo '<input type="number" name="txtBuyQuantity" value="1" min="1" max="' . $quantity . '" />';
                                        ?>
                                        <input type="submit" name="btnAdd" value="Add" />
                                    </td>
                                </tr>

                            </table>

                        </td>
                    </tr>

                </table>
            </fieldset>

        </form>

        <?php
        include('connect.php');
