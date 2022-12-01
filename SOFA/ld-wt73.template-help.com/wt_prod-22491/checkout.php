<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('connect.php');
include('cheader.php');


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
    $card = $_POST['input-group-radio'];
    $delivery = $_POST['delivery_radio'];

    echo $orderid;
    echo $formatdate;

    $query = "INSERT INTO orders
	(orderid, orderdate, customerid, totalamount, totalquantity,
	orderstatus,cardtype,delivery)
	VALUES
	('$orderid','$formatdate','$customerid','$totalamount','$totalquantity',
	'$status','$card','$delivery')";
    $ret = mysqli_query($connection, $query);
    // echo $ret;

    $cusName = $_POST['cusName'];
    $cusAddress = $_POST['cusAddress'];
    $cusPhone = $_POST['cusPhone'];
    if ($delivery == "YES") {
        $query = "INSERT INTO delivery
	(orderid, cusName, cusAddress, cusPhone)
	VALUES
	('$orderid','$cusName','$cusAddress','$cusPhone')";
        $ret = mysqli_query($connection, $query);
    }

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

<script src="js/html2canvas.js"></script>

<form action="checkout.php" method="POST">

    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="images/bg-about.jpg">
            <div class="breadcrumbs-custom-body parallax-content context-dark">
                <div class="container">
                    <h2 class="breadcrumbs-custom-title">Checkout</h2>
                </div>
            </div>
        </div>
        <div class="breadcrumbs-custom-footer">
            <div class="container">
                <ul class="breadcrumbs-custom-path">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="grid-shop.php">Shop</a></li>
                    <li><a href="cart-page.php">Shopping Cart</a></li>
                    <li class="active">Checkout</li>
                </ul>
            </div>
        </div>
    </section>


    <?php

    if (!isset($_SESSION['shopcart']) || !isset($_SESSION['shopcart'][0])) {
        echo "<p>No Shopping Record Found.</p>";
    } else {

    ?>

        <div id="capture">
            <!-- Section checkout form-->
            <section class="section section-sm section-first bg-default text-md-start">
                <div class="container">
                    <div class="row row-50 justify-content-center">

                        <div class="col-md-10 col-lg-6">
                            <h3 class="fw-medium">Delivery Address</h3>
                            <form class="rd-form rd-mailform form-checkout">

                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <div class="form-wrap">
                                            <input class="form-input" id="checkout-company-2" type="text" name="txtOrderID" value="<?php echo AutoID('orders', 'orderid', 'OR-', 6) ?>" readonly />
                                            <label class="form-label" for="checkout-company-2">Order ID</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-wrap">
                                            <input class="form-input" id="checkout-first-name-2" type="date" name="txtOrderDate" value="<?php echo date('Y-m-d') ?>" readonly />
                                            <label class="form-label" for="checkout-first-name-2">Customer Name</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-wrap">
                                            <input class="form-input" id="checkout-first-name-2" type="text" name="cusName" value="<?php echo $_SESSION['cusname'] ?>" />
                                            <label class="form-label" for="checkout-first-name-2">Customer Name</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-wrap">
                                            <input class="form-input" id="checkout-address-2" type="text" name="cusAddress" data-constraints="@Required" />
                                            <label class="form-label" for="checkout-address-2">Address</label>
                                        </div>
                                    </div>

                                    <!-- <div class="col-sm-6">
                                <div class="form-wrap">
                                    <input class="form-input" id="checkout-email-2" type="email" name="email" data-constraints="@Email @Required" />
                                    <label class="form-label" for="checkout-email-2">E-Mail</label>
                                </div>
                            </div> -->

                                    <div class="col-sm-6">
                                        <div class="form-wrap">
                                            <input class="form-input" id="checkout-phone-2" type="text" name="cusPhone" data-constraints="@Numeric" />
                                            <label class="form-label" for="checkout-phone-2">Phone</label>
                                        </div>
                                    </div>



                                </div>
                            </form>
                        </div>
                        <div class="col-md-10 col-lg-6">
                            <h3 class="fw-medium">Payment methods</h3>
                            <div class="box-radio">



                                <!-- <input onclick="document.getElementById('extra1').style.visibility='visible';document.getElementById('extra2').style.visibility='visible';" type="radio" />Apple

                        <input type="radio" id="extra1" style="visibility:hidden" other choice here />

                        <input type="radio" id="extra2" style="visibility:hidden" other choice here /> -->





                                <div class="radio-panel">
                                    <label class="radio-inline">
                                        <input name="input-group-radio" value="Direct Bank Transfer" type="radio" required onclick="document.getElementById('extra1').style.visibility='visible';document.getElementById('extra2').style.visibility='visible';">Direct Bank Transfer
                                    </label>


                                    <br>
                                    <label class="radio-inline" id="extra1" style="visibility:hidden">
                                        <input name="input-group-radio" value="AYA Bank" type="radio" id="extra1" style="visibility:hidden">AYA Bank
                                    </label>

                                    <label class="radio-inline" id="extra2" style="visibility:hidden">
                                        <input name="input-group-radio" value="KBZ Bank" type="radio" id="extra2" style="visibility:hidden">KBZ Bank
                                    </label>


                                </div>
                                <div class="radio-panel">
                                    <label class="radio-inline">
                                        <input name="input-group-radio" value="PayPal" type="radio" onclick="document.getElementById('extra1').style.visibility='hidden';document.getElementById('extra2').style.visibility='hidden';">PayPal
                                    </label>
                                    <div class="radio-panel-content">
                                        <input class="form-input" id="checkout-first-name-2" type="text" name="txtcustomerid" placeholder="Insert" />
                                    </div>
                                </div>
                                <div class="radio-panel">
                                    <label class="radio-inline">
                                        <input name="input-group-radio" value="Cheque Payment" type="radio" onclick="document.getElementById('extra1').style.visibility='hidden';document.getElementById('extra2').style.visibility='hidden';">Cheque Payment
                                    </label>
                                    <div class="radio-panel-content">
                                        <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Shopping Cart-->
            <section class="section section-xl bg-default">
                <div class="container">

                    <!-- shopping-cart-->
                    <div class="table-custom-responsive">
                        <table class="table-custom table-cart">
                            <thead>
                                <tr>
                                    <th>Product name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $size = count($_SESSION['shopcart']);
                                for ($i = 0; $i < $size; $i++) {

                                    $productid = $_SESSION['shopcart'][$i]['productid'];
                                    $productname = $_SESSION['shopcart'][$i]['productname'];
                                    $price = $_SESSION['shopcart'][$i]['price'];
                                    $quantity = $_SESSION['shopcart'][$i]['BuyQuantity'];
                                    $image1 = $_SESSION['shopcart'][$i]['image1'];

                                    $Subtotal = $price * $quantity;
                                ?>

                                    <tr>
                                        <td><a class="table-cart-figure" href="single-product.html"><img src="<?php echo $image1 ?>" alt="" width="146" height="132" /></a><a class="table-cart-link" href="single-product.html"><?php echo $productname ?></a></td>
                                        <td><?php echo $price ?> MMK</td>
                                        <td>
                                            <?php echo $quantity ?>
                                            <!-- <div class="table-cart-stepper">
                                <input class="form-input" type="number" data-zeros="true" value="1" min="1" max="1000">
                            </div> -->
                                        </td>
                                        <td><?php echo $Subtotal ?> MMK</td>
                                        <!-- <td><a href='cart-page.php?action=remove&productid=$productid' style='color:red'>Remove</a></td> -->
                                    </tr>

                                <?php
                                }
                                ?>



                            </tbody>
                        </table>
                    </div>



                    <!-- Cart Total -->

                    <section class="section section-sm section-last bg-default text-md-start">
                        <div class="container">
                            <div class="row row-50 justify-content">


                                <div class="col-md-10 col-lg-6">
                                    <h3 class="fw-medium">Delivery Process</h3>
                                    <div class="box-radio">
                                        <div class="radio-panel">
                                            <label class="radio-inline active">
                                                <input name="delivery_radio" value="YES" type="radio" checked>Delivery
                                            </label>
                                            <div class="radio-panel-content">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will be shipped right away.</p>
                                            </div>
                                        </div>
                                        <div class="radio-panel">
                                            <label class="radio-inline active">
                                                <input name="delivery_radio" value="NO" type="radio" checked>No Delivery
                                            </label>
                                            <div class="radio-panel-content">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will be shipped right away.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-10 col-lg-6">
                                    <h3 class="fw-medium">Cart total</h3>
                                    <div class="table-custom-responsive">
                                        <table class="table-custom table-custom-primary table-checkout">
                                            <tbody>

                                                <tr>
                                                    <td>Total Product</td>
                                                    <td><?php echo CalculateTotalQuantity() ?> Pcs </td>
                                                </tr>

                                                <tr>
                                                    <td>Cart Subtotal</td>
                                                    <td><?php echo CalculateTotalAmount() ?> MMK </td>
                                                </tr>
                                                <tr>
                                                    <td>Shipping</td>
                                                    <td>Free</td>
                                                </tr>
                                                <tr>
                                                    <td>Total</td>
                                                    <td><?php echo CalculateTotalAmount() ?> MMK</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <!-- <input onclick="doCapture();" class="radio-inline active" type="radio" id="html" name="fav_language" value="HTML"> -->
                                <button class="btn btn-lg btn-primary btn-zakaria" type="submit" name="btnCheckout">Proceed to checkout</button>

                                <label class="radio-inline">
                                    <input onclick="doCapture();" name="input-group-radio" value="checkbox-1" type="radio"> Check this box to get a Checkout Receipt from Gmail
                                </label>

                            </div>
                        </div>
                    </section>

                <?php }
                ?>

                </div>
            </section>

        </div>
</form>

<?php
include('cfooter.php'); ?>

<script>
    function doCapture() {
        window.scrollTo(0, 0);

        // Convert the div to image (canvas)
        html2canvas(document.getElementById("capture")).then(function(canvas) {

            // Get the image data as JPEG and 0.9 quality (0.0 - 1.0)
            console.log(canvas.toDataURL("image/jpeg", 0.9));

            var ajax = new XMLHttpRequest();


            ajax.open("POST", "save-capture.php", true);


            ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


            ajax.send("imagesave=" + canvas.toDataURL("image/jpeg", 0.9));

            ajax.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    alert("You will receive the mail after the checkout process!");

                }

            };

        });
    }
</script>