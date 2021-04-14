<?php

namespace Todoz\ErrorHandler;

/**
 * Handle the login page errors
 * @param int $errorCode
 */
function loginPage(int $errorCode)
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
	<div class="card has-background-danger">
		<div class="card-content">
			<div class="content ">
				<span class="title is-5 has-text-light"><?php echo $errorMessage; ?></span>
			</div>
		</div>
	</div>
<?php
}

/**
 * Handle the signup page errors
 * @param int $errorCode
 */
function signupPage(int $errorCode): void
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
	<div class="card has-background-danger">
		<div class="card-content">
			<div class="content ">
				<span class="title is-5 has-text-light"><?php echo $errorMessage; ?></span>
			</div>
		</div>
	</div>
<?php
}
