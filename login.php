<?php
require_once __DIR__ . "/class/Account/Login.php";
require_once __DIR__ . "/class/ErrorManager.php";

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
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!--Load the css-->
    <link rel="stylesheet" href="static/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/css/base.css">
</head>

<body>
<div class="container-fluid bg-light w-100 h-100">
    <div class="row">
        <div class="col-12">
            <div class="w-50 h-auto m-auto">
                <form class="pt-5 m-auto border-1 border-success" action="/login.php" method="post">
                    <div class="pt-3 pb-3 text-center">
                        <h1>Login</h1>
                    </div>
					<?php
					if (isset($_GET["error"])) {
						$errorCode = intval($_GET["error"]);
						$errorManager = new ErrorManager();
						$errorManager->loginErrorManager($errorCode);
					}
					?>
                    <div class="form-floating mt-3 mb-3 m-auto">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating pb-3 m-auto">
                        <input type="password" class="form-control" name="password" id="password"
                               placeholder="Password">
                        <label for="username">Password</label>
                    </div>
                    <div class="pb-3 m-auto text-center">
                        <button type="submit" class="btn btn-lg btn-light btn-outline-primary" name="login">Login
                        </button>
                    </div>
                    <div class="pb-3 m-auto text-center">
                        <a href="/signup.php" class="fs-6 text-decoration-none link-secondary">You don't have account
                            ?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Load the scripts-->
    <script src="static/js/bootstrap.bundle.min.js"></script>
</div>
</body>

</html>