<div id="selectedBanner"></div>

<input type="file" name="filecusimage" class="img" id="file" required accept="image/*">
<label id="file" for="file">
	<i class="fa fa-image"></i> &nbsp
	Choose Profile Pic</label>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
	var selDiv = "";
	var storedFiles = [];
	$(document).ready(function() {
		$(".img").on("change", handleFileSelect);
		selDiv = $("#selectedBanner");
	});

	function handleFileSelect(e) {
		var files = e.target.files;
		var filesArr = Array.prototype.slice.call(files);
		filesArr.forEach(function(f) {
			if (!f.type.match("image.*")) {
				return;
			}
			storedFiles.push(f);

			var reader = new FileReader();
			reader.onload = function(e) {
				var html =
					'<img src="' +
					e.target.result +
					"\" data-file='" +
					f.name +
					"' class='avatar rounded lg' alt='Category Image' height='500px' width='100px'>";
				selDiv.html(html);
			};
			reader.readAsDataURL(f);
		});
	}
</script>