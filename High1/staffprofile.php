<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('connect.php');
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

if (isset($_POST['btncancel'])) {
    echo "<script>window.location='indexstaff.php'</script>";
}

if (isset($_POST['btnlogout'])) {
    session_start();
    session_destroy();
    echo "<script>alert('LogOut Succesful')</script>";
    echo "<script>window.location='index.php'</script>";
}

if (isset($_POST['btnupdate'])) {
    $txtstaffid = $_POST['txtstaffid'];
    $txtstaffname = $_POST['txtstaffname'];
    $txtstaffemail = $_POST['txtstaffemail'];
    $txtpassword = $_POST['txtpassword'];
    $txtphonenumber = $_POST['txtphonenumber'];
    $txtaddress = $_POST['txtaddress'];


    //////////////////////////////////Image/////////////////////////////////


    $Image = $_FILES['txtprofile']['name'];
    $Folder = "images/";
    $filename = $Folder . '_' . $Image;
    $image = copy($_FILES['txtprofile']['tmp_name'], $filename);
    if (!$image) {
        echo "<p>Cannot Upload  Staff Profile</p>";
        exit();
    }

    /////////////////////////////////////////////////////////////////////////

    $update = "UPDATE staff set staffname='$txtstaffname',staffemail='$txtstaffemail',password='$txtpassword',phonenumber='$txtphonenumber',address='$txtaddress',staffprofile='$filename' where staffid='$txtstaffid'";
    $query = mysqli_query($connection, $update);
    if ($query) {
        echo "<script>alert('Staff Update Successfully')</script>";
        echo "<script>window.location='staffprofile.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <form action="staffprofile.php" method="POST" enctype="multipart/form-data">

        <table id="tableformat" align="center">
            <tr>
                <th colspan="2">
                    <h2>Staff Update Form</h2>
                </th>

            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Staff Name</td>
                <td width="200px">
                    <input type="hidden" name="txtstaffid" value="<?php echo $staffid ?>">
                    <input type="text" name="txtstaffname" required value="<?php echo $staffname ?>">
                </td>
            </tr>
            <tr>
                <td>Staff Email</td>
                <td>
                    <input type="text" name="txtstaffemail" required value="<?php echo $staffemail ?>">
                </td>
            </tr>
            <tr>
                <td>Phone Number</td>
                <td>
                    <input type="text" name="txtphonenumber" required value="<?php echo $phonenumber ?>">
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input type="password" name="txtpassword" required value="<?php echo $password ?>">
                </td>
            </tr>

            <tr>
                <td>Address</td>
                <td>

                    <textarea name="txtaddress" cols="30">
					<?php echo $address ?>
				</textarea>
                </td>
            </tr>
            <tr>
                <td>Staff Profile</td>
                <td>
                    <input type="file" name="txtprofile">
                    <img src="<?php echo $staffprofile ?>" width="100px" height="100px">
                </td>
            </tr>
            <tr>
                <td align="right">
                    <input type="submit" name="btnupdate" value="Update">

                </td>
                <td>
                    <input type="reset" name=" btnreset" value="Reset">
                </td>
                <td>

                    <button name="btncancel" type="cancel">Cancel</button>
                    <button name="btnlogout" type="submit">Logout</button>
                </td>

            </tr>
        </table>
    </form>
</body>

</html>