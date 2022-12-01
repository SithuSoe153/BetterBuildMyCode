<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>

<head>
	<title></title>
	<!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
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
						$('#books').append('<option>' + book.productname + '</option>')
					})
				})
			})
		})
	</script>
</head>

<body>

	<label for="authors">Authors</label>
	<select class="form-control" id="authors" name="authors">
		<option selected="" disabled="">Select Author</option>
		<?php
		require 'dependent_drop_down/data.php';
		$authors = loadAuthors();
		foreach ($authors as $author) {
			echo "<option id='" . $author['categoryid'] . "' value='" . $author['categoryid'] . "'>" . $author['categoryname'] . "</option>";
		}
		?>
	</select>

	<label for="books">Books</label>
	<select class="form-control" id="books" name="books">

	</select>
	</div>
	</div>
	</form>
	</div>
	</div>
	</div>
</body>

</html>