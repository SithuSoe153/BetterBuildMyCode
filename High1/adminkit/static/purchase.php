<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$purchasephpans = "active";
include('../../connect.php');
include('sheader.php');

include('autoidfunction.php');
include('PurchaseFunction.php');


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






if (isset($_GET['btnsave'])) {
	$cboSupplierID = $_GET['cboSupplierID'];
	$StaffID = $_GET['cboStaffID'];
	$txtpurchaseid = $_GET['txtpurchaseid'];
	//$govtax=CalculateTax();
	$txtpurchasedate = $_GET['txtpurchasedate'];
	$TotalAmount = CalculateTotalAmount();
	$Totalquantity = CalculateTotalQuantity();
	$Status = "Pending";
	$insert_pur = "INSERT INTO purchase
	(purchaseid,purchasedate,supplierid,staffid,totalamount,totalquantity,purchasestatus)values
	('$txtpurchaseid','$txtpurchasedate','$cboSupplierID','$StaffID','$TotalAmount','$Totalquantity','$Status')";
	$ret = mysqli_query($connection, $insert_pur);

	$size = count($_SESSION['purchasefunction']);
	for ($i = 0; $i < $size; $i++) {
		$rawid = $_SESSION['purchasefunction'][$i]['rawid'];
		$rawtype = $_SESSION['purchasefunction'][$i]['rawtype'];
		$purchaseprice = $_SESSION['purchasefunction'][$i]['purchaseprice'];
		$purchasequantity = $_SESSION['purchasefunction'][$i]['purchasequantity'];

		$inser_PDetail = "INSERT INTO purchasedetail(purchaseid,rawid,rawtype,unitprice,unitquantity)
	VALUES('$txtpurchaseid','$rawid','$rawtype','$purchaseprice','$purchasequantity')";
		$ret = mysqli_query($connection, $inser_PDetail);

		$inser_PDetail = "Update raw Set rawqtyleft=rawqtyleft+'$purchasequantity' where rawid='$rawid'";
		$ret = mysqli_query($connection, $inser_PDetail);

		$inser_PDetail = "Update raw Set rawtp=rawtp+'$purchasequantity' where rawid='$rawid'";
		$ret = mysqli_query($connection, $inser_PDetail);

		if ($ret) {
			echo "<script>window.alert('Purchase Process Complete.')</script>";
			unset($_SESSION['purchasefunction']);
			echo "<script>window.location='purchase.php'</script>";
			session_write_close();
			// header("Location: purchase.php?success=1");
			echo "<script>window.alert('Purchase Process Complete.')</script>";
		} else {
			echo "<p>Something went wrong in purchase:" . mysqli_error($connection) . "</p>";
		}
	}
}


