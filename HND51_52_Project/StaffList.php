<?php 
include('connect.php');
$select="SELECT * FROM staff";
$query=mysqli_query($connection,$select);
$count=mysqli_num_rows($query);
if($count>0)
{
	echo "<table border='1'>";
	echo "<tr>";
	echo "<th>Staff ID</th>";
	echo "<th>Staff Name</th>";
	echo "<th>Staff Email</th>";
	echo "<th>Staff Password</th>";
	echo "<th>Staff Phone Number</th>";
	echo "<th>Staff Address</th>";
	echo "<th>Staff Profile</th>";
	echo "<th>Action</th>";
	echo "</tr>";


		echo "<table border='1'>
		<tr>
		<th>Staff ID</th>
		<th>Staff Name</th>
		<th>Staff Email</th>
		<th>Staff Password</th>
		<th>Staff Phone Number</th>
		<th>Staff Address</th>
		<th>Staff Profile</th>
		<th>Action</th>
		</tr>";
	for ($i=0; $i <$count ; $i++) 
	{ 
		$data=mysqli_fetch_array($query);
		$staffid=$data['staffid'];
		$staffname=$data['staffname'];
		$staffemail=$data['staffemail'];
		$password=$data['password'];
		$phonenumber=$data['phonenumber'];
		$address=$data['address'];
		$staffprofile=$data['staffprofile'];
		echo "<tr>";
		echo "<td>$staffid</td>";
		echo "<td>$staffname</td>";
		echo "<td>$staffemail</td>";
		echo "<td>$password</td>";
		echo "<td>$phonenumber</td>";
		echo "<td>$address</td>";
		echo "<td>$staffprofile</td>";
		echo "<td>
		<a href='UpdateStaff.php?sid=$staffid'>
		Update
		</a>
		
		|
		<a href='DeleteStaff.php?sid=$staffid'>
		Delete
		</a>
		</td>";
		echo "</tr>";
	}
	echo "</table>";
}

 ?>