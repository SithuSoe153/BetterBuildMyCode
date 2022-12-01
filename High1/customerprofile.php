<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();
include('connect.php');
if (isset($_SESSION['cid'])) {
    $cid = $_SESSION['cid'];
    $select = "SELECT * FROM customer where customerid='$cid'";
    $query = mysqli_query($connection, $select);
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        $data = mysqli_fetch_array($query);
        $customerid = $data['customerid'];
        $customername = $data['customername'];
        $customeremail = $data['customeremail'];
        $customerpassword = $data['customerpassword'];
        $customerphonenumber = $data['customerphonenumber'];
        $customeraddress = $data['customeraddress'];
        $customerprofile = $data['customerprofile'];
    }
}


if (isset($_POST['btnupdate'])) {
    $txtcustomerid = $_POST['txtcustomerid'];
    $txtcustomername = $_POST['txtcustomername'];
    $txtcustomeremail = $_POST['txtcustomeremail'];
    $txtcustomerpassword = $_POST['txtcustomerpassword'];
    $txtcustomerphonenumber = $_POST['txtcustomerphonenumber'];
    $txtcustomeraddress = $_POST['txtcustomeraddress'];


    //////////////////////////////////Image/////////////////////////////////


    $customerprofile = $_FILES['txtcustomerprofile']['name'];
    $Folder = "images/";
    $filename = $Folder . '_' . $customerprofile;
    $image = copy($_FILES['txtcustomerprofile']['tmp_name'], $filename);
    if (!$image) {
        echo "<p>Cannot Upload  Customer Profile</p>";
        exit();
    }

    /////////////////////////////////////////////////////////////////////////

    $update = "UPDATE customer 
	set customername='$txtcustomername',customeremail='$txtcustomeremail',customerpassword='$txtcustomerpassword',customerphonenumber='$txtcustomerphonenumber',customeraddress='$txtcustomeraddress',customerprofile='$filename' 
	where customerid='$txtcustomerid'";
    $query = mysqli_query($connection, $update);
    if ($query) {
        echo "<script>alert('Customer Update Successfully')</script>";
        echo "<script>window.location='index.php'</script>";
    }
}

if (isset($_POST['btncancel'])) {
    echo "<script>window.location='index.php'</script>";
}

if (isset($_POST['btnlogout'])) {
    session_destroy();
    echo "<script>alert('LogOut Succesful')</script>";
    echo "<script>window.location='index.php'</script>";
}

?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <form action="customerprofile.php" method="POST" enctype="multipart/form-data">

        <table id="tableformat" align="center">
            <tr>
                <th colspan="2">
                    <h2>Customer Update Form</h2>
                </th>

            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Customer Name</td>
                <td width="200px">
                    <input type="hidden" name="txtcustomerid" value="<?php echo $customerid ?>">
                    <input type="text" name="txtcustomername" required value="<?php echo $customername ?>">
                </td>
            </tr>
            <tr>
                <td>Customer Email</td>
                <td>
                    <input type="text" name="txtcustomeremail" required value="<?php echo $customeremail ?>">
                </td>
            </tr>
            <tr>
                <td>Phone Number</td>
                <td>
                    <input type="text" name="txtcustomerphonenumber" required value="<?php echo $customerphonenumber ?>">
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input type="password" name="txtcustomerpassword" required value="<?php echo $customerpassword ?>">
                </td>
            </tr>

            <tr>
                <td>Address</td>
                <td>

                    <textarea name="txtcustomeraddress" cols="30">
					<?php echo $customeraddress ?>
				</textarea>
                </td>
            </tr>
            <tr>
                <td>Customer Profile</td>
                <td>
                    <input type="file" name="txtcustomerprofile">
                    <img src="<?php echo $customerprofile ?>" width="100px" height="100px">
                </td>
            </tr>
            <tr>
                <td align="right">
                    <input type="submit" name="btnupdate" value="Update">

                </td>
                <td>
                    <input type="submit" name="btncancel" value="Cancel">
                </td>
                <td>
                    <input type="submit" name="btnlogout" value="Logout">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>