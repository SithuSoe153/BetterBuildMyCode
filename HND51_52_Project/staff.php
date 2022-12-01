<?php 
include('connect.php');

if(isset($_POST['btnregister']))
{
	$studentname=$_POST['txtstudentname'];
	$email=$_POST['txtemail'];
	$password=$_POST['txtpassword'];
	$phone=$_POST['txtphonenumber'];
	$address=$_POST['txtaddress'];

//////////////////////////////////Image/////////////////////////////////


	$Image=$_FILES['txtprofile']['name'];
	$Folder="images/";
	$filename=$Folder . '_' . $Image; 
	$image=copy($_FILES['txtprofile']['tmp_name'],$filename);
	if(!$image)
	{
		echo "<p>Cannot Upload  Staff Profile</p>";
		exit();
	}

/////////////////////////////////////////////////////////////////////////


	$select="SELECT * FROM staff where staffemail='$email'";
	$query1=mysqli_query($connection,$select);
	$count=mysqli_num_rows($query1);
	if($count>0)
	{
	echo "<script>alert('Duplicate Staff')</script>";	
	}
	else
	{

	$insert="INSERT INTO staff(staffname,staffemail,password,phonenumber,address,staffprofile) values('$studentname','$email','$password','$phone','$address','$filename')";
	$query=mysqli_query($connection,$insert);
	if($query)
	{
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
	<form action="staff.php" method="POST" enctype="multipart/form-data">

	<table id="tableformat" align="center">
		<tr>
			<th colspan="2"><h2>Staff Register Form</h2></th>
			
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Staff Name</td>
			<td width="200px">
				<input type="text" name="txtstudentname" required placeholder="Enter Staff Name">
			</td>
		</tr>
		<tr>
			<td>Staff Email</td>
			<td>
				<input type="text" name="txtemail" required placeholder="Enter Email Address">
			</td>
		</tr>
		<tr>
			<td>Phone Number</td>
			<td>
				<input type="text" name="txtphonenumber" required placeholder="Enter Phone Number">
			</td>
		</tr>
		<tr>
			<td>Password</td>
			<td>
				<input type="password" name="txtpassword" required placeholder="Enter Password">
			</td>
		</tr>
		<!-- <tr>
			<td>Gender</td>
			<td>
				<SELECT name="gender">
					<option value="M" checked>Male</option>
					<option value="F">Female</option>
				</SELECT>
			</td>
		</tr>
		<tr>
			<td>Phone Number</td>
			<td>
				<input type="date" name="txtphonenumber" required placeholder="Enter Phone Number">
			</td>
		</tr>
		 -->
						<textarea name="txtaddress" cols="30">
					
				</textarea>
		<tr>
			<td>Address</td>
			<td>
				
				<textarea name="txtaddress" cols="30">
					
				</textarea>
			</td>
		</tr>
		<tr>
			<td>Staff Profile</td>
			<td>
				<input type="file" name="txtprofile" required>
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