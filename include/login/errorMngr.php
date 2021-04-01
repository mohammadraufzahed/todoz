<?php
// Error Codes:
// 1: Please fill all the fields
// 2: User not found
// 3: Password is wrong

// Show the error to user
function printError(int $errorCode): void
{
    $errorMsg = "";
	switch ($errorCode) {
		case 1:
			$errorMsg = "Please fill all the fields";
			break;
		case 2:
			$errorMsg = "User not found";
			break;
		case 3:
			$errorMsg = "Password is wrong";
			break;
	}
	?>
    <div class="pt-3 pb-3 text-center text-white bg-danger w-100 h-auto">
        <b><?php echo $errorMsg; ?></b>
    </div>
	<?php
}
