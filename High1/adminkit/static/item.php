<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$itemphpans = "active";
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

if (!empty($_POST["save"])) {
	$conn = mysqli_connect("localhost", "root", "", "posdb");
	$staffid = $_SESSION['sid'];
	$itemCount = count($_POST["item_name"]);
	$itemValues = 0;
	$cbocategory = $_POST["cbocategory"];
	$cboproduct = $_POST["cboproduct"];

	$select = "SELECT * FROM itemdetail where productid='$cboproduct'";
	$query1 = mysqli_query($conn, $select);
	$count = mysqli_num_rows($query1);
	if ($count > 0) {
		echo "<script>alert('Duplicate Item Detail')</script>";
	} else {


		$query = "INSERT INTO itemdetail (categoryid,productid,rawid,rawqty,staffid) VALUES ";
		$queryValue = "";
		for ($i = 0; $i < $itemCount; $i++) {
			if (!empty($_POST["item_name"][$i]) || !empty($_POST["item_quantity"][$i])) {
				$itemValues++;
				if ($queryValue != "") {
					$queryValue .= ",";
				}
				$queryValue .= "('" . $cbocategory . "','" . $cboproduct . "','" . $_POST["item_name"][$i] . "', '" . $_POST["item_quantity"][$i] . "','" . $staffid . "')";
			}
		}

		$sql = $query . $queryValue;
		// echo $sql;
		if ($itemValues != 0) {
			$result = mysqli_query($conn, $sql);
			if (!empty($result)) $message = "Added Successfully.";
		}
	}
}

?>


<style>
	table {
		border-collapse: collapse;
		border-spacing: 0;
		width: 100%;
		border: 1px solid #ddd;
	}

	th,
	td {
		text-align: center;
		padding: 8px;
	}

	tr:nth-child(even) {
		border-top: 1px solid black;
		border-bottom: 1px solid black;
		background-color: #f2f2f2;
	}
</style>


<SCRIPT src="item/jquery-1.4.3.js"></SCRIPT>
<SCRIPT src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></SCRIPT>
<script src="item/dependent_drop_down/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#authors").change(function() {
			var aid = $("#authors").val();
			$.ajax({
				url: 'item/dependent_drop_down/data.php',
				method: 'post',
				data: 'aid=' + aid
			}).done(function(books) {
				console.log(books);
				books = JSON.parse(books);
				$('#books').empty();
				books.forEach(function(book) {
					$('#books').append('<option value=' + book.productid + ' >' + book.productname + '</option>')
				})
			})
		})
	})
</script>

<?php

$conn = mysqli_connect("localhost", "root", "", "posdb");
$select = "SELECT * FROM raw";
$query = mysqli_query($conn, $select);
$rawcount = mysqli_num_rows($query);
echo $rawcount;

?>

<SCRIPT>
	var i = 1;
	var max = <?php echo $rawcount; ?>;

	function addMore() {

		if (i < max) {
			$("<DIV>").load("item/input.php", function() {
				$("#product").append($(this).html());
			})
			i++;

		} else {
			alert(" You Reach Maximum Amount of (" + max + ") Raw Materials")
		};

	}

	function deleteRow() {
		$('DIV.product-item').each(function(index, item) {
			jQuery(':checkbox', this).each(function() {
				if ($(this).is(':checked')) {
					i -= 1;

					$(item).remove();
				}
			});
		});
	}
</SCRIPT>




<form action="item.php" method="post">

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

				<div class="row">
					<div class="col-12">
						<div class="card">

							<div class="card-body text-center">

								<fieldset>

									<legend>Search :</legend>
									<table>

										<tbody>
											<tr>
												<td style="width:50%">

													<label class="form-check form-check-inline">
														Choose Category :
														<select class="form-control" id="authors" name="cbocategory">
															<option selected="" disabled="">---Select---</option>
															<?php
															require 'item/dependent_drop_down/data.php';
															$authors = loadAuthors();
															foreach ($authors as $author) {
																echo "<option value='" . $author['categoryid'] . "'>" . $author['categoryname'] . "</option>";
															}
															?>
														</select>

													</label>
												</td>

												<td colspan="2">
													<label class="form-check form-check-inline">
														Choose Product :
														<select class="form-control" id="books" name="cboproduct">
															<option selected="" disabled="">---Select---</option>
														</select>
													</label>

												</td>
											</tr>

											<tr>
												<td colspan="2" style="text-align:center;">
													<br>
													<?php require_once("item/input.php") ?>
													<DIV id="product">
													</DIV>
													<br>
												</td>

											</tr>

											<tr>
												<td colspan="2" style="text-align:center;">
													<br>
													<input type="button" name="add_item" value="Add More" onClick="addMore();" />
													<input type="button" name="del_item" value="Delete" onClick="deleteRow();" />
													<span class="success"><?php if (isset($message)) {
																				echo $message;
																			} ?></span>
													<br>
												</td>

											</tr>


											<tr>
												<td colspan="2" style="text-align:center;">
													<br>
													<input type="submit" name="save" value="Save" />
													<br>
												</td>

											</tr>

										</tbody>
							</DIV>
							</table>
							</fieldset>

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