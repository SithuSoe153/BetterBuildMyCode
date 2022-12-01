<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class DbConnect
{
	private $host = 'localhost';
	private $dbName = 'posdb';
	private $user = 'root';
	private $pass = '';

	public function connect()
	{
		try {
			$conn = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->dbName, $this->user, $this->pass);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conn;
		} catch (PDOException $e) {
			echo 'Database Error: ' . $e->getMessage();
		}
	}
}
