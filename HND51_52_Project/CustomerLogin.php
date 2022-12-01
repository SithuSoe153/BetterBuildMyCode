<?php 
	session_start();
	include('connect.php');
	if(isset($_POST['btnlogin']))
	{
		$email=$_POST['txtemail'];
		$password=$_POST['txtpassword'];

		$select="SELECT * FROM Customer where customeremail='$email' and password='$password'";
		$query=mysqli_query($connection,$select);
		$count=mysqli_num_rows($query);
		if($count>0)
		{
			$data=mysqli_fetch_array($query);
			$customerid=$data['customerid'];
			$customername=$data['customername'];
			$_SESSION['cid']=$customerid;
			$_SESSION['cusname']=$customername;
			echo "<script>alert('Customer Login Successful')</script>";	
			echo "<script>window.location='Index.php'</script>";
		}
		else
		{
			echo "<script>alert('Invalid Customer Login')</script>";
			echo "<script>window.location='customerlogin.php'</script>";	
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
	<form action="CustomerLogin.php" method="POST">
		<table  id="tableformat" align="center">
			<tr>
				<td colspan="2" align="center"><h2>Customer Login</h2></td>
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