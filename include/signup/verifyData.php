<?php
// Review the data
function reviewData(array $data): void
{
	reviewUsername($data["username"]);
	reviewEmail($data["email"]);
	reviewPassword($data["password"], $data["passwordConfirm"]);
}

// Review the username
function reviewUsername(string $username): void
{
	// Review the username field to specify it is empty or it's not empty
	if (empty(trim($username))) {
		header("location: /signup.php?error=1");
		die();
	}
	// Define forbidden symbols
	$forbiddenSymbols = ["!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "+"];
	// Search the username to find forbidden symbols
	foreach ($forbiddenSymbols as $symbol) if (strpos($username, $symbol)) {
		header("location: /signup.php?error=2");
		die();
	}
}

// Review the email field
function reviewEmail(string $email): void
{
	// Review the email field to specify it is empty or it's not empty
	if (empty(trim($email))) {
		header("location: /signup.php?error=3");
		die();
	}
}

// Review the password field
function reviewPassword(string $password, string $passwordConfirm): void
{
	// Review the password and passwordConfirm fields to specify they are empty or they aren't empty
	if (empty(trim($password)) or empty(trim($passwordConfirm))) {
		header("location: /signup.php?error=5");
		die();
	}
	// Review the password length
	if (strlen($password) < 8) {
		header("location: /signup.php?error=6");
		die();
	}
	// Compare the password and passwordConfirm
	if ($password !== $passwordConfirm) {
		header("location: /signup.php?error=7");
		die();
	}
}