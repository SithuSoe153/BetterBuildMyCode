<?php
session_start();
include('connect.php');
if (isset($_SESSION['cid'])) {
    $cusid = $_SESSION['cid'];

    $select = "SELECT * FROM customer where customerid='$cusid'";
    $query = mysqli_query($connection, $select);
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        $data = mysqli_fetch_array($query);
        $password = $data['customerpassword'];
    }
}
if (isset($_POST['btnchange'])) {
    $npassword = $_POST['txtnewpassword'];
    $customerid = $_POST['txtcustomerid'];
    $update = "UPDATE customer set customerpassword='$npassword'
    where customerid = '$customerid'";

    $query = mysqli_query($connection, $update);

    if ($query) {
        echo "<script>alert('Customer Password Change Successful')</script>";
        echo "<script>window.location='CustomerLogin.php'</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Change Password</title>
</head>

<body>

    <form action="customerchangepassword.php" method="POST">
        <table id="tableformat" align="center">
            <tr>
                <input type="hidden" name="txtcustomerid" value="<?php echo $cusid ?>">

                <td colspan="2" align="center">
                    <h2>Customer Change Password</h2>
                </td>
            </tr>
            <tr>
                <td>Old Password</td>
                <td>
                    <input type="text" name="txtoldpassword" value="<?php echo $password ?>" readonly>
                </td>
            </tr>

            <tr>
                <td>New Password</td>
                <td>
                    <input type="Password" name="txtnewpassword" required placeholder="Enter new password">
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <input type="submit" name="btnchange" value="Change">
                </td>
            </tr>

        </table>
    </form>

</body>

</html>