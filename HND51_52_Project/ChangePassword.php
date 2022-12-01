<?php 	
		session_start();
		include('connect.php');
		if(isset($_SESSION['cid']))
		{
				$cusid=$_SESSION['cid'];
				$select="SELECT * FROM Customer where customerid='$cusid'";
				$query=mysqli_query($connection,$select);
				$count=mysqli_num_rows($query);
				if($count>0)
				{
					$data=mysqli_fetch_array($query);
					$password=$data['password'];
				}
		}

		if(isset($_POST['btnchange']))
		{
			$npassword=$_POST['txtnewpassword'];
			$customerid=$_POST['txtcustomerid'];
			$update="UPDATE customer set password='$npassword'
			where customerid='$customerid'";
			$query=mysqli_query($connection,$update);

		if($query)
		{
			
			echo "<script>alert('Password Update Successful')</script>";	
			echo "<script>window.location='CustomerLogin.php'</script>";
		}



		}

?>

<!DOCTYPE html>
<html>
<head>
	<title>	</title>
</head>
<body>
		<form action="ChangePassword.php" method="POST">
		
		<table  id="tableformat" align="center">
			<tr>
				<input type="hidden" name="txtcustomerid" value="<?php echo $cusid ?>">
				<td colspan="2" align="center"><h2>Change Password</h2></td>
			</tr>
			
			<tr>
				<td>Old Password</td>
				<td>
					<input type="Password" name="txtoldpassword" value="<?php echo $password ?>" readonly>
				</td>
			</tr>
			<tr>
				<td>New Password</td>
				<td>
					<input type="Password" name="txtnewpassword" required placeholder="Enter Password">
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