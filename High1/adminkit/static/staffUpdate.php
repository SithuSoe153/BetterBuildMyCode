<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$profilephpans = "active";
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
	$txtstaffid = $_POST['txtstaffid'];
	$txtstaffname = $_POST['txtstaffname'];
	$txtstaffemail = $_POST['txtstaffemail'];
	$txtstaffpassword = $_POST['txtstaffpassword'];
	$txtstaffphonenumber = $_POST['txtstaffphonenumber'];
	$txtstaffaddress = $_POST['txtstaffaddress'];


	//////////////////////////////////Image/////////////////////////////////


	$Image = $_FILES['staffprofile']['name'];
	$Folder = "images/";
	$filename = $Folder . '_' . $Image;
	$image = copy($_FILES['staffprofile']['tmp_name'], $filename);
	if (!$image) {
		echo "<p>Cannot Upload  staff Profile</p>";
		exit();
	}

	/////////////////////////////////////////////////////////////////////////

	$update = "UPDATE staff 
	set staffname='$txtstaffname',staffemail='$txtstaffemail',password='$txtstaffpassword',phonenumber='$txtstaffphonenumber',address='$txtstaffaddress',staffprofile='$filename' 
	where staffid='$txtstaffid'";
	$query = mysqli_query($connection, $update);
	if ($query) {
		echo "<script>alert('Profile Update Successfully')</script>";
		echo "<script>window.location='pages-profile.php'</script>";
	}
}

if (isset($_POST['btncancel'])) {
	echo "<script>window.location='pages-profile.php'</script>";
}



?>

<form action="staffUpdate.php" method="post" enctype="multipart/form-data">

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
								<h1 class="h2">Update</h1>
								<p class="lead">
									Update Your Information Here !
								</p>
							</div>

							<div class="card">
								<div class="card-body">
									<div class="m-sm-4">

										<div class="mb-3">
											<label class="form-label">Your Name</label>
											<input type="hidden" name="txtstaffid" value="<?php echo $staffid ?>">
											<input class="form-control form-control-lg" type="text" name="txtstaffname" required value="<?php echo $staffname ?>" />
										</div>

										<div class="mb-3">
											<label class="form-label">Email Address</label>
											<input class="form-control form-control-lg" type="text" name="txtstaffemail" required value="<?php echo $staffemail ?>" />
										</div>

										<div class="mb-3">
											<label class="form-label">Phone Number</label>
											<input class="form-control form-control-lg" type="text" name="txtstaffphonenumber" required value="<?php echo $phonenumber ?>" />
										</div>

										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="text" name="txtstaffpassword" required value="<?php echo $password ?>" />
										</div>

										<div class="mb-3">
											<label class="form-label">Address</label>
											<textarea name="txtstaffaddress" class="form-control" rows="2">
											<?php echo $address ?>
											</textarea>
										</div>


										<div class="mb-3" style="margin-right: 40%">
											<div class="mb-3" id="selectedBanner" style="margin-left: 52%;margin-bottom: 52%"></div>
											<div class="form-control form-control-lg">
												<div id="forfile">
													<input name="staffprofile" class="img" id="file" type="file" accept="image/*" />
													<label for="file">
														<i class="fa fa-image"></i> &nbsp
														Choose Picture


													</label>
												</div>
											</div>
										</div>

										Current Profile <br>
										<img src="<?php echo $staffprofile ?>" width="100px" height="100px">








										<script>
											<?php
											include('js/selectedBanner.js');
											?>
										</script>

										<div class="text-center mt-3">
											<button name="btnregister" class="btn btn-lg btn-primary">Register</button>
											<button name="btnregister" class="btn btn-lg btn-primary">Back</button>
											<input type="reset" class="btn btn-lg btn-primary" value="Reset">
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