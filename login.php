<?php

use Todoz\Auth\{Login, Permission};
use function Todoz\ErrorHandler\loginPage as loginErrorHandller;

require_once __DIR__ . "/vendor/autoload.php";

$permission = new Permission();
$permission->indexPermission();

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $login = new Login($username, $password);
    if ($login->doLogin()) {
        header("location: /index.php");
    }
}
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- Css Files -->
    <link rel="stylesheet" href="static/css/bulma.min.css">
    <link rel="stylesheet" href="static/css/base.css">

</head>

<body>
    <!-- Main container -->
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-half mt-6">
                <div class="is-centered has-text-centered">
                    <!-- Login form -->
                    <form class="" action="/login.php" method="post">
                        <h1 class="title is-1">Login</h1>
                        <!-- Error Box -->
                        <?php
                        if (isset($_GET["error"])) {
                            $errorCode = intval($_GET["error"]);
                            loginErrorHandller($errorCode);
                        }
                        ?>
                        <!-- Error Box -->
                        <div class="field mt-3 mb-3">
                            <label class="label has-text-left" for="username">Username</label>
                            <div class="control has-icons-left">
                                <input type="text" class="input" name="username" id="username" placeholder="Username">
                                <span class="icon is-small is-left">
                                    <i data-feather="user"></i>
                                </span>
                            </div>
                        </div>
                        <div class="field pb-3 m-auto">
                            <label class="label has-text-left" for="username">Password</label>
                            <div class="control has-icons-left">
                                <input type="password" class="input" name="password" id="password" placeholder="Password">
                                <span class="icon is-small is-left">
                                    <i data-feather="lock"></i>
                                </span>
                            </div>
                        </div>
                        <div class="pb-3">
                            <button type="submit" class="button is-primary is-outlined" name="login">Login
                            </button>
                        </div>
                        <div class="pb-3">
                            <a href="/signup.php" class="has-text-link">You don't have account
                                ?</a>
                        </div>
                    </form>
                    <!-- Login form -->
                </div>
            </div>
        </div>
    </div>
    <!-- Main container -->
    <!-- JS Files -->
    <script src="static/js/feather.min.js"></script>
    <script>
        feather.replace()
    </script>
</body>

</html>