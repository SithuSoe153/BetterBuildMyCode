<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// if (isset($_REQUEST['check'])) {
// 	$re = $_POST["heehe"];
// 	echo $re;
// }

// if (isset($_POST['comboBox1'])) {
// 	echo $_REQUEST['heehe'];
// }
// echo $_GET['check'];

if (!empty($_POST["save"])) {
	$conn = mysqli_connect("localhost", "root", "", "posdb");
	// $itemCount = count($_POST["item_name"]);
	$itemValues = 0;
	$productname = $_POST["comboBox1"];
	$query = "INSERT INTO item (productname,item_name,item_quantity,item_name1,item_quantity1) VALUES ";
	$queryValue = "";
	for ($i = 0; $i < 1; $i++) {
		if (!empty($_POST["item_name"][$i]) || !empty($_POST["item_quantity"][$i])) {
			$itemValues++;
			if ($queryValue != "") {
				$queryValue .= ",";
			}
			$queryValue .= "('" . $productname . "','" . $_POST["item_name"][$i] . "', '" . $_POST["item_quantity"][$i] . "', '" . $_POST["item_name"][$i += 1] . "', '" . $_POST["item_quantity"][$i++] . "')";
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
	<SCRIPT src="http://code.jquery.com/jquery-2.1.1.js"></SCRIPT>
	<SCRIPT src="http://code.jquery.com/jquery-3.4.1.min.js"></SCRIPT>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

	<SCRIPT>
		let jvalue, value, chkvalue,
			getComboA;

		function addMore() {
			if (i <= max) {
				$("<DIV>").load("input.php", function() {
					$("#product").append($(this).html());
				});
			}
		}

		// ---------------------------------------------
		var max = 5;

		$(function() {
			var scntDiv = $('#p_scents');
			var i = $('#p_scents p').size() + 1;

			$('#addScnt').live('click', function() {
				if (i <= max) {
					$('<p><label for="p_scnts"><input type="text" id="p_scnt" size="20" name="p_scnt_' + i + '" value="" placeholder="Input Value" /></label> <a href="#" id="remScnt">Remove</a></p>').appendTo(scntDiv);
					i++;
					return false;
				}
			});

			$('#remScnt').live('click', function() {
				if (i > 2) {
					$(this).parents('p').remove();
					i--;
				}
				return false;
			});
		});

		// ---------------------------------------------

		function deleteRow() {
			$('DIV.product-item').each(function(index, item) {
				jQuery(':checkbox', this).each(function() {
					if ($(this).is(':checked')) {
						$(item).remove();
					}
				});
			});
		}

		getComboA = function(selectObject) {
			value = selectObject.value;
			console.log(value);

		}



		// function getComboA(selectObject) {
		// 	var value = selectObject.value;
		// 	console.log(value);
		// }

		// function getComboA(selectObject) {
		// 	var value = selectObject.value;
		// 	console.log(value);
		// }

		// $("#comboBox1").change(function() {
		// if ($(this).data('options') === undefined) {
		// /* Get all the options in second Combo box*/
		// $(this).data('options', $('#comboBox2 option').clone());
		// }
		// var id = $(this).val();
		// var options = $(this).data('options').filter('[value=' + id + ']');
		// $('#comboBox2').html(options);
		// });
	</SCRIPT>
</HEAD>

<BODY>
	<FORM action="index1.php" method="post">
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

					// $passpass = '<script> var passspass = 8;
					// document.writeln(passspass) </script>';
					// echo $passpass;

					echo "<select name='comboBox1' id='comboBox1' onchange='getComboA(this)'>";
					echo "<option value='0'>---Select---</option>";
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
					echo  "abc" . $abc;
					$num = 7;
					echo "num" . $num;
					// $rrr = $_REQUEST['$rr'];
					$conn = mysqli_connect("localhost", "root", "", "posdb");
					$select = "SELECT * FROM product WHERE categoryid = '$abc'";

					// WHERE categoryid = '$passpass' 
					$query = mysqli_query($conn, $select);
					$count = mysqli_num_rows($query);
					echo "<select name='comboBox2' id='comboBox2'>";
					echo "<option value=''>---Select---</option>";
					for ($i = 0; $i < $count; $i++) {
						$data = mysqli_fetch_array($query);
						$productname = $data['productname'];
						$productid = $data['productid'];
						echo "<option value='$productid'>$productname</option>";
					}
					echo "</select>"; ?>
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