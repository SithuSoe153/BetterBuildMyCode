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
		text-align: left;
		padding: 8px;
	}

	tr:nth-child(even) {
		border-top: 1px solid black;
		border-bottom: 1px solid black;
		background-color: #f2f2f2;
	}
</style>


<form>

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
			<div class="container-fluid p-0">

				<h1 class="h3 mb-3">
					<a href="delivery.php" class="btn btn-lg btn-primary">Back</a>

				</h1>

				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<?php
								if (isset($_REQUEST['oid'])) {

									$oid = $_REQUEST['oid'];
								?>
									<h5 class="card-title mb-0"> Detail Delivery Report for ( <?php echo $oid ?> )</h5>
							</div>


							<div class="card-body text-center">

								<table border="1" width="500px">


									<tr>
										<td>Product Name</td>
										<td>Unit Price</td>
										<td>Unit Quantity</td>
									</tr>

								<?php


									$Select = "select * from orders o, delivery d, orderdetail od, product p
									Where o.Delivery = 'YES'
									And o.orderid = '$oid'
									And o.orderid = d.orderid
									And od.orderid = '$oid'
									AND od.productid = p.productid";

									$query = mysqli_query($connection, $Select);
									$count = mysqli_num_rows($query);
								}

								for ($i = 0; $i < $count; $i++) {

									$data = mysqli_fetch_array($query);

									$productname = $data['productname'];
									$unitprice = $data['unitprice'];
									$unitquantity = $data['unitquantity'];
									$orderdate = $data['orderdate'];

									$totalamount = $data['totalamount'];
									$totalquantity = $data['totalquantity'];




								?>
									<tr>
										<td>
											<?php echo $productname ?>
										</td>
										<td>
											<?php echo $unitprice ?>
										</td>
										<td>
											<?php echo $unitquantity ?>
										</td>
									</tr>

								<?php
								}
								?>
								<tr>
									<td colspan="3">
										<hr>
									</td>
								</tr>
								<tr>
									<td colspan="3">
										Order ID :<?php echo $oid ?><p>
											Order Date :<?php echo $orderdate  ?>
										<p>
											<!-- Customer Name : <?php echo $customername ?> -->
									</td>
								</tr>
								<tr>
									<td colspan="3">
										Total Amount :<?php echo $totalamount ?><p>
											Total Quantity :<?php echo $totalquantity ?>
									</td>
								</tr>
								</table>
							</div>

							<div class="card-body">
							</div>
						</div>
					</div>
				</div>

			</div>
		</main>

		<?php

		include('sfooter.php');

		?>
	</div>
</form>