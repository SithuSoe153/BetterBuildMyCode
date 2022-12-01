$(document).ready(function() {
	$("#div_refresh1").load("load.php");
	setInterval(function() {
		$("#div_refresh1").load("load.php");
	}, 1000);
});