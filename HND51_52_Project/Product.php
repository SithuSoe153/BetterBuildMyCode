<?php 
include('connect.php');
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<form action="Product.php" method="POST">
		<table>
			<tr>
				<td>Brand Name</td>
				<td>
					<?php 
					
					$select="SELECT * FROM Brand";
					$query=mysqli_query($connection,$select);
					$count=mysqli_num_rows($query);

					echo "<select>";
					for ($i=0; $i <$count; $i++) 
					{ 
						$data=mysqli_fetch_array($query);
						$brandname=$data['brandname'];

						echo "<option>$brandname</option>";
					}
					echo "</select>";
					?>
				</td>
			</tr>
				<tr>
				<td>Category Name</td>
				<td>
					<?php 
					
					$select="SELECT * FROM Category";
					$query=mysqli_query($connection,$select);
					$count=mysqli_num_rows($query);
					
					echo "<select>";
					for ($i=0; $i <$count; $i++) 
					{ 
						$data=mysqli_fetch_array($query);
						$categoryname=$data['categoryname'];

						echo "<option>$categoryname</option>";
					}
					echo "</select>";
					?>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>