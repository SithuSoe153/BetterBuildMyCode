<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$indexphpans = "active";
include('../../connect.php');
include('sheader.php');

if (!isset($_SESSION['sid'])) {
	echo "<script>alert('Pls Login Again')</script>";
	// echo "<script>window.location='pages-sign-in.php'</script>";
	echo "<script>window.location='staffLogin.php'</script>";
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


<form action="index.php" method="post">

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

				<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

				<div class="row">
					<div class="col-xl-6 col-xxl-5 d-flex">
						<div class="w-100">
							<div class="row">
								<div class="col-sm-6">
									<div class="card">
										<div class="card-body">
											<div class="row">
												<div class="col mt-0">
													<h5 class="card-title">Pending Orders</h5>
												</div>

												<div class="col-auto">
													<div class="stat text-primary">

														<?php
														$ex = "SELECT * FROM orders WHERE orderstatus='Pending'";
														$resultt = mysqli_query($connection, $ex);
														$rows = mysqli_num_rows($resultt);
														echo $rows;

														?>
													</div>
												</div>
											</div>
											<h4 class="mt-1 mb-3">

												<?php

												$ex = "SELECT * FROM orders WHERE orderstatus='Pending' LIMIT 2";
												$query = mysqli_query($connection, $ex);
												$count = mysqli_num_rows($query);

												if ($count > 0) {
													for ($i = 0; $i < $count; $i++) {
														$data = mysqli_fetch_array($query);
														$orderid = $data['orderid'];

														echo "-" . " " . $orderid . "<br>";
													}
													echo "-" . " " . " ... ";
												} else {
													echo "-";
												}
												?>

											</h4>

										</div>
									</div>
									<div class="card">
										<div class="card-body">
											<div class="row">
												<div class="col mt-0">
													<h5 class="card-title">Out Of Stock Products</h5>
												</div>

												<div class="col-auto">
													<div class="stat text-primary">
														<?php

														$ex = "SELECT * FROM product WHERE unitquantity= '0' ";
														$resultt = mysqli_query($connection, $ex);
														$rows = mysqli_num_rows($resultt);
														echo $rows;

														?>
													</div>
												</div>

											</div>
											<h4 class="mt-1 mb-3">

												<?php

												$ex = "SELECT * FROM product WHERE unitquantity= '0' LIMIT 2";
												$query = mysqli_query($connection, $ex);
												$count = mysqli_num_rows($query);

												if ($count > 0) {
													for ($i = 0; $i < $count; $i++) {
														$data = mysqli_fetch_array($query);
														$productname = $data['productname'];

														echo "-" . " " . $productname . "<br>";
													}
													echo "-" . " " . " ... ";
												} else {
													echo "-";
												}
												?>

											</h4>

										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="card">
										<div class="card-body">
											<div class="row">
												<div class="col mt-0">
													<h5 class="card-title">Pending Purchase</h5>
												</div>

												<div class="col-auto">
													<div class="stat text-primary">
														<?php
														$ex = "SELECT * FROM purchase WHERE purchasestatus='Pending'";
														$resultt = mysqli_query($connection, $ex);
														$rows = mysqli_num_rows($resultt);
														echo $rows;

														?>
													</div>
												</div>
											</div>
											<h4 class="mt-1 mb-3">

												<?php

												$ex = "SELECT * FROM purchase WHERE purchasestatus='Pending' LIMIT 2";
												$query = mysqli_query($connection, $ex);
												$count = mysqli_num_rows($query);

												if ($count > 0) {
													for ($i = 0; $i < $count; $i++) {
														$data = mysqli_fetch_array($query);
														$purchaseid = $data['purchaseid'];

														echo "-" . " " . $purchaseid . "<br>";
													}
													echo "-" . " " . " ... ";
												} else {
													echo "-";
												}
												?>

											</h4>

										</div>
									</div>
									<div class="card">
										<div class="card-body">
											<div class="row">
												<div class="col mt-0">
													<h5 class="card-title">Orders</h5>
												</div>

												<div class="col-auto">
													<div class="stat text-primary">
														<i class="align-middle" data-feather="shopping-cart"></i>
													</div>
												</div>
											</div>
											<h1 class="mt-1 mb-3">64</h1>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-6 col-xxl-7">
						<div class="card flex-fill w-100">
							<div class="card-header">

								<h5 class="card-title mb-0">Recent Movement</h5>
							</div>
							<div class="card-body py-3">
								<div class="chart chart-sm">
									<canvas id="chartjs-line"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
						<div class="card flex-fill w-100">
							<div class="card-header">

								<h5 class="card-title mb-0">Browser Usage</h5>
							</div>
							<div class="card-body d-flex">
								<div class="align-self-center w-100">
									<div class="py-3">
										<div class="chart chart-xs">
											<canvas id="chartjs-dashboard-pie"></canvas>
										</div>
									</div>

									<table class="table mb-0">
										<tbody>
											<tr>
												<td>Chrome</td>
												<td class="text-end">4306</td>
											</tr>
											<tr>
												<td>Firefox</td>
												<td class="text-end">3801</td>
											</tr>
											<tr>
												<td>IE</td>
												<td class="text-end">1689</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
						<div class="card flex-fill w-100">
							<div class="card-header">

								<h5 class="card-title mb-0">Real-Time</h5>
							</div>
							<div class="card-body px-4">
								<div id="world_map" style="height:350px;"></div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
						<div class="card flex-fill">
							<div class="card-header">

								<h5 class="card-title mb-0">Calendar</h5>
							</div>
							<div class="card-body d-flex">
								<div class="align-self-center w-100">
									<div class="chart">
										<div id="datetimepicker-dashboard"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-lg-8 col-xxl-9 d-flex">
						<div class="card flex-fill">
							<div class="card-header">

								<h5 class="card-title mb-0">Latest Projects</h5>
							</div>
							<table class="table table-hover my-0">
								<thead>
									<tr>
										<th>Name</th>
										<th class="d-none d-xl-table-cell">Start Date</th>
										<th class="d-none d-xl-table-cell">End Date</th>
										<th>Status</th>
										<th class="d-none d-md-table-cell">Assignee</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Project Apollo</td>
										<td class="d-none d-xl-table-cell">01/01/2021</td>
										<td class="d-none d-xl-table-cell">31/06/2021</td>
										<td><span class="badge bg-success">Done</span></td>
										<td class="d-none d-md-table-cell">Vanessa Tucker</td>
									</tr>
									<tr>
										<td>Project Fireball</td>
										<td class="d-none d-xl-table-cell">01/01/2021</td>
										<td class="d-none d-xl-table-cell">31/06/2021</td>
										<td><span class="badge bg-danger">Cancelled</span></td>
										<td class="d-none d-md-table-cell">William Harris</td>
									</tr>
									<tr>
										<td>Project Hades</td>
										<td class="d-none d-xl-table-cell">01/01/2021</td>
										<td class="d-none d-xl-table-cell">31/06/2021</td>
										<td><span class="badge bg-success">Done</span></td>
										<td class="d-none d-md-table-cell">Sharon Lessman</td>
									</tr>
									<tr>
										<td>Project Nitro</td>
										<td class="d-none d-xl-table-cell">01/01/2021</td>
										<td class="d-none d-xl-table-cell">31/06/2021</td>
										<td><span class="badge bg-warning">In progress</span></td>
										<td class="d-none d-md-table-cell">Vanessa Tucker</td>
									</tr>
									<tr>
										<td>Project Phoenix</td>
										<td class="d-none d-xl-table-cell">01/01/2021</td>
										<td class="d-none d-xl-table-cell">31/06/2021</td>
										<td><span class="badge bg-success">Done</span></td>
										<td class="d-none d-md-table-cell">William Harris</td>
									</tr>
									<tr>
										<td>Project X</td>
										<td class="d-none d-xl-table-cell">01/01/2021</td>
										<td class="d-none d-xl-table-cell">31/06/2021</td>
										<td><span class="badge bg-success">Done</span></td>
										<td class="d-none d-md-table-cell">Sharon Lessman</td>
									</tr>
									<tr>
										<td>Project Romeo</td>
										<td class="d-none d-xl-table-cell">01/01/2021</td>
										<td class="d-none d-xl-table-cell">31/06/2021</td>
										<td><span class="badge bg-success">Done</span></td>
										<td class="d-none d-md-table-cell">Christina Mason</td>
									</tr>
									<tr>
										<td>Project Wombat</td>
										<td class="d-none d-xl-table-cell">01/01/2021</td>
										<td class="d-none d-xl-table-cell">31/06/2021</td>
										<td><span class="badge bg-warning">In progress</span></td>
										<td class="d-none d-md-table-cell">William Harris</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-12 col-lg-4 col-xxl-3 d-flex">
						<div class="card flex-fill w-100">
							<div class="card-header">

								<h5 class="card-title mb-0">Monthly Sales</h5>
							</div>
							<div class="card-body d-flex w-100">
								<div class="align-self-center chart chart-lg">
									<canvas id="chartjs-dashboard-bar"></canvas>
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

<div id="piechart">

	<?php
	include('connect.php');

	// jan
	$jan = "SELECT * FROM orders Where orderdate BETWEEN '2022-01-01' AND '2022-01-31'";
	$janquery = mysqli_query($con, $jan);
	$jancount = mysqli_num_rows($janquery);
	$jantotalamount = 0;

	if ($jancount > 0) {

		for ($i = 0; $i < $jancount; $i++) {
			$data = mysqli_fetch_array($janquery);
			$price = $data['totalamount'];
			$jantotalamount = $jantotalamount + $price;
		}
	}
	// 

	// feb
	$feb = "SELECT * FROM orders Where orderdate BETWEEN '2022-02-01' AND '2022-02-28'";
	$febquery = mysqli_query($con, $feb);
	$febcount = mysqli_num_rows($febquery);

	if ($febcount > 0) {

		$febtotalamount = 0;
		for ($i = 0; $i < $febcount; $i++) {
			$data = mysqli_fetch_array($febquery);
			$price = $data['totalamount'];
			$febtotalamount = $febtotalamount + $price;
		}
	}
	// 

	// march
	$march = "SELECT * FROM orders Where orderdate BETWEEN '2022-3-01' AND '2022-03-31'";
	$marchquery = mysqli_query($con, $march);
	$marchcount = mysqli_num_rows($marchquery);
	$marchtotalamount = 0;

	if ($marchcount > 0) {

		for ($i = 0; $i < $marchcount; $i++) {
			$data = mysqli_fetch_array($marchquery);
			$price = $data['totalamount'];
			$marchtotalamount = $marchtotalamount + $price;
		}
	}
	// 

	// april
	$april = "SELECT * FROM orders Where orderdate BETWEEN '2022-04-01' AND '2022-04-29'";
	$aprilquery = mysqli_query($con, $april);
	$aprilcount = mysqli_num_rows($aprilquery);
	$apriltotalamount = 0;

	if ($aprilcount > 0) {

		for ($i = 0; $i < $aprilcount; $i++) {
			$data = mysqli_fetch_array($aprilquery);
			$price = $data['totalamount'];
			$apriltotalamount = $apriltotalamount + $price;
		}
	}
	// 

	// may
	$may = "SELECT * FROM orders Where orderdate BETWEEN '2022-05-01' AND '2022-05-30'";
	$mayquery = mysqli_query($con, $may);
	$maycount = mysqli_num_rows($mayquery);
	$maytotalamount = 0;

	if ($maycount > 0) {
		for ($i = 0; $i < $maycount; $i++) {
			$data = mysqli_fetch_array($mayquery);
			$price = $data['totalamount'];
			$maytotalamount = $maytotalamount + $price;
		}
	}

	// 

	// june
	$june = "SELECT * FROM orders Where orderdate BETWEEN '2022-06-01' AND '2022-06-30'";
	$junequery = mysqli_query($con, $june);
	$junecount = mysqli_num_rows($junequery);
	$junetotalamount = 0;

	if ($junecount > 0) {

		for ($i = 0; $i < $junecount; $i++) {
			$data = mysqli_fetch_array($junequery);
			$price = $data['totalamount'];
			$junetotalamount = $junetotalamount + $price;
		}
	}
	// 

	// july
	$july = "SELECT * FROM orders Where orderdate BETWEEN '2022-07-01' AND '2022-07-29'";
	$julyquery = mysqli_query($con, $july);
	$julycount = mysqli_num_rows($julyquery);
	$julytotalamount = 0;

	if ($julycount > 0) {

		for ($i = 0; $i < $julycount; $i++) {
			$data = mysqli_fetch_array($julyquery);
			$price = $data['totalamount'];
			$julytotalamount = $julytotalamount + $price;
		}
	}
	// 

	// august
	$august = "SELECT * FROM orders Where orderdate BETWEEN '2022-07-01' AND '2022-07-31'";
	$augustquery = mysqli_query($con, $august);
	$augustcount = mysqli_num_rows($augustquery);
	$augusttotalamount = 0;

	if ($augustcount > 0) {

		for ($i = 0; $i < $augustcount; $i++) {
			$data = mysqli_fetch_array($augustquery);
			$price = $data['totalamount'];
			$augusttotalamount = $augusttotalamount + $price;
		}
	}
	// 

	// september
	$september = "SELECT * FROM orders Where orderdate BETWEEN '2022-09-01' AND '2022-09-30'";
	$septemberquery = mysqli_query($con, $september);
	$septembercount = mysqli_num_rows($septemberquery);
	$septembertotalamount = 0;

	if ($septembercount > 0) {

		for ($i = 0; $i < $septembercount; $i++) {
			$data = mysqli_fetch_array($septemberquery);
			$price = $data['totalamount'];
			$septembertotalamount = $septembertotalamount + $price;
		}
	}
	// 

	// october
	$october = "SELECT * FROM orders Where orderdate BETWEEN '2022-10-01' AND '2022-10-31'";
	$octoberquery = mysqli_query($con, $october);
	$octobercount = mysqli_num_rows($octoberquery);
	$octobertotalamount = 0;

	if ($octobercount > 0) {

		for ($i = 0; $i < $octobercount; $i++) {
			$data = mysqli_fetch_array($octoberquery);
			$price = $data['totalamount'];
			$octobertotalamount = $octobertotalamount + $price;
		}
	}
	// 

	// november
	$november = "SELECT * FROM orders Where orderdate BETWEEN '2022-11-01' AND '2022-11-30'";
	$novemberquery = mysqli_query($con, $november);
	$novembercount = mysqli_num_rows($novemberquery);
	$novembertotalamount = 0;

	if ($novembercount > 0) {

		for ($i = 0; $i < $novembercount; $i++) {
			$data = mysqli_fetch_array($novemberquery);
			$price = $data['totalamount'];
			$novembertotalamount = $novembertotalamount + $price;
		}
	}
	// 

	// december
	$december = "SELECT * FROM orders Where orderdate BETWEEN '2022-12-01' AND '2022-12-31'";
	$decemberquery = mysqli_query($con, $december);
	$decembercount = mysqli_num_rows($decemberquery);
	$decembertotalamount = 0;

	if ($decembercount > 0) {

		for ($i = 0; $i < $decembercount; $i++) {
			$data = mysqli_fetch_array($decemberquery);
			$price = $data['totalamount'];
			$decembertotalamount = $decembertotalamount + $price;
		}
	}
	// 


	?>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Line chart

			new Chart(document.getElementById("chartjs-line"), {

				type: "line",

				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "Sales ($)",
						fill: true,
						backgroundColor: "transparent",
						borderColor: window.theme.primary,
						data: ["<?php echo $jantotalamount; ?>", "<?php echo $febtotalamount; ?>", "<?php echo $marchtotalamount; ?>", "<?php echo $apriltotalamount; ?>", "<?php echo $maytotalamount; ?>", "<?php echo $junetotalamount; ?>", "<?php echo $julytotalamount; ?>", "<?php echo $augusttotalamount; ?>", "<?php echo $septembertotalamount; ?>", "<?php echo $octobertotalamount; ?>", "<?php echo $novembertotalamount; ?>", "<?php echo $decembertotalamount; ?>"]
					}, {
						label: "Last year ($)",
						fill: true,
						backgroundColor: "transparent",
						borderColor: "#adb5bd",
						borderDash: [4, 4],
						data: [958, 850000, 629, 1500000, 2000000, 1000000, 50000, 50000, 1800000, 1800000, 990000, 1827000]
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.05)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 500
							},
							display: true,
							borderDash: [5, 5],
							gridLines: {
								color: "rgba(0,0,0,0)",
								fontColor: "#fff"
							}
						}]
					}
				}
			});
		});
	</script>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Pie chart
		new Chart(document.getElementById("chartjs-dashboard-pie"), {
			type: "pie",
			data: {
				labels: ["Chrome", "Firefox", "IE"],
				datasets: [{
					data: [4306, 3801, 1689],
					backgroundColor: [
						window.theme.primary,
						window.theme.warning,
						window.theme.danger
					],
					borderWidth: 5
				}]
			},
			options: {
				responsive: !window.MSInputMethodContext,
				maintainAspectRatio: false,
				legend: {
					display: false
				},
				cutoutPercentage: 75
			}
		});
	});
