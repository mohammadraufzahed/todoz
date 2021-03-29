<?php
// Error Codes:
// 1: Please fill all the fields
// 2: User not found
// 3: Password is wrong

// Show the error to user
function printError(int $errorCode): void
{
    if ($errorCode == 1) { ?>
        <div class="pt-3 pb-3 text-center text-white bg-danger w-100 h-auto">
            <b>Please fill all the fields</b>
        </div>
    <?php } elseif ($errorCode == 2) { ?>
        <div class="pt-3 pb-3 text-center text-white bg-danger w-100 h-auto">
            <b>User not found</b>
        </div>
    <?php } elseif ($errorCode == 3) { ?>
        <div class="pt-3 pb-3 text-center text-white bg-danger w-100 h-auto">
            <b>Password is wrong</b>
        </div>
<?php }
}
