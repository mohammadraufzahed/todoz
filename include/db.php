<?php
// Define the database information
define("DB_HOST", "localhost");
define("DB_NAME", "todoz");
define("DB_USER", "mohammad");
define("DB_PASS", "09351515982Mr@");

// Try to connect to database
try {
	$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo $e->getMessage();
}