</script>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Bar chart
		new Chart(document.getElementById("chartjs-dashboard-bar"), {
			type: "bar",
			data: {
				labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
				datasets: [{
					label: "This year",
					backgroundColor: window.theme.primary,
					borderColor: window.theme.primary,
					hoverBackgroundColor: window.theme.primary,
					hoverBorderColor: window.theme.primary,
					data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
					barPercentage: .75,
					categoryPercentage: .5
				}]
			},
			options: {
				maintainAspectRatio: false,
				legend: {
					display: false
				},
				scales: {
					yAxes: [{
						gridLines: {
							display: false
						},
						stacked: false,
						ticks: {
							stepSize: 20
						}
					}],
					xAxes: [{
						stacked: false,
						gridLines: {
							color: "transparent"
						}
					}]
				}
			}
		});
	});
</script>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		var markers = [{
				coords: [31.230391, 121.473701],
				name: "Shanghai"
			},
			{
				coords: [28.704060, 77.102493],
				name: "Delhi"
			},
			{
				coords: [6.524379, 3.379206],
				name: "Lagos"
			},
			{
				coords: [35.689487, 139.691711],
				name: "Tokyo"
			},
			{
				coords: [23.129110, 113.264381],
				name: "Guangzhou"
			},
			{
				coords: [40.7127837, -74.0059413],
				name: "New York"
			},
			{
				coords: [34.052235, -118.243683],
				name: "Los Angeles"
			},
			{
				coords: [41.878113, -87.629799],
				name: "Chicago"
			},
			{
				coords: [51.507351, -0.127758],
				name: "London"
			},
			{
				coords: [40.416775, -3.703790],
				name: "Madrid "
			}
		];
		var map = new jsVectorMap({
			map: "world",
			selector: "#world_map",
			zoomButtons: true,
			markers: markers,
			markerStyle: {
				initial: {
					r: 9,
					strokeWidth: 7,
					stokeOpacity: .4,
					fill: window.theme.primary
				},
				hover: {
					fill: window.theme.primary,
					stroke: window.theme.primary
				}
			},
			zoomOnScroll: false
		});
		window.addEventListener("resize", () => {
			map.updateSize();
		});
	});
</script>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
		var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
		document.getElementById("datetimepicker-dashboard").flatpickr({
			inline: true,
			prevArrow: "<span title=\"Previous month\">&laquo;</span>",
			nextArrow: "<span title=\"Next month\">&raquo;</span>",
			defaultDate: defaultDate
		});
	});
</script>