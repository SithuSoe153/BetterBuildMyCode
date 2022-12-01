<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$categoryphpans = "active";
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
	$categoryname = $_POST['categoryname'];

	$select = "SELECT * FROM category where categoryname ='$categoryname'";
	$query1 = mysqli_query($connection, $select);
	$count = mysqli_num_rows($query1);
	if ($count > 0) {
		$alert = 'Duplicate Category Name.\nYour registered ( ';
		$alert .= $categoryname;
		$alert .= ' ) is already inside the category the data base.';

		echo "<script>alert(\"$alert\")</script>";
	} else {
		$insert = "INSERT INTO category
        (categoryname)
        VALUES
        ('$categoryname')";
		$query = mysqli_query($connection, $insert);
		if ($query) {
			echo "<script>alert('Category Save Successful!')</script>";
		}
	}
}

?>

<form action="category.php" method="post">

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
								<h1 class="h2">Categories</h1>
								<p class="lead">
									Insert New Category Here !
								</p>
							</div>

							<div class="card">
								<div class="card-body">
									<div class="m-sm-4">
										<form>
											<div class="mb-3">
												<label class="form-label">Category Name</label>
												<input class="form-control form-control-lg" type="text" name="categoryname" placeholder="Enter New Category Name" />
											</div>

											<div class="text-center mt-3">
												<button name="btnregister" class="btn btn-lg btn-primary">Register</button>
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