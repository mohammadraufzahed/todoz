<?php

namespace Todoz\Auth;

/**
 * Permission Managers class
 */
class Permission
{
    public function __construct()
    {
        session_start();
    }

    /**
     * User dashboard permission manager.
     * @return void
     */
    public function dashboardPermission(): void
    {
        if (!$_SESSION["isLoggedIn"]) {
            header("location: /index.php");
            die();
        }
    }

    /**
     * Index pages permission manager.
     * @return void
     */
    public function indexPermission(): void
    {
        if ($_SESSION["isLoggedIn"]) {
            header("location: /dashboard");
            die();
        }
    }
}
