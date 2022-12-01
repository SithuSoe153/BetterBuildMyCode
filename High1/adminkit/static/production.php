<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$productionphpans = "active";
include('../../connect.php');
include('sheader.php');
include('autoidfunction.php');
include('productionfunction.php');

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
	$StaffID = $_GET['cboStaffID'];
	$txtproductionid = $_GET['txtproductionid'];
	//$govtax=CalculateTax();
	$txtproductiondate = $_GET['txtproductiondate'];
	$productid = $_GET['cboproduct']; // productid from cbo
	$categoryid = $_GET['cbocategory']; // categoryid from cbo

	$Totalquantity = CalculateTotalQuantity();
	$Status = "Pending";

	$insert_pro = "INSERT INTO production
	(productionid,productiondate,staffid,totalquantity,productionstatus)values
	('$txtproductionid','$txtproductiondate','$StaffID','$Totalquantity','$Status')";

	$ret = mysqli_query($connection, $insert_pro);


	$size = count($_SESSION['productionfunction']);
	for ($i = 0; $i < $size; $i++) {
		$productid = $_SESSION['productionfunction'][$i]['productid'];
		$categoryidd = $_SESSION['productionfunction'][$i]['categoryid'];
		$productquantity =  $_SESSION['productionfunction'][$i]['productquantity'];

		$inser_PRODetail = "INSERT INTO productiondetail(productionid,categoryid,productid,totalquantity)
	VALUES('$txtproductionid','$categoryidd','$productid','$productquantity')";
		$ret = mysqli_query($connection, $inser_PRODetail);

		$inser_PRODetail = "Update product Set unitquantity=unitquantity+'$productquantity' where productid='$productid'";
		$ret = mysqli_query($connection, $inser_PRODetail);

		$inser_PRODetail = "Update  raw r, itemdetail i  Set rawqtyleft=rawqtyleft- (i.rawqty*'$productquantity') WHERE  i.productid='$productid' AND i.rawid=r.rawid";
		$ret = mysqli_query($connection, $inser_PRODetail);
	}

	if ($ret) {

		unset($_SESSION['productionfunction']);
		echo "<script>window.alert('Production Process Complete.')</script>";
		echo "<script>window.location='production.php'</script>";
	} else {
		echo "<p>Something went wrong in production process:" . mysqli_error($connection) . "</p>";
	}
}


if (isset($_GET['action'])) {
	$action = $_GET['action'];
	if ($action === 'add') {

		$categoryid = $_GET['cbocategory'];
		$productid = $_GET['cboproduct'];
		$productquantity = $_GET['txtproductquantity'];

		Add($categoryid, $productid, $productquantity);
	} elseif ($action === 'remove') {
		$productid = $_GET['productid'];
		Remove($productid);
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


<SCRIPT src="item/jquery-1.4.3.js"></SCRIPT>
<SCRIPT src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></SCRIPT>
<script src="item/dependent_drop_down/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#authors").change(function() {
			var aid = $("#authors").val();
			$.ajax({
				url: 'item/dependent_drop_down/data.php',
				method: 'post',
				data: 'aid=' + aid
			}).done(function(books) {
				console.log(books);
				books = JSON.parse(books);
				$('#books').empty();
				books.forEach(function(book) {
					$('#books').append('<option value=' + book.productid + ' >' + book.productname + '</option>')
				})
			})
		})
	})
</script>



<form action="production.php" method="GET">

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
									<h1 class="h2">Production</h1>
									<p class="lead">
										Production Process !
									</p>
								</div>

								<div class="card">
									<div class="card-body">
										<div class="m-sm-4">

											<div class="mb-3">
												<input type="hidden" name="action" value="add">
												<label class="form-label">Production ID</label>
												<input class="form-control form-control-lg" type="text" name="txtproductionid" value="<?php echo AutoID('production', 'productionid', 'PRO-', 6) ?>" readonly>
											</div>

											<div class="mb-3">

												<label class="form-label">Production Date</label>
												<input class="form-control form-control-lg" name="txtproductiondate" type="text" value="<?php echo date('Y-m-d') ?>" readonly />
											</div>

											<div class="mb-3">
												<label class="form-check form-check-inline">
													Choose Category :
													<select class="form-control" id="authors" name="cbocategory">
														<option selected disabled>---Select---</option>
														<?php
														require 'item/dependent_drop_down/data.php';
														$authors = loadAuthors();
														foreach ($authors as $author) {
															echo "<option value='" . $author['categoryid'] . "'>" . $author['categoryname'] . "</option>";
														}
														?>
													</select>

												</label>
											</div>


											<div class="mb-3">
												<label class="form-check form-check-inline">
													Choose Product :
													<select class="form-control" id="books" name="cboproduct">
														<option selected disabled>---Select---</option>
													</select>
												</label>
											</div>

											<div class="mb-3">
												<label class="form-label">Product Quantity</label>
												<input class="form-control form-control-lg" name="txtproductquantity" type="number" placeholder="0" />
											</div>

											<div class="text-center mt-3">
												<button name="btnAdd" class="btn btn-lg btn-primary">Add</button>
												<input type="reset" class="btn btn-lg btn-primary" value="Reset">
											</div>

										</div>



									</div>
								</div>

							</div>
						</div>
						<div class="card-body text-center">

							<fieldset>
								<legend>Item List</legend>
								<?php
								if (!isset($_SESSION['productionfunction'])) {
									echo "<p>No Item Record Found.</p>";
								} else {
								?>
									<table>
										<thead>
											<tr>
												<th>Image</th>
												<th>Category Name</th>
												<th>Product Name</th>
												<th>Purchase Qty</th>

												<th>Action</th>
											</tr>
										</thead>

										<tbody>
											<?php
											$size = count($_SESSION['productionfunction']);
											for ($i = 0; $i < $size; $i++) {
												$image1 = $_SESSION['productionfunction'][$i]['image1'];
												$categoryname = $_SESSION['productionfunction'][$i]['categoryname'];
												$productname = $_SESSION['productionfunction'][$i]['productname'];
												$productquantity = $_SESSION['productionfunction'][$i]['productquantity'];

												echo "<tr>";
												echo "<td><img src='$image1' width='100px' height='100px'/></td>";
												echo "<td>$categoryname</td>";
												echo "<td>$productname</td>";
												echo "<td>$productquantity Pcs</td>";

												// echo "<td><a href='production.php?action=remove&productid=$productid'>Remove</a><td>";
												echo "</tr>";
											}
											?>

											<tr>

												<td style="padding-bottom:24px;">



													<p></p>
													<span>Staff Name</span>

												</td>

												<td colspan="2">

													<span>
														<select name="cboStaffID">
															<option>-----Select Staff Name------</option>
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
										</tbody>
									</table>
								<?php
								}
								?>
							</fieldset>
						</div>
					</div>
				</div>

		</main>

		<?php

		include('sfooter.php');

		?>
	</div>

</form>