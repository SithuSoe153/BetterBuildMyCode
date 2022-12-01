<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


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
		echo $sql;
		if ($itemValues != 0) {
			$result = mysqli_query($conn, $sql);
			if (!empty($result)) $message = "Added Successfully.";
		}
	}
}

?>

<HTML>

<HEAD>
	<TITLE>PHP jQuery Dynamic Textbox</TITLE>
	<LINK href="style.css" rel="stylesheet" type="text/css" />
	<SCRIPT src="jquery-1.4.3.js"></SCRIPT>
	<SCRIPT src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></SCRIPT>


	<script src="dependent_drop_down/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#authors").change(function() {
				var aid = $("#authors").val();
				$.ajax({
					url: 'dependent_drop_down/data.php',
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
				$("<DIV>").load("input.php", function() {
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
						$(item).remove();
					}
				});
			});
		}
	</SCRIPT>

</HEAD>

<BODY>
	<FORM name="frmProduct" method="post" action="">
		<DIV id="outer">
			<DIV id="header">
				<DIV class="float-left">&nbsp;</DIV>
				<DIV class="float-left col-heading">choose</DIV>
				<DIV class="float-left col-heading">Product Name</DIV>
				<DIV class="float-left col-heading">Item Name</DIV>
				<DIV class="float-left col-heading">Item Quantity</DIV>
			</DIV>



			<!-- ///////////////////////////// -->


			<DIV id="product">
				<DIV class="float-left">

					<select class="form-control" id="authors" name="cbocategory">
						<option selected="" disabled="">---Select---</option>
						<?php
						require 'dependent_drop_down/data.php';
						$authors = loadAuthors();
						foreach ($authors as $author) {
							echo "<option value='" . $author['categoryid'] . "'>" . $author['categoryname'] . "</option>";
						}
						?>
					</select>

				</DIV>

				<DIV class="float-left">


					<select class="form-control" id="books" name="cboproduct">

					</select>


				</DIV>



				<!-- ///////////////////////////// -->

				<?php require_once("input.php") ?>



			</DIV>
			<DIV class="btn-action float-clear">
				<input type="button" name="add_item" value="Add More" onClick="addMore();" />
				<input type="button" name="del_item" value="Delete" onClick="deleteRow();" />
				<span class="success"><?php if (isset($message)) {
											echo $message;
										} ?></span>
			</DIV>


			<DIV class="footer">
				<input type="submit" name="save" value="Save" />
			</DIV>
		</DIV>
	</form>
</BODY>

</HTML>