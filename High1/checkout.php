<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('cheader.php');
include('connect.php');
include('autoidfunction.php');

include('shoppingcart_functions.php');

if (isset($_POST['btnCheckout'])) {

    $orderid = $_POST['txtOrderID'];
    $orderdate = $_POST['txtOrderDate'];
    $formatdate = date('Y-m-d', strtotime($orderdate));

    $customerid = $_SESSION['cid'];
    $customername = $_SESSION['cusname'];
    $customermail = $_SESSION['cusmail'];

    $totalamount = CalculateTotalAmount();
    $totalquantity = CalculateTotalQuantity();
    $status = "Pending";
    $card = $_POST['txtcard'];

    echo $orderid;
    echo $formatdate;

    $query = "INSERT INTO orders
	(orderid, orderdate, customerid, totalamount, totalquantity,
	orderstatus,cardtype)
	VALUES
	('$orderid','$formatdate','$customerid','$totalamount','$totalquantity',
	'$status','$card')";
    $ret = mysqli_query($connection, $query);
    echo $ret;

    $size = count($_SESSION['shopcart']);
    for ($i = 0; $i < $size; $i++) {
        $productid = $_SESSION['shopcart'][$i]['productid'];
        $price = $_SESSION['shopcart'][$i]['price'];
        $BuyQuantity = $_SESSION['shopcart'][$i]['BuyQuantity'];

        $insert_ODetail = "INSERT INTO orderdetail
		(orderid, productid, unitprice, unitquantity)
		VALUES
		('$orderid','$productid','$price','$BuyQuantity')";
        $ret = mysqli_query($connection, $insert_ODetail);

        $updateQty = "UPDATE product
		SET unitquantity=unitquantity-'$BuyQuantity'
		WHERE productid='$productid'";
        $ret = mysqli_query($connection, $updateQty);
    }
    if ($ret) {
        unset($_SESSION['shopcart']);
        echo "<script>alert('Checkout Process Complete')</script>";
        //  echo "<script>window.location='payment.php?oid=$orderid'</script>";
        echo "<script>window.location='phpmailer.php'</script>";
    }
}
?>

<form action="checkout.php" method="POST">

    <div id="capture">

        <table>
            <tr>
                <td>Order ID</td>
                <td>
                    <input name="txtOrderID" type="text" value="<?php echo AutoID('orders', 'orderid', 'OR-', 6) ?>" readonly />
                </td>
            </tr>
            <tr>
                <td>Order Date</td>
                <td>
                    <input name="txtOrderDate" type="date" value="<?php echo date('Y-m-d') ?>" readonly />
                </td>
            </tr>
            <tr>
                <td>Customer Name</td>
                <td>
                    <input type="text" name="txtcustomerid" value="<?php echo $_SESSION['cusname'] ?>">
                </td>
            </tr>
            <tr>
                <td>Total Amount</td>
                <td>
                    <input name="txtTotalAmount" type="text" value="" readonly />MMK
                </td>
            </tr>
            <tr>
                <td>Total Quantity</td>
                <td>
                    <input name="txtTotalQuantity" type="text" value="" readonly />
                </td>
            </tr>

            <tr>
                <td>Card Type</td>
                <td>
                    <select name="txtcard">
                        <option value="Visa">Visa</option>
                        <option value="COD">COD</option>
                        <option value="Master">Master</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" name="btnCheckout">Check Out</button>
                    <a href="">checkout & mail</a>
                </td>
            </tr>
        </table>
        <fieldset>
            <legend>Product List</legend>
            <?php
            if (!isset($_SESSION['shopcart'])) {
                echo "<p>No Shopping Record Found.</p>";
                exit();
            }
            ?>
            <table align="center" border="1" cellpadding="3px">
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

                    echo "<td><a href='shoppingcart.php?action=remove&productid=$productid' style='color:red'>Remove</a></td>";

                    echo "</tr>";
                }
                ?>


            </table>
        </fieldset>
    </div>
</form>
<!-- <button onclick="doCapture();" style=" margin-left: 32%;">Click Here >> If you want to receive Gmail</button> -->
<!-- <input onclick="doCapture();" type="checkbox" id="vehicle1" name="vehicle1" value="Bike"> -->
<input onclick="doCapture();" type="radio" id="html" name="fav_language" value="HTML">




<?php
include('footer.php'); ?>