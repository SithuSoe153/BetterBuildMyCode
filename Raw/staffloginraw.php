<?php

session_start();
include('connect.php');
if (isset($_POST['btnlogin'])) {
	$email = $_POST['txtemail'];
	$password = $_POST['txtpassword'];

	$select = "SELECT * FROM staff where staffemail='$email' and password='$password'";
	$query = mysqli_query($connection, $select);
	$count = mysqli_num_rows($query);
	if ($count > 0) {

		$data = mysqli_fetch_array($query);
		$staffid = $data['staffid'];
		$staffname = $data['staffname'];
		$staffmail = $data['staffemail'];

		$_SESSION['sid'] = $staffid;
		$_SESSION['sname'] = $staffname;
		$_SESSION['smail'] = $staffmail;

		echo "<script>alert('Staff Login Successful')</script>";
		echo "<script>window.location='../High1/adminkit/static/index.php'</script>";
	} else {
		echo "<script>alert('Invalid Staff Login')</script>";
		// echo "<script>window.location='staffloginraw.php'</script>";
		echo "<script>window.location='staffloginraw.php'</script>";
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
	<form action="staffloginraw.php" method="POST">
		<table id="tableformat" align="center">
			<tr>
				<td colspan="2" align="center">
					<h2>Staff Login</h2>
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