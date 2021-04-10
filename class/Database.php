<?php

/**
 * Database class.
 */
class Database
{
	// Database information.
	private const DB_HOST = "localhost";
	private const DB_USER = "mohammad";
	private const DB_PASS = "09351515982Mr@";
	private const DB_NAME = "todoz";

	private $dbc;
	private $stmt;
	private string $error;

	/**
	 * Database constructor.
	 */
	public function __construct()
	{
		try {
			$this->dbc = new PDO("mysql:host=" . $this::DB_HOST . ";dbname=" . $this::DB_NAME . ";charset=utf8", $this::DB_USER, $this::DB_PASS);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	/**
	 * Prepare query.
	 * @param string $query
	 * @return void
	 */
	public function query($query)
	{
		$this->stmt = $this->dbc->prepare($query); // Create statement.
	}

	/**
	 * Binding the given values to query
	 * @param string $param
	 * @param int $type
	 * @param string $value
	 * @return void
	 */
	public function bind($param, $value, $type)
	{
		$this->stmt->bindParam($param, $value, $type); // Binding the parameter.
	}

	/**
	 * Fetch all from statement
	 * @return array
	 */
	public function fetchAll()
	{
		$this->execute(); // Execute the statement.
		return $this->stmt->fetchAll(PDO::FETCH_OBJ); // Return the results.
	}

	/**
	 * Execute the statement
	 * @return bool
	 */
	public function execute(): bool
	{
		if ($this->stmt->execute()) {
			return true; // Return true if the statement executed successfully.
		} else {
			return false; // Return false if the statement failed.
		}
	}

	/**
	 * Fetch from statement
	 * @return object
	 */
	public function fetch()
	{
		$this->execute(); // Execute the statement.
		return $this->stmt->fetch(PDO::FETCH_OBJ); // Return the result.
	}

	/**
	 * Return the number of rows affected by sql statement
	 * @return int
	 */
	public function rowCount()
	{
		return $this->stmt->rowCount(); // Count the number of rows affected.
	}

	/**
	 * Database destructor.
	 */
	public function __destruct()
	{
		$this->dbc = null; // close the connection.
		$this->stmt = null; // close the statement.
	}
}
