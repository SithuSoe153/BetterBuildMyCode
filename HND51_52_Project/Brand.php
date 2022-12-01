<?php 
	include('connect.php');
	if(isset($_POST['btnsave']))
{
		$brand=$_POST['txtbrand'];	

	$select="SELECT * FROM Brand where brandname='$brand'";
	$query1=mysqli_query($connection,$select);
	$count=mysqli_num_rows($query1);
	if($count>0)
	{
	echo "<script>alert('Duplicate Brand')</script>";	
	}
	else
	{
		$insert="INSERT INTO Brand(brandname) values('$brand')";
		$query=mysqli_query($connection,$insert);
		if($query)
		{
			echo "<script>alert('Brand Record Successful')</script>";
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
	<form action="Brand.php" method="POST">
		<table id="tableformat" align="center">
		<tr>
			<th colspan="2"><h2>Brand Entry</h2></th>
			
		</tr>
			<tr>
				<td>Brand Name</td>
				<td>
					<input type="text" name="txtbrand" required placeholder="Enter Brand Name">
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" name="btnsave" value="Save">
				</td>
			</tr>
		</table>
	</form>
</body>
</html>