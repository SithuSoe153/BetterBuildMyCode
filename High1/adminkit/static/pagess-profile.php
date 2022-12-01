<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ../../

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

?>

<style>
	.count {
		text-align: center;
		padding-left: 28px;
		padding-bottom: 20px;
		position: absolute;
		font-size: 11px;
		color: white;
		top: 1.9px;
		right: -2.2px;
		display: flex;
	}

	.count:hover {
		/* position: absolute; */
		top: -2px;
		transition-duration: 0.1s;

	}
</style>

<form action="pages-profile.php" method="post">
	<script>
		$(document).ready(function() {
			$("#div_refresh1").load("load.php");
			setInterval(function() {
				$("#div_refresh1").load("load.php");
			}, 1000);
		});
	</script>
	<div class="main">
		<nav class="navbar navbar-expand navbar-light navbar-bg">
			<a class="sidebar-toggle js-sidebar-toggle">
				<i class="hamburger align-self-center"></i>
			</a>

			<div class="navbar-collapse collapse">
				<ul class="navbar-nav navbar-align">
					<li class="nav-item dropdown">


						<a id="dropdownn-toggle" class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
							<div id="div_refresh" class="position-relative">
								<div id="div_refresh1">
								</div>
								<span class='count'></span>
								<!-- <span class='indicator count'></span> -->
								<span class='align-middle' data-feather='bell'></span>
							</div>
						</a>


						<div id="dropdownn-menu" class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">

						</div>


					</li>


					<!-- /////////////////////////////////////////////////////////  -->

					<script>
						$(document).ready(function() {

							function load_unseen_notification(view = '') {
								$.ajax({
									url: "fetch.php",
									method: "POST",
									data: {
										view: view
									},
									dataType: "json",
									success: function(data) {
										$('#dropdownn-menu').html(data.notification);
										if (data.unseen_notification > 0) {
											$('.count').html(data.unseen_notification);
										}
									}
								});
							}

							load_unseen_notification();

							// $('#comment_form').on('submit', function(event) {
							// 	event.preventDefault();
							// 	if ($('#subject').val() != '' && $('#comment').val() != '') {
							// 		var form_data = $(this).serialize();
							// 		$.ajax({
							// 			url: "insert.php",
							// 			method: "POST",
							// 			data: form_data,
							// 			success: function(data) {
							// 				$('#comment_form')[0].reset();
							// 				load_unseen_notification();
							// 			}
							// 		});
							// 	} else {
							// 		alert("Both Fields are Required");
							// 	}
							// });

							$(document).on('click', '#dropdownn-toggle', function() {
								$('.count').html('');
								load_unseen_notification('yes');
							});

							setInterval(function() {
								load_unseen_notification();;
							}, 3000);
						});
					</script>



					<!-- /////////////////////////////////////////////////////////  -->

					<li class="nav-item dropdown">
						<a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
							<div class="position-relative">
								<i class="align-middle" data-feather="message-square"></i>
							</div>
						</a>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
							<div class="dropdown-menu-header">
								<div class="position-relative">
									4 New Messages
								</div>
							</div>
							<div class="list-group">
								<a href="#" class="list-group-item">
									<div class="row g-0 align-items-center">
										<div class="col-2">
											<img src="img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
										</div>
										<div class="col-10 ps-2">
											<div class="text-dark">Vanessa Tucker</div>
											<!-- /////////////////////////////////////////////////////////  -->
											<div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu
												tortor.</div>
											<div class="text-muted small mt-1">15m ago</div>
										</div>
									</div>
								</a>
								<a href="#" class="list-group-item">
									<div class="row g-0 align-items-center">
										<div class="col-2">
											<img src="img/avatars/avatar-2.jpg" class="avatar img-fluid rounded-circle" alt="William Harris">
										</div>
										<div class="col-10 ps-2">
											<div class="text-dark">William Harris</div>
											<div class="text-muted small mt-1">Curabitur ligula sapien euismod
												vitae.</div>
											<div class="text-muted small mt-1">2h ago</div>
										</div>
									</div>
								</a>
								<a href="#" class="list-group-item">
									<div class="row g-0 align-items-center">
										<div class="col-2">
											<img src="img/avatars/avatar-4.jpg" class="avatar img-fluid rounded-circle" alt="Christina Mason">
										</div>
										<div class="col-10 ps-2">
											<div class="text-dark">Christina Mason</div>
											<div class="text-muted small mt-1">Pellentesque auctor neque nec urna.
											</div>
											<div class="text-muted small mt-1">4h ago</div>
										</div>
									</div>
								</a>
								<a href="#" class="list-group-item">
									<div class="row g-0 align-items-center">
										<div class="col-2">
											<img src="img/avatars/avatar-3.jpg" class="avatar img-fluid rounded-circle" alt="Sharon Lessman">
										</div>
										<div class="col-10 ps-2">
											<div class="text-dark">Sharon Lessman</div>
											<div class="text-muted small mt-1">Aenean tellus metus, bibendum sed,
												posuere ac, mattis non.</div>
											<div class="text-muted small mt-1">5h ago</div>
										</div>
									</div>
								</a>
							</div>
							<div class="dropdown-menu-footer">
								<a href="#" class="text-muted">Show all messages</a>
							</div>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
							<i class="align-middle" data-feather="settings"></i>
						</a>

						<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
							<img src="<?php echo $staffprofile ?>" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark"> <?php echo $staffname ?> </span>
						</a>
						<div class="dropdown-menu dropdown-menu-end">
							<a class="dropdown-item" href="pages-profile.php"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
							<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="index.php"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
							<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Log out</a>
						</div>
					</li>
				</ul>
			</div>
		</nav>

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
									<a class="btn btn-primary btn-sm" href="#"> Update</a>
									<a class="btn btn-primary btn-sm" href="#"> Log Out</a>
									<button class="btn btn-primary btn-sm" onclick="window.print()">Print this page</button>
								</div>
							</div>

							<?php

							$select = "SELECT * FROM staff where staffid = '$sid' AND staffrole='Manager'";
							$query = mysqli_query($connection, $select);
							$count = mysqli_num_rows($query);

							if ($count > 0) {
								echo " <hr class='my-0' /> ";
								echo " <div class='card-body'> ";
								echo "<h5 class='h6 card-title'>Create new Staff</h5> ";
								echo "<a class='btn btn-primary btn-sm' href='#'> Create Staff</a>";
								echo " </ul> ";
								echo " </div> ";
							}

							?>

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
								<div id="divmessage" style="display: none">
									Message Title :
									<input type="text" name="txtmessagetitle" />
									Message Description :
									<input type="text" name="txtmessagedescription" />

									<button class='btn btn-primary btn-sm' name="btnmessage">Send</button>
									<!-- <input class='btn btn-primary btn-sm' type="button" value="Send" name="btnmessage" /> -->
									<input class="btn btn-primary btn-sm" type="button" value="Cancel" name="btnsendmessage" />

								</div>


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

								<div class="d-flex align-items-start">
									<img src="img/avatars/avatar-5.jpg" width="36" height="36" class="rounded-circle me-2" alt="Vanessa Tucker">
									<div class="flex-grow-1">
										<small class="float-end text-navy">5m ago</small>
										<strong>Vanessa Tucker</strong> started following <strong>Christina
											Mason</strong><br />
										<small class="text-muted">Today 7:51 pm</small><br />

									</div>
								</div>

								<hr />
								<div class="d-flex align-items-start">
									<img src="img/avatars/avatar.jpg" width="36" height="36" class="rounded-circle me-2" alt="Charles Hall">
									<div class="flex-grow-1">
										<small class="float-end text-navy">30m ago</small>
										<strong>Charles Hall</strong> posted something on <strong>Christina
											Mason</strong>'s timeline<br />
										<small class="text-muted">Today 7:21 pm</small>

										<div class="border text-sm text-muted p-2 mt-1">
											Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem
											quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam
											nunc, blandit vel, luctus
											pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt
											tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis
											ante.
										</div>

										<a href="#" class="btn btn-sm btn-danger mt-1"><i class="feather-sm" data-feather="heart"></i> Like</a>
									</div>
								</div>

								<hr />
								<div class="d-flex align-items-start">
									<img src="img/avatars/avatar-4.jpg" width="36" height="36" class="rounded-circle me-2" alt="Christina Mason">
									<div class="flex-grow-1">
										<small class="float-end text-navy">1h ago</small>
										<strong>Christina Mason</strong> posted a new blog<br />

										<small class="text-muted">Today 6:35 pm</small>
									</div>
								</div>

								<hr />
								<div class="d-flex align-items-start">
									<img src="img/avatars/avatar-2.jpg" width="36" height="36" class="rounded-circle me-2" alt="William Harris">
									<div class="flex-grow-1">
										<small class="float-end text-navy">3h ago</small>
										<strong>William Harris</strong> posted two photos on <strong>Christina
											Mason</strong>'s timeline<br />
										<small class="text-muted">Today 5:12 pm</small>

										<div class="row g-0 mt-1">
											<div class="col-6 col-md-4 col-lg-4 col-xl-3">
												<img src="img/photos/unsplash-1.jpg" class="img-fluid pe-2" alt="Unsplash">
											</div>
											<div class="col-6 col-md-4 col-lg-4 col-xl-3">
												<img src="img/photos/unsplash-2.jpg" class="img-fluid pe-2" alt="Unsplash">
											</div>
										</div>

										<a href="#" class="btn btn-sm btn-danger mt-1"><i class="feather-sm" data-feather="heart"></i> Like</a>
									</div>
								</div>

								<hr />
								<div class="d-flex align-items-start">
									<img src="img/avatars/avatar-2.jpg" width="36" height="36" class="rounded-circle me-2" alt="William Harris">
									<div class="flex-grow-1">
										<small class="float-end text-navy">1d ago</small>
										<strong>William Harris</strong> started following <strong>Christina
											Mason</strong><br />
										<small class="text-muted">Yesterday 3:12 pm</small>

										<div class="d-flex align-items-start mt-1">
											<a class="pe-3" href="#">
												<img src="img/avatars/avatar-4.jpg" width="36" height="36" class="rounded-circle me-2" alt="Christina Mason">
											</a>
											<div class="flex-grow-1">
												<div class="border text-sm text-muted p-2 mt-1">
													Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id,
													lorem. Maecenas nec odio et ante tincidunt tempus.
												</div>
											</div>
										</div>
									</div>
								</div>

								<hr />
								<div class="d-flex align-items-start">
									<img src="img/avatars/avatar-4.jpg" width="36" height="36" class="rounded-circle me-2" alt="Christina Mason">
									<div class="flex-grow-1">
										<small class="float-end text-navy">1d ago</small>
										<strong>Christina Mason</strong> posted a new blog<br />
										<small class="text-muted">Yesterday 2:43 pm</small>
									</div>
								</div>

								<hr />
								<div class="d-flex align-items-start">
									<img src="img/avatars/avatar.jpg" width="36" height="36" class="rounded-circle me-2" alt="Charles Hall">
									<div class="flex-grow-1">
										<small class="float-end text-navy">1d ago</small>
										<strong>Charles Hall</strong> started following <strong>Christina
											Mason</strong><br />
										<small class="text-muted">Yesterdag 1:51 pm</small>
									</div>
								</div>

								<hr />
								<div class="d-grid">
									<a href="#" class="btn btn-primary">Load more</a>
								</div>
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