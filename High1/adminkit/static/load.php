<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('connect.php');


$select1 = "SELECT * FROM message where message_status = 0";
$query1 = mysqli_query($con, $select1);
$ms = mysqli_num_rows($query1);
if ($ms > 0) {
  echo "<span class='indicator'></span>";
}
