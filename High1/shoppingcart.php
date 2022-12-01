<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('connect.php');
include('cheader.php');
include('shoppingcart_functions.php');

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action === "buy") {
        $productid = $_GET['productid'];
        $BuyQuantity = $_GET['txtBuyQuantity'];
        Add($productid, $BuyQuantity);
    } elseif ($action === 'remove') {
        $productid = $_GET['productid'];
        Remove($productid);
    }
}
?>

<div class=" main-wrapper">
    <div class="container">

        <fieldset style="margin-top: 171px;margin-left: 20%;">
            <legend>Product List</legend>
            <?php
            if (!isset($_SESSION['shopcart'])) {
                echo "<p>No Shopping Record Found.</p>";
                exit();
            }
            ?>
            <table align=" center" border="1" cellpadding="3px">
                <tr>
                    <th>Image</th>
                    <th>ProductID</th>
                    <th>ProductName</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Sub Total</th>
                    <th>Action</th>
                </tr>
                <?php
                $size = count($_SESSION['shopcart']);
                for ($i = 0; $i < $size; $i++) {
                    $image1 = $_SESSION['shopcart'][$i]['image1'];
                    $productid = $_SESSION['shopcart'][$i]['productid'];
                    $productname = $_SESSION['shopcart'][$i]['productname'];
                    $price = $_SESSION['shopcart'][$i]['price'];
                    $quantity = $_SESSION['shopcart'][$i]['BuyQuantity'];
                    $Subtotal = $price * $quantity;

                    echo "<tr>";
                    echo "<td><img src='$image1' width='100px' height='100px'/></td>";
                    echo "<td>$productid</td>";
                    echo "<td>$productname</td>";
                    echo "<td>$price MMK</td>";
                    echo "<td>$quantity Pcs</td>";
                    echo "<td>$Subtotal MMK</td>";

                    echo "<td><a href='shoppingcart.php?action=remove&productid=$productid' style='color:red'>Remove</a><td>";

                    echo "</tr>";
                }
                ?>

                <tr>
                    <td colspan="7" align="right">
                        TotalAmount:<b><?php echo CalculateTotalAmount() ?></b>MMK<br />
                        TotalQuantity:<b><?php echo CalculateTotalQuantity() ?></b> <br />
                        <a href="index.php" style="color:red">Product Display</a> |
                        <a href="checkout.php" style="color:red">Make Checkout</a>

                    </td>
                </tr>

            </table>
        </fieldset>
    </div>
</div>

<?php
include('footer.php');
