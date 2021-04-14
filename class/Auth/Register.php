<?php

namespace Todoz\Auth;

use \Todoz\Database\Mysql;
use \PDO;

require_once __DIR__ . '/../../vendor/autoload.php';

/**
 * Register class methods.
 */
class Register
{
	private string $username;
	private string $email;
	private string $password;
	private string $passwordConfirm;

	private object $conn;

	/**
	 * Register constructor.
	 * @param string $username
	 * @param string $email
	 * @param string $password
	 * @param string $passwordConfirm
	 */
	public function __construct(string $username, string $email, string $password, string $passwordConfirm)
	{
		// Save the needed data
		$this->username = trim($username);
		$this->email = trim($email);
		$this->password = trim($password);
		$this->passwordConfirm = trim($passwordConfirm);
		// Create connection to database
		$this->conn = new Mysql();
	}

	/**
	 * Signup the user.
	 * @return void
	 */
	public function signupTheUser(): void
	{
		if (!$this->verifyDataStandard()) {
			header('location: /signup.php?error=1');
			die();
		}
		if ($this->isUserExist()) {
			header('location: /signup.php?error=2');
			die();
		}
		if (!$this->saveUserInDatabase()) {
			header('location: /signup.php?error=3');
			die();
		}
		header('location: /login.php');
	}

	/**
	 * Verify data received from the form.
	 * @return bool
	 */
	private function verifyDataStandard(): bool
	{
		// Review the username field.
		if (empty($this->username)) {
			// Return false if the username field is empty.
			return false;
		}
		// Forbidden symbols.
		$forbiddenSymbols = array("!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "+");
		// Review the username field to find forbidden symbols.
		foreach ($forbiddenSymbols as $symbol) {
			if (strpos($this->username, $symbol)) {
				// Return false if the username field contains forbidden symbols.
				return false;
			}
		}

		// Review the email field.
		if (empty($this->email)) {
			// Return false if the email field was empty.
			return false;
		}

		// Review the password field.
		if (empty($this->password) || empty($this->passwordConfirm)) {
			// Return false if the password and passwordConfirm fields was empty
			return false;
		} elseif (strlen($this->password) < 8) {
			// Return false if the password was too short.
			return false;
		} elseif ($this->password !== $this->passwordConfirm) {
			// Return false if the password and passwordConfirm was not equal.
			return false;
		}
		// Return true if everything was good.
		return true;
	}

	/**
	 * Check the username and email exists in the database.
	 * @return bool
	 */
	private function isUserExist(): bool
	{
		// Prepare the statement.
		$this->conn->query("SELECT id FROM users WHERE username=:username OR email=:email");
		// Bind the data in the statement.
		$this->conn->bind(":username", $this->username, PDO::PARAM_STR);
		$this->conn->bind(":email", $this->email, PDO::PARAM_STR);
		// Execute the statement.
		$this->conn->execute();
		// Count the number of rows affected by the query.
		if ($this->conn->rowCount()) {
			// Return false if the username and email parameters are repetitious.
			return true;
		} else {
			// Return false if the username and email parameters are not repetitious.
			return false;
		}
	}

	/**
	 * Save the user in the database.
	 * @return bool
	 */
	private function saveUserInDatabase(): bool
	{
		// Encrypt the password.
		$passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
		// Create query.
		$this->conn->query("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
		// Bind the data.
		$this->conn->bind(":username", $this->username, PDO::PARAM_STR);
		$this->conn->bind(":email", $this->email, PDO::PARAM_STR);
		$this->conn->bind(":password", $passwordHash, PDO::PARAM_STR);
		// Execute the statement.
		if ($this->conn->execute()) {
			// Return true if the statement executed successfully.
			return true;
		} else {
			// Return false if the statement failed.
			return false;
		}
	}
}
