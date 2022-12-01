<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../../connect.php');
if (isset($_REQUEST['sid'])) {
    $sid = $_REQUEST['sid'];
    $select = "SELECT * FROM staff where staffid='$sid'";
    $query = mysqli_query($connection, $select);
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        $data = mysqli_fetch_array($query);
        $staffid = $data['staffid'];
        $staffname = $data['staffname'];
        $staffemail = $data['staffemail'];
        $password = $data['password'];
        $phonenumber = $data['phonenumber'];
        $address = $data['address'];
        $staffprofile = $data['staffprofile'];
    }
}

?>


<img src="<?php echo $staffprofile ?>" width="100px" height="100px">