<?php

include('connect.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['btnSignUp'])) {
    $customername = $_POST['txtname'];
    $customeremail = $_POST['txtmail'];
    $customerpassword = $_POST['txtpassword'];
    $customerphonenumber = $_POST['txtnumber'];
    $customeraddress = $_POST['txtaddress'];


    //////////////////////////////////Image/////////////////////////////////

    $Image = $_FILES['filecusimage']['name'];
    $Folder = "images/";
    $filename = $Folder . '_' . $Image;
    $image = copy($_FILES['filecusimage']['tmp_name'], $filename);
    if (!$image) {
        echo "<p>Cannot Upload  Staff Profile</p>";
        exit();
    }

    /////////////////////////////////////////////////////////////////////////


    $select = "SELECT * FROM customer where customeremail='$customeremail'";
    $query1 = mysqli_query($connection, $select);
    $count = mysqli_num_rows($query1);
    if ($count > 0) {
        echo "<script>alert('Duplicate Customer')</script>";
    } else {

        $insert = "INSERT INTO customer
        (customername,customeremail,customerpassword,customerphonenumber,customeraddress,customerprofile) 
        VALUES
        ('$customername','$customeremail','$customerpassword','$customerphonenumber','$customeraddress','$filename')";
        $query = mysqli_query($connection, $insert);
        if ($query) {
            echo "<script>alert('Customer Register Successfully')</script>";
        }
    }
}
