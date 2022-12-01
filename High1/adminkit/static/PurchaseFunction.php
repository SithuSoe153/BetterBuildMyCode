<?php

function Add($rawid, $purchaseprice, $purchasequantity)
{
	$connect = mysqli_connect("localhost", "root", "", "posdb");
	$query = "SELECT * FROM raw WHERE rawid='$rawid'";
	$ret = mysqli_query($connect, $query);
	$count = mysqli_num_rows($ret);
	if ($count < 1) {
		echo "<p>NO Record Found.</p>";
		// exit();
	}
	$arr = mysqli_fetch_array($ret);
	$rawtype = $arr['rawtype'];
	$image1 = $arr['rawprofile'];

	if (isset($_SESSION['purchasefunction'])) {
		$index = IndexOf($rawid);
		if ($index == -1) {
			$size = count($_SESSION['purchasefunction']);

			$_SESSION['purchasefunction'][$size]['rawid'] = $rawid;
			$_SESSION['purchasefunction'][$size]['rawtype'] = $rawtype;
			$_SESSION['purchasefunction'][$size]['purchaseprice'] = $purchaseprice;
			$_SESSION['purchasefunction'][$size]['purchasequantity'] = $purchasequantity;
			$_SESSION['purchasefunction'][$size]['image1'] = $image1;
		} else {

			$_SESSION['purchasefunction'][$index]['purchasequantity'] += $purchasequantity;
		}
	} else {
		$_SESSION['purchasefunction'] = array();
		$_SESSION['purchasefunction'][0]['rawid'] = $rawid;
		$_SESSION['purchasefunction'][0]['rawtype'] = $rawtype;
		$_SESSION['purchasefunction'][0]['purchaseprice'] = $purchaseprice;
		$_SESSION['purchasefunction'][0]['purchasequantity'] = $purchasequantity;
		$_SESSION['purchasefunction'][0]['image1'] = $image1;
	}
	echo "<script>window.location='purchase.php'</Script>";
}


function IndexOf($rawid)
{
	if (!isset($_SESSION['purchasefunction'])) {
		return -1;
	}
	$size = count($_SESSION['purchasefunction']);
	if ($size == 0) {
		return -1;
	}
	for ($i = 0; $i < $size; $i++) {
		if ($rawid == $_SESSION['purchasefunction'][$i]['rawid']) {
			return $i;
		}
	}
	return -1;
}


function Remove($rawid)
{
	$index = IndexOf($rawid);
	if ($index == 0) {
		array_splice($_SESSION['purchasefunction'], $index, $index);
		unset($_SESSION['purchasefunction'][$index]);
	}

	if ($index != -1) {


		echo "<script>window.alert('Removed')</script>";

		array_splice($_SESSION['purchasefunction'], $index, $index);

		// echo "<script>window.location='purchase.php'</script>";

		// Print modified array to check how much array left
		// var_dump($_SESSION['purchasefunction']);
	}
}

function CalculateTotalAmount()
{
	$totalamount = 0;
	$size = count($_SESSION['purchasefunction']);
	for ($i = 0; $i < $size; $i++) {
		$purchaseprice = $_SESSION['purchasefunction'][$i]['purchaseprice'];
		$purchasequantity = $_SESSION['purchasefunction'][$i]['purchasequantity'];
		$totalamount = $totalamount + ($purchaseprice * $purchasequantity);
	}
	return $totalamount;
}

function CalculateTotalQuantity()
{
	$Qty = 0;

	$size = count($_SESSION['purchasefunction']);

	for ($i = 0; $i < $size; $i++) {
		$quantity = $_SESSION['purchasefunction'][$i]['purchasequantity'];
		$Qty = $Qty + ($quantity);
	}
	return $Qty;
}
