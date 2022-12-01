<?php

// session_start();

include('connect.php');
if (isset($_POST['btnClogin'])) {
    $email = $_POST['txtemail'];
    $password = $_POST['txtpassword'];

    $select = "SELECT * FROM customer where customeremail='$email' and customerpassword='$password'";
    $query = mysqli_query($connection, $select);
    $count = mysqli_num_rows($query);
    if ($count > 0) {

        $data = mysqli_fetch_array($query);
        $customerid = $data['customerid'];
        $customername = $data['customername'];
        $customermail = $data['customeremail'];

        $_SESSION['cid'] = $customerid;
        $_SESSION['cusname'] = $customername;
        $_SESSION['cusmail'] = $customermail;

        echo "<script>alert('Customer Login Successful')</script>";
        echo "<script>window.location='index.php'</script>";
    } else {
        echo "<script>alert('Invalid Customer Login')</script>";
        echo "<script>window.location='accountchoose.php'</script>";
    }
}
