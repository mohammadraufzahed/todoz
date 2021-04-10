<?php

class ErrorManager
{

	/**
	 * Login page error handler
	 * @param int $errorCode
	 */
	public function loginErrorManager(int $errorCode)
	{
		$errorMessage = "";
		switch ($errorCode) {
			case 1:
				$errorMessage = "Check the fields";
				break;
			case 2:
				$errorMessage = "Username or password incorrect";
				break;
		} ?>
        <div class="pt-3 pb-3 text-center text-white bg-danger w-100 h-auto">
            <p><?php echo $errorMessage; ?></p>
        </div>
		<?php
	}

	public function registerErrorManager(int $errorCode): void
	{
		$errorMessage = "";
		switch ($errorCode) {
			case 1:
				$errorMessage = "Please check the fields.";
				break;
			case 2:
				$errorMessage = "User already exists.";
				break;
			case 3:
				$errorMessage = "Something goes wrong.";
				break;
		}
		?>
        <div class="pt-3 pb-3 text-center text-white bg-danger w-100 h-auto">
            <p><?php echo $errorMessage; ?></p>
        </div>
		<?php
	}
}
