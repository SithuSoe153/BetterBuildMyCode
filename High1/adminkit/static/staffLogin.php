<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../../connect.php');

if (isset($_POST['btnlogin'])) {
	$email = $_POST['txtemail'];
	$password = $_POST['txtpassword'];

	$select = "SELECT * FROM staff where staffemail='$email' and password='$password'";
	$query = mysqli_query($connection, $select);
	$count = mysqli_num_rows($query);
	if ($count > 0) {

		$data = mysqli_fetch_array($query);
		$staffid = $data['staffid'];
		$staffname = $data['staffname'];
		$staffmail = $data['staffemail'];

		$_SESSION['sid'] = $staffid;
		$_SESSION['sname'] = $staffname;
		$_SESSION['smail'] = $staffmail;

		echo "<script>alert('Staff Login Successful')</script>";
		echo "<script>window.location='index.php'</script>";
	} else {
		echo "<script>alert('Invalid Staff Login')</script>";
		// echo "<script>window.location='staffloginraw.php'</script>";
		echo "<script>window.location='staffLogin.php'</script>";
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>Sign In | AdminKit Demo</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Welcome back, Charles</h1>
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">

									<form action="staffLogin.php" method="post">
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="txtemail" placeholder="Enter your email" required />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="txtpassword" placeholder="Enter your password" required />
											<small>
												<a href="index.html">Forgot password?</a>
											</small>
										</div>
										<div>
											<label class="form-check">
												<input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" checked>
												<span class="form-check-label">
													Remember me next time
												</span>
											</label>
										</div>
										<div class="text-center mt-3">
											<input class="btn btn-lg btn-primary" type="submit" name="btnlogin" value="Login">
											<!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
										</div>
									</form>
								</div>
							</div>
						</div>

						<?php
						$select = "SELECT * FROM staff Where staffrole = 'Staff Manager'";
						$query = mysqli_query($connection, $select);
						$count = mysqli_num_rows($query);
						$data = mysqli_fetch_array($query);
						$managerm = $data['staffemail'];
						$managerp = $data['password'];

						?>

						Staff Manager Level <br>
						<h5>Gmail = <?php echo $managerm; ?></h5>
						<h5>Password = <?php echo $managerp; ?></h5>
						<p></p>


						<?php
						$select = "SELECT * FROM staff Where staffrole = 'Staff'";
						$query = mysqli_query($connection, $select);
						$count = mysqli_num_rows($query);
						$data = mysqli_fetch_array($query);
						$staffm = $data['staffemail'];
						$staffp = $data['password'];

						?>

						Staff Level <br>
						<h5>Gmail = <?php echo $staffm; ?></h5>
						<h5>Password = <?php echo $staffp; ?></h5>
						<p></p>



						<?php
						$select = "SELECT * FROM staff Where staffrole = 'Delivery'";
						$query = mysqli_query($connection, $select);
						$count = mysqli_num_rows($query);
						$data = mysqli_fetch_array($query);
						$deliverym = $data['staffemail'];
						$deliveryp = $data['password'];

						?>

						Delivery Man Level <br>
						<h5>Gmail = <?php echo $deliverym; ?></h5>
						<h5>Password = <?php echo $deliveryp; ?></h5>
						<p></p>


					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>

</body>

</html>