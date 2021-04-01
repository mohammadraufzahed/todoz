<?php
require __DIR__ . "/verifyData.php";
// Check the request method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Save received data from request
	$rqData = ["username" => $_POST["username"],"email" => $_POST["email"], "password" => $_POST["password"], "passwordConfirm" => $_POST["passwordConfirm"]];
	// Review the received data
	reviewData($rqData);
} else {
	header("location: /signup.php");
}