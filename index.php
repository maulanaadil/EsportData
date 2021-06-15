<?php
require('functions/functions.php')
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="assets/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="assets/css/adminlte.min.css">

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        Login Data E-Sport
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <?php
            if (isset($_GET["error"])) {
                $error = $_GET["error"];
                if ($error == 1)
                    showError("idPlayer and password do not match .");
                else if ($error == 2)
                    showError("Error database. Please contact the administrator");
                else if ($error == 3)
                    showError("Connection to Database failed. Authentication failed.");
                else if ($error == 4)
                    showError("You cannot access the previous page because you are not logged in. Please login first.");
                else
                    showError("Unknown Error.");
            } ?>

            <form method="post"  action="login.php">
                <div class="input-group mb-3">
                    <input type="text" name="playerId" size="8" maxlength="3" class="form-control" placeholder="ID Player"
                           value="<?php echo($_SERVER["REMOTE_ADDR"] == "5.189.147.4" ? "P01" : ""); ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" size="15" maxlength="20" class="form-control" placeholder="Password"
                           value="<?php echo($_SERVER["REMOTE_ADDR"] == "5.189.147.4" ? "admin" : ""); ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="social-auth-links text-center mb-3">
                    <button class="btn btn-block btn-primary" name="btnLogin">
                         Login / Masuk
                    </button>
                </div>
            </form>

        </div>
        <!-- /.login-card-body -->
    </div>
</div>
</body>

</html>


