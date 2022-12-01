<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('../Raw/connect.php');
include('../Raw/autoidfunction.php');

include('../Raw/shoppingcart_functions.php');

if (isset($_POST['btnCheckout'])) {
	$orderid = $_POST['txtOrderID'];
	$orderdate = $_POST['txtOrderDate'];
	$formatdate = date('d-m-Y', strtotime($orderdate));

	$customerid = $_SESSION['cid'];
	$customermail = $_SESSION['cusmail'];
	$customername = $_SESSION['cusname'];

	$totalamount = CalculateTotalAmount();
	$totalquantity = CalculateTotalQuantity();
	$status = "Pending";
	$card = $_POST['txtcard'];
	$query = "INSERT INTO orders
	(orderid, orderdate, customerid, totalamount, totalquantity,
	orderstatus,cardtype)
	VALUES
	('$orderid','$orderdate','$customerid','$totalamount','$totalquantity',
	'$status','$card')";
	$ret = mysqli_query($connection, $query);

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
		echo "<script>alert('Checkout Process Complete')</script>";
		// include('phpmailer.php');
		echo "<script>window.location='phpmailer.php'</script>";
		// echo "<script>window.location='phpmailer.php?oid=$orderid'</script>";
	}
}


?>
<!DOCTYPE html>
<html>

<head>

	<title>Check Out</title>

	<script src="html2canvas.js"></script>

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
					}
				};

			});
		}
	</script>


</head>

<body id="capture">

	<form action="checkout.php" method="POST">

		<div>

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
						<input name="txtTotalAmount" type="text" value="" readonly />MMKk
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
						<button onclick="doCapture();">Capture</button>

					</td>
				</tr>
			</table>
		</div>
		<fieldset>
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

					echo "<td><a href='shoppingcart.php?action=remove&productid=$productid' style='color:red'>Remove</a></td>";

					echo "</tr>";
				}
				?>


				<!-- '
				<table>
					<tr>
						<td><img src='$image1' width='100px' height='100px' /></td>
						<td>$productid</td>
						<td>$productname</td>
						<td>$price MMK</td>
						<td>$quantity Pcs</td>
						<td>$Subtotal MMK</td>
				</table>
				'; -->

			</table>

		</fieldset>
	</form>
</body>

</html>