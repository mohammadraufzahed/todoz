<?php
require_once __DIR__ . '/../Database.php';

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
		$this->username = trim($username);
		$this->email = trim($email);
		$this->password = trim($password);
		$this->passwordConfirm = trim($passwordConfirm);
		$this->conn = new Database();
	}

	/**
	 * Signup the user.
	 * @return void
	 */
	public function registerUser(): void
	{
		if (!$this->verifySignupStandard()) {
			header('location: /signup.php?error=1');
			die();
		}
		if ($this->isUserExist()) {
			header('location: /signup.php?error=2');
			die();
		}
		if (!$this->registerInDatabase()) {
			header('location: /signup.php?error=3');
			die();
		}
		header('location: /login.php');
	}

	/**
	 * Verify signup form.
	 * @return bool
	 */
	private function verifySignupStandard(): bool
	{
		// Forbidden symbols.
		$forbiddenSymbols = array("!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "+");
		// Review the username field.
		if (empty($this->username)) {
			// Return false if the username field is empty.
			return false;
		}
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
		if ($this->conn->rowCount() > 0) {
			// Return false if the username and email parameters are repetitious.
			return true;
		} else {
			// Return false if the username and email parameters are not repetitious.
			return false;
		}
	}

	/**
	 * Register user in the database.
	 * @return bool
	 */
	private function registerInDatabase(): bool
	{
		// Encrypt the password.
		$passwordHash = password_hash($this->Password, PASSWORD_DEFAULT);
		// Create query.
		$this->conn->query("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
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