if (isset($_GET['action'])) {
	$action = $_GET['action'];
	if ($action === 'add') {
		$rawid = $_GET['cborawtype'];
		$purchaseprice = $_GET['txtpurchaseprice'];
		$purchasequantity = $_GET['txtpurchasequantity'];
		Add($rawid, $purchaseprice, $purchasequantity);
	} elseif ($action === 'remove') {
		$rawid = $_GET['rawid'];
		Remove($rawid);
	} elseif ($action === 'clearall') {
		//	ClearAll();
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
		text-align: center;
		padding: 8px;
	}

	tr:nth-child(even) {
		border-top: 1px solid black;
		border-bottom: 1px solid black;
		background-color: #f2f2f2;
	}
</style>



<form action="purchase.php" method="GET">

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
				<div class="container-fluid p-0">
					<div class="container d-flex flex-column">
						<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
							<div class="d-table-cell align-middle">
								<div class="text-center mt-4">
									<h1 class="h2">Purchase</h1>
									<p class="lead">
										Purchase Raw Material !
									</p>
								</div>

								<div class="card">
									<div class="card-body">
										<div class="m-sm-4">
											<div class="mb-3">
												<label class="form-label">Purchase ID</label>
												<input type="hidden" name="action" value="add">
												<input class="form-control form-control-lg" type="text" name="txtpurchaseid" value="<?php echo AutoID('purchase', 'purchaseid', 'PUR-', 6) ?>" readonly />
											</div>

											<div class="mb-3">
												<label class="form-label">Purchase Date</label>
												<input class="form-control form-control-lg" type="text" name="txtpurchasedate" value="<?php echo date('Y-m-d') ?>" readonly />
											</div>

											<div class="mb-3">
												<label class="form-label">Raw Material Name</label>

												<?php

												$select = "SELECT * FROM raw";
												$query = mysqli_query($connection, $select);
												$count = mysqli_num_rows($query);

												echo "<select name='cborawtype' class='form-select mb-3'>";
												echo "<option selected disabled=''>Choose Raw Material</option>";
												for ($i = 0; $i < $count; $i++) {
													$data = mysqli_fetch_array($query);
													$rawtype = $data['rawtype'];
													$rawid = $data['rawid'];
													echo "<option value='$rawid'>$rawtype</option>";
												}
												echo "</select>";
												?>

											</div>

											<div class="mb-3">
												<label class="form-label">Purchase Price</label>
												<input class="form-control form-control-lg" type="number" name="txtpurchaseprice" placeholder="0" />
											</div>

											<div class="mb-3">
												<label class="form-label">Purchase Quantity</label>
												<input class="form-control form-control-lg" type="number" name="txtpurchasequantity" placeholder="0" />
											</div>

											<div class="text-center mt-3">
												<button name="btnAdd" class="btn btn-lg btn-primary">Add</button>
											</div>

										</div>
									</div>
								</div>


							</div>
						</div>
					</div>
				</div>



				<div class="card-body text-center">

					<fieldset>
						<legend>Product List</legend>

						<?php

						// if (isset($_POST['success']) && $_POST['success'] == 1) {

						// 	echo "<p>No Purchase Record Found.</p>";
						// } else {
						// 	echo "Session";
						// }





						if (!isset($_SESSION['purchasefunction']) || !isset($_SESSION['purchasefunction'][0])) {
							echo "<p>No Purchase Record Found.</p>";
						} else {

						?>
							<table>
								<thead>
									<tr>
										<th>Image</th>
										<!-- <th>Raw ID</th> -->
										<th>Raw Type</th>
										<th>Purchase Price</th>
										<th>Purchase Qty</th>
										<th>Sub Total</th>
										<th>Action</th>
									</tr>
								</thead>

								<tbody>
									<?php

									$size = count($_SESSION['purchasefunction']);
									for ($i = 0; $i < $size; $i++) {
										$image1 = $_SESSION['purchasefunction'][$i]['image1'];
										$rawid = $_SESSION['purchasefunction'][$i]['rawid'];
										$rawtype = $_SESSION['purchasefunction'][$i]['rawtype'];
										$purchaseprice = $_SESSION['purchasefunction'][$i]['purchaseprice'];
										$purchasequantity = $_SESSION['purchasefunction'][$i]['purchasequantity'];
										$Subtotal = intval($purchaseprice) * intval($purchasequantity);

										echo "<tr>";

										echo "<td><img src='$image1' width='100px' height='100px'/></td>";
										// echo "<td>$rawid</td>";
										echo "<td>$rawtype</td>";
										echo "<td>$purchaseprice MMK</td>";
										echo "<td>$purchasequantity Pcs</td>";
										echo "<td>$Subtotal MMK</td>";

										echo "<td><a href='purchase.php?action=remove&rawid=$rawid'>Remove</a></td>";

										echo "</tr>";
									}
									?>

									<tr>

										<td style="padding-bottom:24px;">

											<span margin-top="0px">Supplier Name</span>
											<p></p>
											<span></span> <br>
											<p></p>
											<span>Staff Name</span>

										</td>

										<td colspan="2">
											<span>
												<select name="cboSupplierID" class="form-select mb-3">
													<option selected disabled=''>Select Supplier Name</option>
													<?php
													$query = "Select * FROM supplier";
													$ret = mysqli_query($connection, $query);
													$count = mysqli_num_rows($ret);

													for ($i = 0; $i < $count; $i++) {
														$arr = mysqli_fetch_array($ret);
														$SupplierID = $arr['supplierid'];
														$suppliername = $arr['suppliername'];
														echo "<option value='$SupplierID'>" . $suppliername . "</option>";
													}
													?>
												</select>
											</span>

											<p></p>
											<span></span> <br>

											<span>
												<select name="cboStaffID" class="form-select mb-3">
													<option selected disabled=''>Select Staff Name</option>
													<?php
													$query = "Select * FROM staff";
													$ret = mysqli_query($connection, $query);
													$count = mysqli_num_rows($ret);

													for ($i = 0; $i < $count; $i++) {
														$arr = mysqli_fetch_array($ret);
														$StaffID = $arr['staffid'];
														$staffname = $arr['staffname'];
														echo "<option value='$StaffID'>" . $staffname . "</option>";
													}
													?>
												</select>
											</span>

											<span>
												<button name="btnsave" class="btn btn-lg btn-primary">Register</button>
											</span>

										</td>

										<td colspan="3">

										</td>
									</tr>

								<?php }
								?>

								</tbody>
							</table>
					</fieldset>
				</div>

			</div>
		</main>

		<?php

		include('sfooter.php');

		?>
	</div>

</form>