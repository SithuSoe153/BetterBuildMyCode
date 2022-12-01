<?php 
	include('connect.php');
	if(isset($_POST['btnsave']))
{
		$category=$_POST['txtcategory'];	

	$select="SELECT * FROM Category where categoryname='$category'";
	$query1=mysqli_query($connection,$select);
	$count=mysqli_num_rows($query1);
	if($count>0)
	{
	echo "<script>alert('Duplicate Category')</script>";	
	}
	else
	{
		$insert="INSERT INTO Category(categoryname) values('$category')";
		$query=mysqli_query($connection,$insert);
		if($query)
		{
			echo "<script>alert('Category Record Successful')</script>";
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
	<form action="Category.php" method="POST">
		<table id="tableformat" align="center">
		<tr>
			<th colspan="2"><h2>Category Entry</h2></th>
			
		</tr>
			<tr>
				<td>Category Name</td>
				<td>
					<input type="text" name="txtcategory" required placeholder="Enter Category Name">
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