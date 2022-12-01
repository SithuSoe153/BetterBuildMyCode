<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include('connect.php');

if (isset($_POST['btnregister'])) {
    $staffname = $_POST['staffname'];
    $staffemail = $_POST['staffemail'];
    $staffrole = $_POST['staffrole'];
    $staffskills = $_POST['staffskills'];
    $password = $_POST['password'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['address'];


    //////////////////////////////////Image/////////////////////////////////

    $Image = $_FILES['staffprofile']['name'];
    $Folder = "images/";
    $filename = $Folder . '_' . $Image;
    $image = copy($_FILES['staffprofile']['tmp_name'], $filename);
    if (!$image) {
        echo "<p>Cannot Upload  Staff Profile</p>";
        exit();
    }

    /////////////////////////////////////////////////////////////////////////


    $select = "SELECT * FROM staff where staffemail='$staffemail'";
    $query1 = mysqli_query($connection, $select);
    $count = mysqli_num_rows($query1);
    if ($count > 0) {
        echo "<script>alert('Duplicate Staff')</script>";
    } else {

        $insert = "INSERT INTO staff
        (staffname,staffemail,staffrole,staffskill,password,phonenumber,address,staffprofile) 
        VALUES
        ('$staffname','$staffemail','$staffrole','$staffskills','$password','$phonenumber','$address','$filename')";
        $query = mysqli_query($connection, $insert);
        if ($query) {
            echo "<script>alert('Staff Register Successfully')</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link href="style.css" rel="stylesheet">
</head>


<body>
    <form action="staffraw.php" method="POST" enctype="multipart/form-data">

        <table id="tableformat" align="center">
            <tr>
                <th colspan="2">
                    <h2>Staff Register Form</h2>
                </th>

            </tr>

            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Staff Name</td>
                <td width="200px">
                    <input type="text" name="staffname" required placeholder="Enter Staff Name">
                </td>
            </tr>
            <tr>
                <td>Staff Role</td>
                <td>
                    <input type="text" name="staffrole" required placeholder="Enter StaffRole">
                </td>
            </tr>
            <tr>
                <td>Staff Skills</td>
                <td>
                    <input type="text" name="staffskills" required placeholder="Can Enter Multiple Skills">
                </td>
            </tr>
            <tr>
                <td>Staff Email</td>
                <td>
                    <input type="text" name="staffemail" required placeholder="Enter Email Address">
                </td>
            </tr>
            <tr>
                <td>Phone Number</td>
                <td>
                    <input type="text" name="phonenumber" required placeholder="Enter Phone Number">
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input type="password" name="password" required placeholder="Enter Password">
                </td>
            </tr>

            <tr>
                <td>Address</td>
                <td>
                    <textarea name="address" cols="30"></textarea>
                </td>
            </tr>

            <tr>
                <td>Staff Profile</td>
                <td>
                    <input type="file" name="staffprofile">
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

</html>