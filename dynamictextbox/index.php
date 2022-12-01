<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!empty($_POST["save"])) {
	$conn = mysqli_connect("localhost", "root", "", "posdb");
	// $itemCount = count($_POST["item_name"]);
	$itemValues = 0;
	$cbocategory = $_POST["cbocategory"];
	$cboproduct = $_POST["cboproduct"];
	$query = "INSERT INTO item (categoryid,productid,item_name,item_quantity,item_name1,item_quantity1,item_name2,item_quantity2) VALUES ";
	$queryValue = "";
	for ($i = 0; $i < 1; $i++) {
		if (!empty($_POST["item_name"][$i]) || !empty($_POST["item_quantity"][$i])) {
			$itemValues++;
			if ($queryValue != "") {
				$queryValue .= ",";
			}
			$queryValue .= "('" . $cbocategory . "','" . $cboproduct . "','" . $_POST["item_name"][$i] . "', '" . $_POST["item_quantity"][$i] . "', '" . $_POST["item_name"][$i += 1] . "', '" . $_POST["item_quantity"][$i++] . "', '" . $_POST["item_name"][$i += 2] . "', '" . $_POST["item_quantity"][$i += 2] . "')";
		}
	}



	$sql = $query . $queryValue;
	if ($itemValues != 0) {
		$result = mysqli_query($conn, $sql);
		if (!empty($result)) $message = "Added Successfully.";
	}
}
?>
<HTML>

<HEAD>
	<TITLE>PHP jQuery Dynamic Textbox</TITLE>
	<LINK href="style.css" rel="stylesheet" type="text/css" />
	<SCRIPT src="jquery-1.4.3.js"></SCRIPT>
	<SCRIPT>
		function addMore() {
			$("<DIV>").load("input.php", function() {
				$("#product").append($(this).html());
			});
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

			<DIV id="product">
				<DIV class="float-left">
					<?php
					$conn = mysqli_connect("localhost", "root", "", "posdb");
					$select = "SELECT * FROM category";
					$query = mysqli_query($conn, $select);
					$count = mysqli_num_rows($query);

					echo "<select name='cbocategory'>";
					echo "<option value=''>---Select---</option>";
					for ($i = 0; $i < $count; $i++) {
						$data = mysqli_fetch_array($query);
						$categoryname = $data['categoryname'];
						$categoryid = $data['categoryid'];
						echo "<option value='$categoryid'>$categoryname</option>";
					}
					echo "</select>";
					?>
				</DIV>

				<DIV class="float-left">
					<?php

					$conn = mysqli_connect("localhost", "root", "", "posdb");
					$select = "SELECT * FROM product";
					$query = mysqli_query($conn, $select);
					$count = mysqli_num_rows($query);

					echo "<select name='cboproduct'>";
					echo "<option value=''>---Select---</option>";
					for ($i = 0; $i < $count; $i++) {
						$data = mysqli_fetch_array($query);
						$productname = $data['productname'];
						$productid = $data['productid'];
						echo "<option value='$productid'>$productname</option>";
					}
					echo "</select>";
					?>
				</DIV>

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