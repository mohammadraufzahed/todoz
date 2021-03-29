<?php

function verifyData($data, $db): array
{
	// Save data in variables
	$username = $data["username"];
	$password = $data["password"];
	// Send request to database
	$sql = "SELECT `id`, `isAdmin`, `password` FROM `users` WHERE username='$username'";
	$query = $db->prepare($sql);
	$query->execute();
	// Check the query to determine user is exists
	if ($query->rowCount() !== 1) {
		header("location: /login.php?error=2");
	}
	// Save the data received from database
	$dbData = $query->fetchAll(PDO::FETCH_OBJ);
	// Check the password is valid
	foreach ($dbData as $data) {
		if (password_verify($password, $data->password)) {
			return ["id" => $data->id, "isAdmin" => $data->isAdmin];
		} else {
			header("location: /login.php?error=3");
		}
	}
}