<?php

use Todoz\Auth\Register;
use function Todoz\ErrorHandler\signupPage as signupErrorHandller;

require_once __DIR__ . "/vendor/autoload.php";


if (isset($_POST["signup"])) {
    // Save the users
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordConfirm = $_POST["passwordConfirm"];
    $register = new Register($username, $email, $password, $passwordConfirm);
    // Register the user.
    $register->signupTheUser();
}
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <!--Load the css-->
    <link rel="stylesheet" href="static/css/bulma.min.css">
    <link rel="stylesheet" href="static/css/base.css">
</head>

<body>
    <!-- Main container -->
    <div class="container">
        <div class="columns is-centered mt-6">
            <div class="column is-half has-text-centered">
                <!-- Signup form -->
                <form class="" action="/signup.php" method="post">
                    <!-- Header -->
                    <h1 class="title is-1">Signup</h1>
                    <!-- Header -->
                    <!-- Error box -->
                    <?php
                    if (isset($_GET["error"])) {
                        $errorCode = $_GET["error"];
                        signupErrorHandller($errorCode);
                    }
                    ?>
                    <!-- Error box -->

                    <div class="field mb-3">
                        <label class="label has-text-left" for="username">Username</label>
                        <div class="control has-icons-left">
                            <input type="text" class="input" name="username" id="username" placeholder="Username">
                            <span class="icon is-small is-left">
                                <i data-feather="user"></i>
                            </span>
                        </div>
                    </div>
                    <div class="field pb-3">
                        <label class="label has-text-left" for="username">Email</label>
                        <div class="control has-icons-left">
                            <input type="email" class="input" name="email" id="email" placeholder="Email">
                            <span class="icon is-small is-left">
                                <i data-feather="mail"></i>
                            </span>
                        </div>
                    </div>
                    <div class="field pb-3">
                        <label class="label has-text-left" for="username">Password</label>
                        <div class="control has-icons-left">
                            <input type="password" class="input" name="password" id="password" placeholder="Password">
                            <span class="icon is-small is-left">
                                <i data-feather="lock"></i>
                            </span>
                        </div>
                    </div>
                    <div class="field pb-3">
                        <label class="label has-text-left" for="username">Confirm Password</label>
                        <div class="control has-icons-left">
                            <input type="password" class="input" name="passwordConfirm" id="passwordConfirm" placeholder="Confirm Password">
                            <span class="icon is-small is-left">
                                <i data-feather="lock"></i>
                            </span>
                        </div>
                    </div>
                    <div class="pb-3">
                        <button type="submit" class="button is-primary is-outlined" name="signup">Signup
                        </button>
                    </div>
                    <div class="pb-3">
                        <a href="/login.php" class="text-has-link">Do you have account?</a>
                    </div>
                </form>
                <!-- Signup form -->

            </div>
        </div>
        <!-- Main container -->
        <!--Js files-->
        <script src="static/js/feather.min.js"></script>
        <script>
            feather.replace();
        </script>
    </div>
</body>

</html>