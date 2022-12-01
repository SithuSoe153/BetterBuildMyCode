<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$rawphpans = "active";
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


if (isset($_POST['btnregister'])) {
	$rawtype = $_POST['rawtype'];
	$rawdes = $_POST['rawdes'];
	$rawtp = $_POST['rawtp'];
	$rawqtyleft = 0;

	//////////////////////////////////Image/////////////////////////////////

	$Image = $_FILES['rawprofile']['name'];
	$Folder = "images/";
	$filename = $Folder . '_' . $Image;
	$image = copy($_FILES['rawprofile']['tmp_name'], $filename);
	if (!$image) {
		echo "<p>Cannot Upload  Raw Profile</p>";
		exit();
	}

	/////////////////////////////////////////////////////////////////////////



	$select = "SELECT * FROM raw where rawtype='$rawtype'";
	$query1 = mysqli_query($connection, $select);
	$count = mysqli_num_rows($query1);
	if ($count > 0) {
		$alert = 'Duplicate Raw Material Name.\nYour registered ( ';
		$alert .= $rawtype;
		$alert .= ' ) is already inside the Raw the data base.';

		echo "<script>alert(\"$alert\")</script>";
	} else {
		$insert = "INSERT INTO raw
        (rawtype,rawdes,rawtp,rawqtyleft,rawprofile)
        VALUES
        ('$rawtype','$rawdes','$rawtp','$rawqtyleft','$filename')";
		$query = mysqli_query($connection, $insert);
		if ($query) {
			echo "<script>alert('Raw Register Successful!')</script>";
		}
	}
}

?>

<form action="raw.php" method="post" enctype="multipart/form-data">

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
				<div class="container d-flex flex-column">
					<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
						<div class="d-table-cell align-middle">
							<div class="text-center mt-4">
								<h1 class="h2">Raw Material</h1>
								<p class="lead">
									Insert New Raw Material Here !
								</p>
							</div>

							<div class="card">
								<div class="card-body">
									<div class="m-sm-4">
										<form>
											<div class="mb-3">
												<label class="form-label">Raw Type</label>
												<input class="form-control form-control-lg" type="text" name="rawtype" placeholder="Enter New Raw Material Name" />
											</div>

											<div class="mb-3">
												<label class="form-label">Raw Description</label>
												<textarea name="rawdes" class="form-control" rows="2" placeholder="Description"></textarea>
											</div>

											<div class="mb-3">
												<label class="form-label">Raw Total Price</label>
												<input class="form-control form-control-lg" type="number" name="rawtp" placeholder="Price" />
											</div>

											<div class="mb-3" style="margin-right: 40%">
												<div class="mb-3" id="selectedBanner" style="margin-left: 52%;margin-bottom: 52%"></div>
												<div class="form-control form-control-lg">
													<div id="forfile">
														<input name="rawprofile" class="img" id="file" type="file" accept="image/*" />
														<label for="file">
															<i class="fa fa-image"></i> &nbsp
															Choose Picture
														</label>
													</div>
												</div>
											</div>

											<script>
												<?php
												include('js/selectedBanner.js');
												?>
											</script>

											<div class="text-center mt-3">
												<button name="btnregister" class="btn btn-lg btn-primary">Register</button>
												<button type="reset" name="btnreset" class="btn btn-lg btn-primary">Reset</button>
											</div>
										</form>
									</div>
								</div>
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