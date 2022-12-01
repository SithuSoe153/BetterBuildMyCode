<?php
include('connect.php');
include('header.php');

if (isset($_REQUEST['sid'])) {
	$sid = $_REQUEST['sid'];
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
		$staffprofile = $data['staffprofile'];
	}
}

if (isset($_POST['btncancel'])) {
	echo "<script>window.location='stafflist.php'</script>";
}

if (isset($_POST['btnupdate'])) {
	$txtstaffid = $_POST['txtstaffid'];
	$txtstaffname = $_POST['txtstaffname'];
	$txtstaffemail = $_POST['txtstaffemail'];
	$txtpassword = $_POST['txtpassword'];
	$txtphonenumber = $_POST['txtphonenumber'];
	$txtaddress = $_POST['txtaddress'];


	//////////////////////////////////Image/////////////////////////////////

	$Image = $_FILES['txtprofile']['name'];
	$Folder = "image/";
	$filename = $Folder . '_' . $Image;
	$image = copy($_FILES['txtprofile']['tmp_name'], $filename);
	if (!$image) {
		echo "<p>Cannot Upload  Staff Profile</p>";
		exit();
	}

	/////////////////////////////////////////////////////////////////////////

	$update = "UPDATE staff set 
	staffname='$txtstaffname',staffemail='$txtstaffemail',password='$txtpassword',phonenumber='$txtphonenumber',
	address='$txtaddress',staffprofile='$filename'
	where staffid='$txtstaffid'";
	$query = mysqli_query($connection, $update);
	if ($query) {
		echo "<script>alert('Staff Update Successfully')</script>";
		echo "<script>window.location='stafflist.php'</script>";
	}
}
?>


<!--====== TITLE PART START ======-->

<title>Better Build - Furniture and Decor Website Template</title>

<!--====== CONTACT PART START ======-->

<section id="contact" class="contact-area pt-115">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<div class="contact-title text-center">
					<h2 class="title">Staff Update Form</h2>
				</div> <!-- contact title -->
			</div>
		</div> <!-- row -->
		<div class="contact-box mt-70">
			<div class="row">

				<div class="col-lg-12">
					<div class="contact-form">
						<form action="updatestaff.php" method="post" enctype="multipart/form-data">
							<div class="row">

								<div class="col-lg-6">
									<div>
										<label>Staff Profile</label>
										<div><input type="file" name=" txtprofile" required></div>
										<img class="single" src="<?php echo $staffprofile ?>" width="180px">
										<div class="help-block with-errors"></div>
									</div> <!-- single form -->
								</div>
								<div class="col-lg-6"></div>


								<div class="col-lg-6">
									<div class="single-form form-group">
										<label>Staff Name</label>
										<input type="hidden" name="txtstaffid" value="<?php echo $staffid ?>">
										<input type="text" name="txtstaffname" required value="<?php echo $staffname ?>">
										<div class="help-block with-errors"></div>
									</div> <!-- single form -->
								</div>

								<div class="col-lg-6">
									<div class="single-form form-group">
										<label>Staff email</label>
										<input type="text" name="txtstaffemail" required value="<?php echo $staffemail ?>">
										<div class="help-block with-errors"></div>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="single-form form-group">
										<label>Ph No.</label>
										<input type="text" name="txtphonenumber" required value="<?php echo $phonenumber ?>">
										<div class="help-block with-errors"></div>
									</div> <!-- single form -->
								</div>
								<div class="col-lg-6">
									<div class="single-form form-group">
										<label>Password</label>
										<input type="password" name="txtpassword" required value="<?php echo $password ?>">
										<div class="help-block with-errors"></div>
									</div> <!-- single form -->
								</div>
								<div class="col-lg-12">
									<div class="single-form form-group">
										<label>Address</label>
										<textarea name="txtaddress" cols="30"> <?php echo $address ?> </textarea>
										<div class="help-block with-errors"></div>
									</div> <!-- single form -->
								</div>


								<p class="form-message"></p>
								<div class="col-lg-12">
									<div class="single-form form-group">
										<button name="btnupdate" class="main-btn" type="submit">Update</button>
										<a href='stafflist.php' class='main-btn'> Cancel </a>
									</div>
								</div>
							</div>
					</div> <!-- row -->
					</form>
				</div> <!-- row -->
			</div>
		</div> <!-- row -->
	</div> <!-- contact box -->
	</div> <!-- container -->
</section>

<!--====== CONTACT PART ENDS ======-->



<?php
include('footer.php');
?>




<!--====== jquery js ======-->
<script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
<script src="assets/js/vendor/jquery-1.12.4.min.js"></script>

<!--====== Bootstrap js ======-->
<script src="assets/js/bootstrap.min.js"></script>


<!--====== Slick js ======-->
<script src="assets/js/slick.min.js"></script>

<!--====== Magnific Popup js ======-->
<script src="assets/js/jquery.magnific-popup.min.js"></script>


<!--====== nav js ======-->
<script src="assets/js/jquery.nav.js"></script>

<!--====== Nice Number js ======-->
<script src="assets/js/jquery.nice-number.min.js"></script>

<!--====== Main js ======-->
<script src="assets/js/main.js"></script>

</body>

</html>