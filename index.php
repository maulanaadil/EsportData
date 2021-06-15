<?php
require('functions/functions.php')
?>
<?php banner(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
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
<form method="post" name="f" action="login.php">
    <table border="1">
        <tr>
            <th colspan="2">Login</th>
        </tr>
        <tr>
            <td>Id Player</td>
            <td><input type="text" name="playerId" size="8" maxlength="3"
                       value="<?php echo($_SERVER["REMOTE_ADDR"] == "5.189.147.4" ? "P01" : ""); ?>">
            </td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password" size="15" maxlength="20"
                       value="<?php echo($_SERVER["REMOTE_ADDR"] == "5.189.147.4" ? "admin" : ""); ?>"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="btnLogin" value="Login"></td>
        </tr>
    </table>
</form>
</body>
</html>


