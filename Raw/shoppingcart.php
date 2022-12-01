<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('connect.php');
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



<!DOCTYPE html>
<html>

<head>
	<title></title>
	<script src="html2canvas.js"></script>
</head>

<body>
	<fieldset>
		<legend>Product List</legend>
		<?php
		if (!isset($_SESSION['shopcart'])) {
			echo "<p>No Shopping Record Found.</p>";
			exit();
		}
		?>
		<table align="center" border="1" cellpadding="3px" id="capture">
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

				$productid = $_SESSION['shopcart'][$i]['productid'];
				$productname = $_SESSION['shopcart'][$i]['productname'];
				$price = $_SESSION['shopcart'][$i]['price'];
				$quantity = $_SESSION['shopcart'][$i]['BuyQuantity'];
				$image1 = $_SESSION['shopcart'][$i]['image1'];

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

			<tr>
				<td colspan="7" align="right">
					TotalAmount:<b><?php echo CalculateTotalAmount() ?></b>MMK<br />
					TotalQuantity:<b><?php echo CalculateTotalQuantity() ?></b> <br />
					<a href="CustomerHome.php" style="color:red">Product Display</a> |
					<a href="checkout.php" style="color:red; text-decoration:none;">Make Checkout</a>
					<!-- <input type="button" name="capture" onclick="doCapture();"> -->

				</td>
			</tr>

			<button name="capture" onclick="doCapture();">capture and send
			</button>

		</table>
	</fieldset>
</body>

</html>


<script>
	function doCapture() {

		window.location = 'checkout.php';
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