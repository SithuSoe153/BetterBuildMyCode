<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$productphpans = "active";
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
	$productname = $_POST['productname'];
	$categoryid = $_POST['categoryid'];
	$categoryname = $_POST['categoryid'];
	$unitprice = $_POST['unitprice'];
	$unitquantity = 0;
	$productdescription = $_POST['productdescription'];

	//////////////////////////////////Image/////////////////////////////////

	$Image = $_FILES['productprofile']['name'];
	$Folder = "images/";
	$Folder1 = "../../images/";
	$Folder2 = "../../../Raw/images/";
	$filename = $Folder . '_' . $Image;
	$filenamei1 = $Folder1 . '_' . $Image;
	$filenamei2 = $Folder2 . '_' . $Image;
	$image = copy($_FILES['productprofile']['tmp_name'], $filename);
	$image1 = copy($_FILES['productprofile']['tmp_name'], $filenamei1);
	$image2 = copy($_FILES['productprofile']['tmp_name'], $filenamei2);
	if (!$image) {
		echo "<p>Cannot Upload  Product Profile</p>";
		exit();
	}


	/////////////////////////////////////////////////////////////////////////
	//////////////////////////////////3D/////////////////////////////////

	$Product3D = $_FILES['product3D']['name'];
	$Folder = "3D/";
	$Folder1 = "../../3D/";
	$Folder2 = "../../../Raw/3D/";
	$filename3D = $Folder . '_' . $Product3D;
	$filename3D1 = $Folder1 . '_' . $Product3D;
	$filename3D2 = $Folder2 . '_' . $Product3D;
	$product3D = copy($_FILES['product3D']['tmp_name'], $filename3D);
	$product3D1 = copy($_FILES['product3D']['tmp_name'], $filename3D1);
	$product3D2 = copy($_FILES['product3D']['tmp_name'], $filename3D2);
	if (!$product3D) {
		echo "<p>Cannot Upload  Product Profile</p>";
		exit();
	}

	/////////////////////////////////////////////////////////////////////////

	//////////////////////////////////AR/////////////////////////////////

	$ProductAR = $_FILES['productAR']['name'];
	$Folder = "AR/";
	$Folder1 = "../../AR/";
	$Folder2 = "../../../Raw/AR/";
	$filenameAR = $Folder . '_' . $ProductAR;
	$filenameAR1 = $Folder1 . '_' . $ProductAR;
	$filenameAR2 = $Folder2 . '_' . $ProductAR;
	$productAR = copy($_FILES['productAR']['tmp_name'], $filenameAR);
	$productAR1 = copy($_FILES['productAR']['tmp_name'], $filenameAR1);
	$productAR2 = copy($_FILES['productAR']['tmp_name'], $filenameAR2);
	if (!$productAR) {
		echo "<p>Cannot Upload  Product Profile</p>";
		exit();
	}

	/////////////////////////////////////////////////////////////////////////




	$select = "SELECT * FROM product where productname='$productname'";
	$query1 = mysqli_query($connection, $select);
	$count = mysqli_num_rows($query1);
	if ($count > 0) {
		$alert = 'Duplicate Product Name.\nYour registered ( ';
		$alert .= $productname;
		$alert .= ' ) is already inside the Product the data base.';

		echo "<script>alert(\"$alert\")</script>";
	} else {
		$insert = "INSERT INTO product
        (productname,unitprice,unitquantity,productdescription,categoryid,productprofile,3D,AR)
        VALUES
        ('$productname','$unitprice','$unitquantity','$productdescription','$categoryid','$filename','$filename3D','$filenameAR')";
		$query = mysqli_query($connection, $insert);

		if ($query) {
			echo "<script>alert('Product Register Successful!')</script>";
		}
	}
}

?>

<form action="product.php" method="post" enctype="multipart/form-data">

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
								<h1 class="h2">Product</h1>
								<p class="lead">
									Create New Product Here !
								</p>
							</div>

							<div class="card">
								<div class="card-body">
									<div class="m-sm-4">

										<div class="mb-3">
											<label class="form-label">Product Name</label>
											<input class="form-control form-control-lg" type="text" name="productname" placeholder="Enter New Product Name" />
										</div>

										<div class="mb-3">
											<label class="form-label">Category Name</label>
											<?php

											$select = "SELECT * FROM category";
											$query = mysqli_query($connection, $select);
											$count = mysqli_num_rows($query);

											echo "<select name='categoryid' class='form-select mb-3'>";
											echo "<option selected>Select Category Name</option>";
											for ($i = 0; $i < $count; $i++) {
												$data = mysqli_fetch_array($query);
												$categoryid = $data['categoryid'];
												$categoryname = $data['categoryname'];

												echo "<option value='$categoryid'>$categoryname</option>";
											}
											echo "</select>";
											?>
										</div>

										<div class="mb-3">
											<label class="form-label">Product Description</label>
											<textarea name="productdescription" class="form-control" rows="2" placeholder="Description Detail"></textarea>
										</div>

										<div class="mb-3">
											<label class="form-label">Unit Price</label>
											<input class="form-control form-control-lg" type="number" name="unitprice" placeholder="Price MMK" />
										</div>

										<!-- <div class="mb-3">
											<label class="form-label">Unit Quantity</label>
											<input class="form-control form-control-lg" type="number" name="unitquantity" placeholder="Quantity" />
										</div> -->

										<div class="mb-3" style="margin-right: 40%">
											<div class="mb-3" id="selectedBanner" style="margin-left: 52%;margin-bottom: 52%"></div>
											<div class="form-control form-control-lg">
												<div id="forfile">
													<input name="productprofile" class="img" id="file" type="file" accept="image/*" />
													<label for="file">
														<i class="fa fa-image"></i> &nbsp
														Choose Picture
													</label>
												</div>
											</div>
										</div>


										<label for="myCheck">3D</label>
										<input type="checkbox" id="myCheck3D" onclick="myFunction()">

										<input name="product3D" type="file" id="file3D" style="display:none" accept=".glb,.gltf">



										<label for="myCheck">AR</label>
										<input type="checkbox" id="myCheckAR" onclick="myFunction()">
										<input name="productAR" type="file" id="fileAR" style="display:none" accept=".usdz">

										<script>
											function myFunction() {
												var checkBox3D = document.getElementById("myCheck3D");
												var text = document.getElementById("file3D");
												if (checkBox3D.checked == true) {
													text.style.display = "block";
												} else {
													text.style.display = "none";
												}

												var checkBoxAR = document.getElementById("myCheckAR");
												var text = document.getElementById("fileAR");
												if (checkBoxAR.checked == true) {
													text.style.display = "block";
												} else {
													text.style.display = "none";
												}

											}
										</script>






										<script>
											<?php
											include('js/selectedBanner.js');
											?>
										</script>

										<div class="text-center mt-3">
											<button name="btnregister" class="btn btn-lg btn-primary">Register</button>
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