<?php
require_once(__DIR__ . "/../db.php");
require_once(__DIR__ . "/../isEmpty.php");
require_once(__DIR__ . "/verifyData.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Save the received data
	$loginData = ["username" => $_POST["username"], "password" => $_POST["password"]];
	// Determine received data is empty or not
	$isDataEmpty = isEmpty($loginData);
	// Return to login page with error if data was empty
	if ($isDataEmpty) {
		header("location: /login?error=1");
	}
	// Verify the data and save the user id
	$userData = verifyData($loginData, $db);
	// Save the user in session
	session_start();
	$_SESSION["isLogged"] = true;
	$_SESSION["userId"] = $userData["id"];
	$_SESSION["isAdmin"] = $userData["isAdmin"];
} else {
	header("location: /login.php");
}