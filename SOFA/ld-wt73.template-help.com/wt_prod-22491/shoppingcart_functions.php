<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function Add($productid, $BuyQuantity)
{
	$connect = mysqli_connect("localhost", "root", "", "posdb");
	$query = "SELECT * FROM product WHERE productid='$productid'";
	$ret = mysqli_query($connect, $query);
	$count = mysqli_num_rows($ret);
	if ($count < 1) {
		echo "<p>No Record Found.</p>";
		exit();
	}
	$arr = mysqli_fetch_array($ret);
	$productname = $arr['productname'];
	$price = $arr['unitprice'];
	$image1 = $arr['productprofile'];

	if (isset($_SESSION['shopcart'])) {
		$index = IndexOf($productid);
		if ($index == -1) {
			$size = count($_SESSION['shopcart']);

			$_SESSION['shopcart'][$size]['productid'] = $productid;
			$_SESSION['shopcart'][$size]['productname'] = $productname;
			$_SESSION['shopcart'][$size]['price'] = $price;
			$_SESSION['shopcart'][$size]['BuyQuantity'] = $BuyQuantity;
			$_SESSION['shopcart'][$size]['image1'] = $image1;
		} else {

			$_SESSION['shopcart'][$index]['BuyQuantity'] += $BuyQuantity;
		}
	} else {
		$_SESSION['shopcart'] = array();
		$_SESSION['shopcart'][0]['productid'] = $productid;
		$_SESSION['shopcart'][0]['productname'] = $productname;
		$_SESSION['shopcart'][0]['price'] = $price;
		$_SESSION['shopcart'][0]['BuyQuantity'] = $BuyQuantity;
		$_SESSION['shopcart'][0]['image1'] = $image1;
	}
	echo "<script>window.location='cart-page.php'</script>";
}





function IndexOf($productid)
{
	if (!isset($_SESSION['shopcart'])) {
		return -1;
	}

	$size = count($_SESSION['shopcart']);
	if ($size == 0) {
		return -1;
	}

	for ($i = 0; $i < $size; $i++) {
		if ($productid == $_SESSION['shopcart'][$i]['productid']) {
			return $i;
		}
	}
	return -1;
}







function Remove($productid)
{
	$index = IndexOf($productid);
	if ($index == 0) {
		array_splice($_SESSION['shopcart'], $index, $index);
		unset($_SESSION['shopcart'][$index]);
	}

	if ($index != -1) {


		echo "<script>window.alert('Removed')</script>";

		array_splice($_SESSION['shopcart'], $index, $index);
	}
}


function CalculateTotalAmount()
{
	$totalamount = 0;
	$size = count($_SESSION['shopcart']);
	for ($i = 0; $i < $size; $i++) {
		$purchaseprice = $_SESSION['shopcart'][$i]['price'];
		$purchasequantity = $_SESSION['shopcart'][$i]['BuyQuantity'];
		$totalamount = $totalamount + ($purchaseprice * $purchasequantity);
	}
	return $totalamount;
}

function CalculateTotalQuantity()
{
	$Qty = 0;

	$size = count($_SESSION['shopcart']);

	for ($i = 0; $i < $size; $i++) {
		$quantity = $_SESSION['shopcart'][$i]['BuyQuantity'];
		$Qty = $Qty + ($quantity);
	}
	return $Qty;
}
