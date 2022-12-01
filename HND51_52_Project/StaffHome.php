<?php
include('connect.php');

if (isset($_POST['btnSearch'])) {
	$rdoSearchType = $_POST['rdoSearchType'];

	if ($rdoSearchType == 1) {
		$cboOrderID = $_POST['cboOrderID'];

		$Squery = "SELECT o.*,c.customerid,c.customername
					FROM Orders o,Customer c 
					WHERE o.customerid=c.customerid
				 	AND o.OrderID='$cboOrderID'";
		$result = mysqli_query($connection, $Squery);
	} elseif ($rdoSearchType == 2) {
		$txtFrom = date('Y-m-d', strtotime($_POST['txtFrom']));
		$txtTo = date('Y-m-d', strtotime($_POST['txtTo']));

		$Squery = "SELECT o.*,c.customerid,c.customername
					FROM Orders o,Customer c 
					WHERE o.customerid=c.customerid
				 AND o.OrderDate BETWEEN '$txtFrom' AND '$txtTo'";
		$result = mysqli_query($connection, $Squery);
	} else {
		$Squery = "SELECT o.*,c.customerid,c.customername
					FROM Orders o,Customer c 
					WHERE o.customerid=c.customerid";
		$result = mysqli_query($connection, $Squery);
	}
} elseif (isset($_POST['btnShowAll'])) {
	$Squery = "SELECT o.*,c.customerid,c.customername
					FROM Orders o,Customer c 
					WHERE o.customerid=c.customerid";
	$result = mysqli_query($connection, $Squery);
} else {
	$todayDate = date('Y-m-d');

	$Squery = "SELECT o.*,c.customerid,c.customername
					FROM Orders o,Customer c 
					WHERE o.customerid=c.customerid
				 		AND o.OrderDate='$todayDate'";
	$result = mysqli_query($connection, $Squery);
}
?>

<!DOCTYPE html>
<html>

<head>
	<title></title>
</head>

<body>
	<table>
		<tr>
			<td> <a href="StaffHome.php">Home</a></td>
			<td>|</td>
			<td> <a href="Brand.php">Brand</a></td>
			<td>|</td>
			<td> <a href="Category.php">Category</a></td>
			<td>|</td>
			<td> <a href="Product.php">Product</a></td>
			<td>|</td>
			<td> <a href="Supplier.php">Supplier</a></td>
			<td>|</td>
			<td> <a href="Purchase.php">Purchase</a></td>
			<td>|</td>
			<td> <a href="Staff.php">Staff</a></td>
			<td>|</td>
			<td> <a href="PurchaseReport.php">Purchase Report</a></td>
			<td>|</td>
			<td> <a href="LogOut.php">LogOut</a></td>
			<td>|</td>



		</tr>
	</table>




	<form action="StaffHome.php" method="post">
		<fieldset>

			<table border="1" align="center">
				<tr>
					<td align="center" colspan="6">
						<h1>Search:</h1>
					</td>
				</tr>
				<tr>
					<td>
						<input type="radio" name="rdoSearchType" value="1" checked />Search by Product Order
						<br />
						<select name="cboOrderID">
							<option>Choose OrderID</option>
							<?php
							$query = "SELECT o.*,c.customerid,c.customername
					FROM Orders o,Customer c 
					WHERE o.customerid=c.customerid";
							$ret = mysqli_query($connection, $query);
							$count = mysqli_num_rows($ret);

							for ($i = 0; $i < $count; $i++) {
								$arr = mysqli_fetch_array($ret);
								$orderid = $arr['OrderID'];
								$CustomerName = $arr['CustomerName'];

								echo "<option value='$orderid'>" . $orderid . $CustomerName . "</option>";
							}

							?>
						</select>
					</td>

					<td>
						<input type="radio" name="rdoSearchType" value="2" />Search by Date
						<br />
						From:<input type="date" name="txtFrom" value="<?php echo date('Y-m-d') ?>" />
						To :<input class="form-control valid" type="date" name="txtTo" value="<?php echo date('Y-m-d') ?>" />
					</td>

					<td>
						<br />
						<input type="submit" name="btnSearch" value="Search" />
						<input type="submit" name="btnShowAll" value="Show All" />
						<input type="reset" value="Clear" />
					</td>

				</tr>
			</table>
		</fieldset>

		<fieldset>
			<legend>Search Results :</legend>
			<?php
			$count = mysqli_num_rows($result);

			if ($count == 0) {
				echo "<p>No Order Record Found.</p>";
				//exit();
			}
			?>
			<table id="tableid" class="display" align="center" border="1px">
				<thead>
					<tr>
						<th>Order ID</th>
						<th>Order Date</th>
						<th>Customer Name</th>
						<th>TotalAmount</th>
						<th>TotalQuantity</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					for ($i = 0; $i < $count; $i++) {
						$arr = mysqli_fetch_array($result);
						$OrderID = $arr['OrderID'];
						$CustomerName = $arr['customername'];

						echo "<tr>";
						echo "<td>$OrderID</td>";
						echo "<td>" . $arr['OrderDate'] . "</td>";
						echo "<td>" . $CustomerName .  "</td>";
						echo "<td>" . $arr['totalamount'] . "</td>";
						echo "<td>" . $arr['totalquantity'] . "</td>";
						echo "<td>" . $arr['orderstatus'] . "</td>";
						echo "<td> 
					 

		<a href='orderdetail.php?pid=$OrderID' style='color:red'>Detail</a> |
		<a href='orderaccept.php?pid=$OrderID' style='color:red'>Accept</a> |

				  </td>";
						echo "</tr>";
					}
					?>
				</tbody>
			</table>
		</fieldset>
	</form>
</body>

</html>