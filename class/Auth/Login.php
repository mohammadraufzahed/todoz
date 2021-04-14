<?php

namespace Todoz\Auth;

use \PDO;
use \Todoz\Database\Mysql;

require_once __DIR__ . "/../../vendor/autoload.php";

/**
 * Login class.
 */
class Login
{
	private string $username;
	private string $password;
	private string $userId;
	private string $isAdmin;
	private object $conn;

	/**
	 *  Login constructor.
	 * @param string $username
	 * @param string $password
	 */
	public function __construct(string $username, string $password)
	{
		$this->username = trim($username);
		$this->password = trim($password);
		$this->conn = new Mysql();
	}

	/**
	 * Loggin the user.
	 * @return bool
	 */
	public function doLogin(): bool
	{
		if (!$this->verifyDataStandard()) {
			header("location: /login.php?error=1");
			die();
		}
		if (!$this->verifyDataInDatabase()) {
			header("location: /login.php?error=2");
			die();
		}
		// Login the user.
		session_start(); // Start the session.
		// Assign the userId and isAdmin in session and set the login statement true.
		$_SESSION["userId"] = $this->userId;
		$_SESSION["isAdmin"] = $this->isAdmin;
		$_SESSION["isLoggedIn"] = true;
		// Return if user is logged in successfully.
		return true;
	}

	/**
	 * Verify login standard.
	 * @return bool
	 */
	private function verifyDataStandard(): bool
	{
		// Review the password and username fields.
		if (empty($this->username) || empty($this->password)) {
			// if username and password are empty return false.
			return false;
		} else {
			// if username and password are not empty return true.
			return true;
		}
	}

	/**
	 * Verify the password and username fields in database.
	 */
	private function verifyDataInDatabase(): bool
	{
		// Send query to database.
		$this->conn->query("SELECT `id`, `password`, `isAdmin` FROM `users` WHERE username=:username AND isAccountEnable='Y'");
		// Binding the username.
		$this->conn->bind(':username', $this->username, PDO::PARAM_STR);
		// Execute the statement.
		$this->conn->execute();
		if ($this->conn->rowCount == 1) {
			// Return false if the user not found.
			return false;
		}
		// Get the result.
		$result = $this->conn->fetch();
		if (password_verify($this->password, $result->password)) {
			// Get the user id.
			$this->userId = $result->id;
			// Is the user admin.
			$this->isAdmin = $result->isAdmin;
			// Return true if password is correct.
			return true;
		} else {
			// Return false if password is incorrect.
			return false;
		}
	}
}
