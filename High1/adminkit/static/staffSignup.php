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
	$staffname = $_POST['staffname'];
	$staffemail = $_POST['staffemail'];
	$staffrole = $_POST['staffrole'];
	$staffskills = $_POST['staffskills'];
	$password = $_POST['password'];
	$phonenumber = $_POST['phonenumber'];
	$address = $_POST['rawdes'];


	//////////////////////////////////Image/////////////////////////////////

	$Image = $_FILES['staffprofile']['name'];
	$Folder = "images/";
	$filename = $Folder . '_' . $Image;
	$image = copy($_FILES['staffprofile']['tmp_name'], $filename);
	if (!$image) {
		echo "<p>Cannot Upload  Staff Profile</p>";
		exit();
	}

	/////////////////////////////////////////////////////////////////////////


	$select = "SELECT * FROM staff where staffemail='$staffemail'";
	$query1 = mysqli_query($connection, $select);
	$count = mysqli_num_rows($query1);
	if ($count > 0) {
		echo "<script>alert('Duplicate Staff')</script>";
	} else {

		$insert = "INSERT INTO staff
        (staffname,staffemail,staffrole,staffskill,password,phonenumber,address,staffprofile) 
        VALUES
        ('$staffname','$staffemail','$staffrole','$staffskills','$password','$phonenumber','$address','$filename')";
		$query = mysqli_query($connection, $insert);
		if ($query) {
			echo "<script>alert('Staff Register Successfully')</script>";
			echo "<script>window.location='pages-profile.php'</script>";
		}
	}
}

?>

<form action="staffSignup.php" method="post" enctype="multipart/form-data">

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
								<h1 class="h2">Sign Up</h1>
								<p class="lead">
									Create New Staff Here !
								</p>
							</div>

							<div class="card">
								<div class="card-body">
									<div class="m-sm-4">

										<div class="mb-3">
											<label class="form-label">Staff Name</label>
											<input class="form-control form-control-lg" type="text" required name="staffname" placeholder="Enter New Staff Name" />
										</div>

										<div class="mb-3">
											<label class="form-label">Staff Role</label>
											<input class="form-control form-control-lg" type="text" required name="staffrole" placeholder="Staff Role" />
										</div>

										<div class="mb-3">
											<label class="form-label">Staff Skills</label>
											<input class="form-control form-control-lg" type="text" required name="staffskills" placeholder="Staff Skills" />
										</div>

										<div class="mb-3">
											<label class="form-label">Staff Email</label>
											<input class="form-control form-control-lg" type="email" required name="staffemail" placeholder="Enter Staff Email" />
										</div>

										<div class="mb-3">
											<label class="form-label">Phone Number</label>
											<input class="form-control form-control-lg" type="text" required name="phonenumber" placeholder="(+95) / (09) 000 000 0000" />
										</div>

										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" required name="password" placeholder="Password" />
										</div>

										<div class="mb-3">
											<label class="form-label">Address</label>
											<textarea name="rawdes" class="form-control" rows="2" placeholder="Address" required></textarea>
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

										<script>
											<?php
											include('js/selectedBanner.js');
											?>
										</script>

										<div class="text-center mt-3">
											<button name="btnregister" class="btn btn-lg btn-primary">Register</button>
											<a href="pages-profile.php" class="btn btn-lg btn-primary">Back</a>

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