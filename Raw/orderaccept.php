<?php
include('connect.php');
if (isset($_REQUEST['oid'])) {
	$oid = $_REQUEST['oid'];
	$Select = "Update orders set orderstatus='confirm' where orderid='$oid'";
	$query = mysqli_query($connection, $Select);
	if ($query) {
		echo "<script>
		alert('Order Confirm')
		window.location='orderreportraw.php'</script>";
	}
}
