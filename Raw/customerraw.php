<?php
include('connect.php');

if (isset($_POST['btnregister'])) {
    $customername = $_POST['customername'];
    $customeremail = $_POST['customeremail'];
    $customerpassword = $_POST['customerpassword'];
    $customerphonenumber = $_POST['customerphonenumber'];
    $customeraddress = $_POST['customeraddress'];


    //////////////////////////////////Image/////////////////////////////////

    $Image = $_FILES['customerprofile']['name'];
    $Folder = "images/";
    $Folder2 = "../High1/images/";
    $filename = $Folder . '_' . $Image;
    $filename2 = $Folder2 . '_' . $Image;
    $image = copy($_FILES['customerprofile']['tmp_name'], $filename);
    $image2 = copy($_FILES['customerprofile']['tmp_name'], $filename2);
    if (!$image) {
        echo "<p>Cannot Upload  Customer Profile</p>";
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

?>


<!DOCTYPE html>
<html>

<head>
    <title>Customer Register Form</title>
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <form action="customerraw.php" method="POST" enctype="multipart/form-data">

        <table id="tableformat" align="center">
            <tr>
                <th colspan="2">
                    <h2>Customer Register Form</h2>
                </th>

            </tr>

            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Customer Name</td>
                <td width="200px">
                    <input type="text" name="customername" required placeholder="Enter Staff Name">
                </td>
            </tr>
            <tr>
                <td>Customer Email</td>
                <td>
                    <input type="text" name="customeremail" required placeholder="Enter Email Address">
                </td>
            </tr>
            <tr>
                <td>Customer Number</td>
                <td>
                    <input type="text" name="customerphonenumber" required placeholder="Enter Phone Number">
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input type="password" name="customerpassword" required placeholder="Enter Password">
                </td>
            </tr>

            <tr>
                <td>Address</td>
                <td>
                    <textarea name="customeraddress" cols="30"></textarea>
                </td>
            </tr>

            <tr>
                <td>Customer Profile</td>
                <td>
                    <input type="file" name="customerprofile">
                </td>
            </tr>

            <tr>
                <td align="right">
                    <input type="submit" name="btnregister" value="Register">

                </td>
                <td>
                    <input type="reset" name="btncancel" value="Cancel">
                </td>
            </tr>

        </table>
    </form>
</body>

</html>s