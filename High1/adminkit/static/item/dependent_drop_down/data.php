<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require 'DbConnect.php';

if (isset($_POST['aid'])) {
	$db = new DbConnect;
	$conn = $db->connect();

	$stmt = $conn->prepare("SELECT * FROM product WHERE categoryid = " . $_POST['aid']);
	$stmt->execute();
	$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($books);
}

function loadAuthors()
{
	$db = new DbConnect;
	$conn = $db->connect();

	$stmt = $conn->prepare("SELECT * FROM category");
	$stmt->execute();
	$authors = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $authors;
}
