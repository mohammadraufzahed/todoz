<?php

namespace Todoz\Auth;

/**
 * Logout the user.
 * @return void
 */
function logout(): void
{
    session_start();
    if ($_SESSION["isLoggedIn"]) {
        session_unset();
        session_destroy();
        header("location: /index.php");
    } else {
        header("location: /index.php");
    }
}
