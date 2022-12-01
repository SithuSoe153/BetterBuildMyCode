<?php
include('connect.php');
if (isset($_REQUEST['sid'])) {

    $sid = $_REQUEST['sid'];
    $delete = "DELETE from staff where staffid='$sid'";
    $query = mysqli_query($connection, $delete);
    if ($query) {

        echo "<script>alert('Staff Delete Successfully')</script>";
        echo "<script>window.location='stafflistraw.php'</script>";
    }
}
