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

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-profile.php" />

	<title>Profile | AdminKit Demo</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="css/mystyle.css" rel="stylesheet">
	<link href="css/count.css" rel="stylesheet">

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css?v=7857324">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
					<span class="align-middle">Better Build <br> (Admin Dashboard)</span>
				</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="sidebar-item <?php echo $indexphpans ?>">
						<a class="sidebar-link" href="index.php">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>


					<li class="sidebar-item <?php echo $profilephpans ?>">
						<a class="sidebar-link" href="pages-profile.php">
							<i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
						</a>
					</li>

					<li class="sidebar-item <?php echo $orderReportphpans ?>">
						<a class="sidebar-link" href="orderReport.php">
							<i class="align-middle" data-feather="link"></i>
							<span class="align-middle">Order Report</span>
						</a>
					</li>

					<li class="sidebar-item <?php echo $categoryphpans ?>">
						<a class="sidebar-link" href="category.php">
							<i class="align-middle" data-feather="grid"></i>
							<span class="align-middle">Category</span>
						</a>
					</li>

					<li class="sidebar-item <?php echo $productphpans ?>">
						<a class="sidebar-link" href="product.php">
							<i class="align-middle" data-feather="feather"></i>
							<span class="align-middle">Product</span>
						</a>
					</li>

					<li class="sidebar-item <?php echo $itemphpans ?>">
						<a class="sidebar-link" href="item.php">
							<i class="align-middle" data-feather="layout"></i>
							<span class="align-middle">Item</span>
						</a>
					</li>

					<li class="sidebar-item <?php echo $productionphpans ?>">
						<a class="sidebar-link" href="production.php">
							<i class="align-middle" data-feather="feather"></i>
							<span class="align-middle">Production</span>
						</a>
					</li>

					<li class="sidebar-item <?php echo $supplierphpans ?>">
						<a class="sidebar-link" href="supplier.php">
							<i class="align-middle" data-feather="truck"></i>
							<span class="align-middle">Supplier</span>
						</a>
					</li>

					<li class="sidebar-item <?php echo $rawphpans ?>">
						<a class="sidebar-link" href="raw.php">
							<i class="align-middle" data-feather="layers"></i>
							<span class="align-middle">Raw</span>
						</a>
					</li>

					<li class="sidebar-item <?php echo $purchasephpans ?>">
						<a class="sidebar-link" href="purchase.php">
							<i class="align-middle" data-feather="shopping-cart"></i>
							<span class="align-middle">Purchase <span class="text-muted">(Raw)</span></span>
						</a>
					</li>

					<li class="sidebar-item <?php echo $purchaseReportphpans ?>">
						<a class="sidebar-link" href="purchaseReport.php">
							<i class="align-middle" data-feather="shopping-cart"></i>
							<span class="align-middle">Purchase Report</span>
						</a>
					</li>

					<li class="sidebar-item <?php echo $deliveryphpans ?>">
						<a class="sidebar-link" href="delivery.php">
							<i class="align-middle" data-feather="map-pin"></i>
							<span class="align-middle">Delivery</span>
						</a>
					</li>

					<li class="sidebar-item <?php echo $staffLogoutphpans ?>">
						<a class="sidebar-link" href="staffLogout.php">
							<i class="align-middle" data-feather="log-out"></i>
							<span class="align-middle">Logout</span>
						</a>
					</li>



				</ul>


			</div>
		</nav>