<?php
include('connect.php');
if (isset($_REQUEST['pid'])) {
    $pid = $_REQUEST['pid'];
    $Select = "Update purchase set purchasestatus='confirm' where purchaseid='$pid'";
    $query = mysqli_query($connection, $Select);
    if ($query) {
        echo "<script>
		alert('Purchase Confirm')
		window.location='purchasereport.php'</script>";
    }
}
