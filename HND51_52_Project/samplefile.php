<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<form action="samplefile.php" method="POST">
	<table id="tableformat" align="center">
		<tr>
			<th colspan="2">Student Register Form</th>
			
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Student Name</td>
			<td>
				<input type="text" name="txtstudetname" required placeholder="Enter Student Name">
			</td>
		</tr>
		
		<tr>
			<td>Phone Number</td>
			<td>
				<input type="text" name="txtphonenumber" required placeholder="Enter Phone Number">
			</td>
		</tr>
		<tr>
			<td>Address</td>
			<td>
				
				<textarea name="txtaddress" cols="30">
					
				</textarea>
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