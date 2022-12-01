<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$profilephpans = "active";
include('../../connect.php');
include('sheader.php');


if (isset($_POST['btnmessage'])) {
	$messagetitle = $_POST['txtmessagetitle'];
	$messagedescription = $_POST['txtmessagedescription'];
	$date = date('Y-m-d H:i:s');
	$sid = $_SESSION['sid'];
	$messagestatus = 0;

	$select = "SELECT * FROM message";
	$query1 = mysqli_query($connection, $select);

	$insert = "INSERT INTO message
        (staffid,messagedate,message_title,messagedescription,message_status) 
        VALUES
        ('$sid','$date','$messagetitle','$messagedescription','$messagestatus')";
	$query = mysqli_query($connection, $insert);
	if ($query) {
		echo "<script>alert('Message Sent Successfully')</script>";
	}
}



?>

<form action="pages-profile.php" method="post">

	<script>
		<?php
		include('js/allcount.js');
		?>
	</script>

	<?php
	include('nav.php');
	?>

	<div class="main">
		<main class="content">
			<div class="container-fluid p-0">

				<div class="row">
					<div class="col-md-4 col-xl-3">
						<div class="card mb-3">
							<div class="card-header">
								<h5 class="card-title mb-0">Profile Details</h5>
							</div>

							<div class="card-body text-center">
								<img src="<?php echo $staffprofile ?>" class="img-fluid rounded-circle mb-2" width="128" height="128" />
								<h5 class="card-title mb-0"><?php echo $staffname ?></h5>
								<div class="text-muted mb-2"><?php echo $staffrole ?></div>

								<div>
									<a class="btn btn-primary btn-sm" href="staffUpdate.php"> Update</a>
									<a class="btn btn-primary btn-sm" href="staffLogout.php"> Log Out</a>
								</div>
							</div>

							<?php

							$select = "SELECT * FROM staff where staffid = '$sid' AND staffrole='Staff Manager'";
							$query = mysqli_query($connection, $select);
							$count = mysqli_num_rows($query);

							if ($count > 0) {
								echo " <hr class='my-0' /> ";
								echo " <div class='card-body'> ";
								echo "<h5 class='h6 card-title'>Create new Staff</h5> ";
								echo "<a class='btn btn-primary btn-sm' href='staffSignup.php'> Create Staff</a>";
								echo " </ul> ";
								echo " </div> ";
							}

							?>

							<hr class="my-0" />
							<div class="card-body">
								<h5 class="h6 card-title">Send Message</h5>

								<script type="text/javascript">
									$(function() {
										$("input[name=btnsendmessage]").click(function() {
											if ($(this).val() == "Send Message") {
												$("#divmessage").show();
											} else {
												$("#divmessage").hide();
											}
										});
									});
								</script>

								<input class='btn btn-primary btn-sm' type="button" value="Send Message" name="btnsendmessage" />
								<div id="divmessage" style="display: none"><br>

									<label class="form-label">Message Title :</label>
									<input type="text" class="form-control" name="txtmessagetitle" /><br>

									<label class="form-label">Message Description :</label>
									<input type="text" class="form-control" name="txtmessagedescription" /><br>

									<button class='btn btn-primary btn-sm' name="btnmessage">Send</button>
									<!-- <input class='btn btn-primary btn-sm' type="button" value="Send" name="btnmessage" /> -->
									<input class="btn btn-primary btn-sm" type="button" value="Cancel" name="btnsendmessage" />

								</div>


							</div>

							<hr class="my-0" />
							<div class="card-body">
								<h5 class="h6 card-title">Skills</h5>

								<?php
								for ($i = 0; $i < count($staffskills); $i++) {
									echo "<a href='#' class='badge bg-primary me-1 my-1'>" . $staffskills[$i] . "</a>";
								}

								?>


							</div>


							<hr class="my-0" />
							<div class="card-body">
								<h5 class="h6 card-title">About</h5>
								<ul class="list-unstyled mb-0">
									<li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Lives
										in <a href="#">
											<?php echo $address ?>
										</a></li>
								</ul>
							</div>

							<hr class="my-0" />
						</div>
					</div>

					<div class="col-md-8 col-xl-9">
						<div class="card">
							<div class="card-header">

								<h5 class="card-title mb-0">Activities</h5>
							</div>
							<div class="card-body h-100">

							</div>
						</div>
					</div>
				</div>

			</div>
		</main>
</form>

<?php

include('sfooter.php');

?>