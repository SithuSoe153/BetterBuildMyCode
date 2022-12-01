<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('connect.php');


if (!empty($_POST["save"])) {
	$conn = mysqli_connect("localhost", "root", "", "posdb");

	$itemCount = count($_POST["item_name"]);
	// echo "<script>console.log(\"$itemCount\");</script>";
	$itemValues = 0;
	$cbocategory = $_POST["cbocategory"];
	$cboproduct = $_POST["cboproduct"];
	$query = "INSERT INTO item (categoryid,productid,item_name,item_quantity,item_name1,item_quantity1,item_name2,item_quantity2) VALUES ";
	$queryValue = "";
	$i = 0;
	$m = 0;

	if (!empty($_POST["item_name"][$i]) || !empty($_POST["item_quantity"][$i])) {
		$itemValues++;
		$queryValue .= "(
			'" . $cbocategory . "',
			'" . $cboproduct . "'";

		$queryValue .= ",";
		for ($j = 0; $j < 3; $j++) {

			$item_name = $_POST["item_name"][$j];
			if (empty($item_name)) {
				// $item_name = ;
			}

			$item_quantity = $_POST["item_quantity"][$j];
			if (empty($item_quantity)) {
				// $item_quantity = ;
			}

			$queryValue .= "
				'" . $item_name . "',
				'" . $item_quantity . "'";
			$m += $j;
			if ($m < 3) {
				$queryValue .= ",";
			}
			if ($m == 3) {
				$queryValue .= ")";
			}
		}
	}



	$sql = $query . $queryValue;
	echo $sql;

	if ($itemValues != 0) {
		$result = mysqli_query($conn, $sql);
		if (!empty($result)) $message = "Added Successfully.";
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<LINK href="style.css" rel="stylesheet" type="text/css" />

	<SCRIPT src="jquery-1.4.3.js"></SCRIPT>
	<SCRIPT>
		var max = 3;

		$(function() {
			var scntDiv = $('#p_scents');
			var i = $('#p_scents p').size() + 1;

			$('#addScnt').live('click', function() {
				if (i <= max) {

					$('<p> <?php $conn = mysqli_connect("localhost", "root", "", "posdb");
							$select = "SELECT * FROM raw";
							$query = mysqli_query($conn, $select);
							$count = mysqli_num_rows($query);

							echo '<select name="item_name[]">';
							for ($i = 0; $i < $count; $i++) {
								$data = mysqli_fetch_array($query);
								$rawtype = $data['rawtype'];
								$rawid = $data['rawid'];
								echo '<option value=' . $rawid . '>' . $rawtype . '</option>';
							}
							echo '</select>'; ?> <label for="p_scnts"><input type="text" id="p_scnt" size="20" name="item_quantity[]" value="" placeholder="Input Value" /></label> <a href="#" id="remScnt">Remove</a></p>').appendTo(scntDiv);
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
	</SCRIPT>

</head>

<body>
	<form action="index.php" method="post">
		<?php
		$select = "SELECT * FROM category";
		$query = mysqli_query($connection, $select);
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

		<div id="p_scents">
			<p>
				<?php
				$conn = mysqli_connect("localhost", "root", "", "posdb");
				$select = "SELECT * FROM raw";
				$query = mysqli_query($conn, $select);
				$count = mysqli_num_rows($query);

				echo "<select name='item_name[]'>";
				for ($i = 0; $i < $count; $i++) {
					$data = mysqli_fetch_array($query);
					$rawtype = $data['rawtype'];
					$rawid = $data['rawid'];
					echo "<option value='$rawid'>$rawtype</option>";
				}
				echo "</select>";
				?>

				<label for="p_scnts"><input type="text" id="p_scnt" size="20" name="item_quantity[]" value="" placeholder="Input Value" /></label>

			</p>

		</div>

		<button>
			<a href="#" id="addScnt">Add More</a>
		</button>
		<input type="submit" name="save" value="Save" />
		<?php if (isset($message)) {
			echo $message;
		} ?>



	</form>

</body>

</html>