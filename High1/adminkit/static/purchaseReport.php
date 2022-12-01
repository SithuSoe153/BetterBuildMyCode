<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$purchaseReportphpans = "active";
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
		$cboPurchaseID = $_POST['cboPurchaseID'];

		$Squery = "SELECT p.*,s.supplierid,s.suppliername
					FROM purchase p,supplier s 
					WHERE p.supplierid=s.supplierid
					AND p.PurchaseID='$cboPurchaseID'";
		$result = mysqli_query($connection, $Squery);
	} elseif ($rdoSearchType == 2) {
		$txtFrom = date('Y-m-d', strtotime($_POST['txtFrom']));
		$txtTo = date('Y-m-d', strtotime($_POST['txtTo']));

		$Squery = "SELECT p.*,s.supplierid,s.suppliername
				FROM purchase p,supplier s 
				WHERE p.PurchaseDate BETWEEN '$txtFrom' AND '$txtTo'
				AND p.supplierid=s.supplierid";
		$result = mysqli_query($connection, $Squery);
	} else {
		$Squery = "SELECT p.*,s.supplierid,s.suppliername
				FROM purchase p,supplier s 
				WHERE p.supplierid=s.supplierid";
		$result = mysqli_query($connection, $Squery);
	}
} elseif (isset($_POST['btnShowAll'])) {
	$Squery = "SELECT p.*,s.supplierid,s.suppliername
			FROM purchase p,supplier s 
			WHERE p.supplierid=s.supplierid";
	$result = mysqli_query($connection, $Squery);
} else {
	$todayDate = date('Y-m-d');

	$Squery = "SELECT p.*,s.supplierid,s.suppliername
				FROM purchase p,supplier s 
				WHERE p.purchasedate='$todayDate'
				AND p.supplierid=s.supplierid";
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


<form action="purchaseReport.php" method="post">

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
											Search by Purchase
											<select name="cboPurchaseID" class="form-select mb-3">
												<option selected>Choose PurchaseID</option>
												<?php
												$query = "SELECT p.*,s.supplierid,s.suppliername
												FROM purchase p,supplier s 
												WHERE p.supplierid=s.supplierid";
												$ret = mysqli_query($connection, $query);
												$count = mysqli_num_rows($ret);

												for ($i = 0; $i < $count; $i++) {
													$arr = mysqli_fetch_array($ret);
													$PurchaseID = $arr['purchaseid'];
													$SupplierName = $arr['suppliername'];

													echo "<option value='$PurchaseID'>" . $PurchaseID . $SupplierName . "</option>";
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
							echo "<p>No Purchase Record Found.</p>";
						} else {
						?>
							<table>
								<thead>
									<tr>
										<th>PurchaseID</th>
										<th>Purchase Date</th>
										<th>Supplier Name</th>
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
										$purchaseid = $arr['purchaseid'];
										$suppliername = $arr['suppliername'];

										echo "<tr>";
										echo "<td>$purchaseid</td>";
										echo "<td>" . $arr['purchasedate'] . "</td>";
										echo "<td>" . $suppliername .  "</td>";
										echo "<td>" . $arr['totalamount'] . "</td>";
										echo "<td>" . $arr['totalquantity'] . "</td>";
										echo "<td>" . $arr['purchasestatus'] . "</td>";
										echo "<td> 
							
							<a class='btn btn-primary' href='purchasedetail.php?pid=$purchaseid'>Detail</a> |
							<a class='btn btn-primary' href='purchaseaccept.php?pid=$purchaseid'>Accept</a>
							
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

		<?php

		include('sfooter.php');

		?>
	</div>
</form>