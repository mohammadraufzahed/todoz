<?php
/*
 * Error Codes:
 * 1: Username Field is empty.
 * 2: Please don't use forbidden symbols (~!@#$%^&*()_+).
 * 3: Email Field is empty.
 * 4: Please enter a email.
 * 5: password or passwordConfirm Field is empty.
 * 6: Your password must have at least 8 character.
 * 7: Password and PasswordConfirm are not equal.
 */
function printError(): void
{
	// Check the request method
	if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["error"])) {
		$errorCode = $_GET["error"];
		$errorMsg = "";
		switch ($errorCode) {
			case 1:
				$errorMsg = "Username Field is empty.";
				break;
			case 2:
				$errorMsg = "Please don't use forbidden symbols (~!@#$%^&*()_+).";
				break;
			case 3:
				$errorMsg = "Email Field is empty.";
				break;
			case 4:
				$errorMsg = "Please enter a email.";
				break;
			case 5:
				$errorMsg = "password or passwordConfirm Field is empty.";
				break;
			case 6:
				$errorMsg = "Your password must have at least 8 character.";
				break;
			case 7:
				$errorMsg = "Password and PasswordConfirm are not equal.";
				break;
		}
		?>
        <div class="pt-3 pb-3 text-center text-white bg-danger w-100 h-auto">
            <b><?php echo $errorMsg; ?></b>
        </div>
		<?php
	}
}