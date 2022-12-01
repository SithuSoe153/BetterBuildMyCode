<?php

session_start();
include('connect.php');
if (isset($_POST['btnlogin'])) {
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
		echo "<script>window.location='CustomerHome.php'</script>";
	} else {
		echo "<script>alert('Invalid Customer Login')</script>";
		echo "<script>window.location='CustomerLogin.php'</script>";
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Customer Login</title>
	<link href="style.css" rel="stylesheet">
</head>

<body>
	<form action="CustomerLogin.php" method="POST">
		<table id="tableformat" align="center">
			<tr>
				<td colspan="2" align="center">
					<h2>Customer Login</h2>
				</td>
			</tr>
			<tr>
				<td>Email Address</td>
				<td>
					<input type="email" name="txtemail" required placeholder="Enter Email Address">
				</td>
			</tr>
			<tr>
				<td>Password</td>
				<td>
					<input type="Password" name="txtpassword" required placeholder="Enter Password">
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" name="btnlogin" value="Login">
				</td>
			</tr>

		</table>
	</form>
</body>

</html>