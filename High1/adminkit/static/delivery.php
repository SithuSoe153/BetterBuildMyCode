<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$deliveryphpans = "active";
include('../../connect.php');
include('sheader.php');

if (isset($_SESSION['sid'])) {
	$sid = $_SESSION['sid'];
	$select = "SELECT * FROM staff where staffid='$sid'";
	$query = mysqli_query($connection, $select);
	$count = mysqli_num_rows($query);
	if ($count > 0) {
		$data = mysqli_fetch_array($query);
		$staffid = $data['staffid'];
		$staffname = $data['staffname'];
		$staffemail = $data['staffemail'];
		$password = $data['password'];
		$phonenumber = $data['phonenumber'];
		$address = $data['address'];
		$staffrole = $data['staffrole'];
		$staffskill = $data['staffskill'];
		$staffskills = explode(',', $staffskill);
		$staffprofile = $data['staffprofile'];
	}
}



if (isset($_POST['btnSearch'])) {
	$rdoSearchType = $_POST['rdoSearchType'];

	if ($rdoSearchType == 1) {
		$cboOrderID = $_POST['cboOrderID'];

		$Squery = "SELECT *
					FROM orders o,delivery d
					WHERE  o.Delivery ='YES'
					AND o.orderid = d.orderid
                    AND o.orderid='$cboOrderID'";


		$result = mysqli_query($connection, $Squery);
	} elseif ($rdoSearchType == 2) {
		$txtFrom = date('Y-m-d', strtotime($_POST['txtFrom']));
		$txtTo = date('Y-m-d', strtotime($_POST['txtTo']));

		$Squery = "SELECT o.*,c.customerid,c.customername
					FROM orders o,delivery d
					WHERE  o.Delivery ='YES'
					AND o.orderid = d.orderid
                    AND o.orderdate BETWEEN '$txtFrom' AND '$txtTo'";
		$result = mysqli_query($connection, $Squery);
	} else {
		$Squery = "SELECT o.*,c.customerid,c.customername
					FROM orders o,delivery d
					
					WHERE  o.Delivery ='YES'
					AND o.orderid = d.orderid";
		$result = mysqli_query($connection, $Squery);
	}
} elseif (isset($_POST['btnShowAll'])) {
	$Squery = "SELECT *
					FROM orders o,delivery d
					AND o.orderid = d.orderid
					WHERE  o.Delivery ='YES'";
	$result = mysqli_query($connection, $Squery);
} else {
	$todayDate = date('Y-m-d');

	$Squery = "SELECT *
					FROM orders o,delivery d
					WHERE  o.Delivery ='YES'
					AND o.orderid = d.orderid
                    AND o.orderdate='$todayDate'";
	$result = mysqli_query($connection, $Squery);
}

?>


<style>
	table {
		border-collapse: collapse;
		border-spacing: 0;
		width: 100%;
		border: 1px solid #ddd;
	}

	th,
	td {
		text-align: center;
		padding: 8px;
	}

	tr:nth-child(even) {
		border-top: 1px solid black;
		border-bottom: 1px solid black;
		background-color: #f2f2f2;
	}
</style>



<form action="delivery.php" method="post">

	<script>
		<?php
		include('js/allcount.js');
		?>
	</script>

	<div class="main">

		<?php
		include('nav.php');
		?>

		<main class="content">
			<div class="card">
				<div class="card-body text-center">

					<fieldset>

						<table>
							<legend>Search :</legend>
							<tr>
								<td style="width:50%">

									<label class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="rdoSearchType" value="1" checked>
										<span class="form-check-label">
											Search by Order ID
											<select name="cboOrderID" class="form-select mb-3">
												<option selected>Choose OrderID</option>
												<?php
												$query = "SELECT *
												FROM orders o,delivery d 
												WHERE  o.Delivery ='YES'
												AND o.orderid = d.orderid";


												$ret = mysqli_query($connection, $query);
												$count = mysqli_num_rows($ret);

												for ($i = 0; $i < $count; $i++) {
													$arr = mysqli_fetch_array($ret);
													$orderid = $arr['orderid'];
													$CustomerName = $arr['CustomerName'];

													echo "<option value='$orderid'>" . $orderid . $CustomerName . "</option>";
												}

												?>
											</select>
										</span>
									</label>
								</td>

								<td colspan="2">
									<label class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="rdoSearchType" value="2">
										<span class="form-check-label">
											Search by Date
											<br />
											From:<input type="date" name="txtFrom" value="<?php echo date('Y-m-d') ?>" />
											To :<input type="date" name="txtTo" value="<?php echo date('Y-m-d') ?>" />

										</span>
									</label>

								</td>
							</tr>

							<tr>
								<td colspan="2" style="text-align:center;">
									<br>
									<input class="btn btn-secondary" type="submit" name="btnSearch" value="Search" />
									<input class="btn btn-secondary" type="submit" name="btnShowAll" value="Show All" />
									<input class="btn btn-secondary" type="reset" value="Clear" />
									<br>
								</td>

							</tr>
						</table>
					</fieldset>

				</div>



				<div class="card-body text-center">

					<fieldset>
						<legend>Search Results :</legend>
						<?php
						$count = mysqli_num_rows($result);

						if ($count == 0) {
							echo "<p>No Order Record Found.</p>";
						} else {
						?>
							<table>
								<thead>
									<tr>
										<th>Order ID</th>
										<th>Order Date</th>
										<th>Customer Name</th>
										<th>Phone</th>
										<!-- <th>Address</th> -->
										<th>Total Amount</th>
										<th>Total Quantity</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									for ($i = 0; $i < $count; $i++) {
										$arr = mysqli_fetch_array($result);
										$orderID =  $arr['orderid'];
										$DeliveryID = $arr['deliveryID'];
										$CustomerName = $arr['cusName'];

										echo "<tr>";
										echo "<td>$orderID</td>";
										echo "<td>" . $arr['orderdate'] . "</td>";
										echo "<td>" . $CustomerName .  "</td>";
										echo "<td>" . $arr['cusPhone'] .  "</td>";
										// echo "<td>" . $arr['cusAddress'] .  "</td>";
										echo "<td>" . $arr['totalamount'] . "</td>";
										echo "<td>" . $arr['totalquantity'] . "</td>";
										echo "<td>" . $arr['orderstatus'] . "</td>";
										echo "<td> 
					
					<a class='btn btn-primary' href='deliveryDetail.php?oid=$orderID'>Detail</a> |
					<a class='btn btn-primary' href='deliveryAccept.php?oid=$orderID'>Accept</a>
					
					</td>";
										echo "</tr>";
									}
									?>
								</tbody>
							</table>
						<?php
						}
						?>
					</fieldset>
				</div>
			</div>
		</main>
	</div>

	<?php

	include('sfooter.php');

	?>
	</div>
</form>