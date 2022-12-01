<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('connect.php');
include('cheader.php');
include('shoppingcart_functions.php');

if (!isset($_SESSION['cid'])) {
    echo "<script>alert('Pls Login Again')</script>";
    echo "<script>window.location='../../../High1/accountchoose.php'</script>";
}


$customerid = $_SESSION['cid'];
$customername = $_SESSION['cusname'];
$customermail = $_SESSION['cusmail'];


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

<form action="cart-page.php" method="GET">

    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="images/bg-about.jpg">
            <div class="breadcrumbs-custom-body parallax-content context-dark">
                <div class="container">
                    <h2 class="breadcrumbs-custom-title">Cart Page</h2>
                </div>
            </div>
        </div>
        <div class="breadcrumbs-custom-footer">
            <div class="container">
                <ul class="breadcrumbs-custom-path">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="grid-shop.php">Shop</a></li>
                    <li class="active">Cart Page</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Shopping Cart-->
    <section class="section section-xl bg-default">
        <div class="container">

            <?php

            if (!isset($_SESSION['shopcart']) || !isset($_SESSION['shopcart'][0])) {
                echo "<p>No Shopping Record Found.</p>";
            } else {

            ?>



                <!-- shopping-cart-->
                <div class="table-custom-responsive">
                    <table class="table-custom table-cart">
                        <thead>
                            <tr>
                                <th>Product name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
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
                                    <td><a class="table-cart-figure" href="single-product.php?productid=<?php echo $productid ?>"><img src="<?php echo $image1 ?>" alt="" width="146" height="132" /></a><a class="table-cart-link" href="single-product.html"><?php echo $productname ?></a></td>
                                    <td><?php echo $price ?> MMK</td>
                                    <td>
                                        <?php echo $quantity ?>
                                        <!-- <div class="table-cart-stepper">
                                <input class="form-input" type="number" data-zeros="true" value="1" min="1" max="1000">
                            </div> -->
                                    </td>
                                    <td><?php echo $Subtotal ?> MMK</td>
                                    <td><a href='cart-page.php?action=remove&productid=<?php echo $productid ?>'>Remove</a></td>
                                </tr>

                            <?php
                            }
                            ?>



                        </tbody>
                    </table>
                </div>
                <div class="group-xl group-justify justify-content-center justify-content-md-between">
                    <div>
                        <form class="rd-form rd-mailform rd-form-inline rd-form-coupon">
                            <div class="form-wrap">
                                <!-- <input class="form-input form-input-inverse" id="coupon-code" type="text" name="text"> -->
                                <!-- <label class="form-label" for="coupon-code">Coupon code</label> -->
                            </div>
                            <div class="form-button">
                                <!-- <button class="btn btn-lg btn-secondary btn-zakaria" type="submit">Apply</button> -->
                            </div>
                        </form>
                    </div>
                    <div>
                        <div class="group-xl group-middle">
                            <div>
                                <div class="group-md group-middle">
                                    <div class="heading-5 fw-medium text-gray-500">Total Quantity</div>
                                    <div class="heading-3 fw-normal"><?php echo CalculateTotalQuantity() ?> Pcs</div>
                                    <!-- <p> | </p> -->
                                    <div class="heading-5 fw-medium text-gray-500">Total Price</div>
                                    <div class="heading-3 fw-normal"><?php echo CalculateTotalAmount() ?> MMK</div>
                                </div>
                            </div><a class="btn btn-lg btn-primary btn-zakaria" href="checkout.php">Proceed to checkout</a>
                        </div>
                    </div>
                </div>

            <?php }
            ?>


        </div>
    </section>
</form>
<?php include('cfooter.php');
