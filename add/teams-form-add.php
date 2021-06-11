<?php
require('../functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Data Teams</title>
</head>
<body>
<h1>Add Data Teams</h1>
<a href="../teams.php">
    <button>
        View Teams
    </button>
</a>
<form method="post" name="frm" action="teams-add.php">
    <table border="1">
        <tr>
            <td>Id Teams</td>
            <td><input type="text" name="teamId" size="15" maxlength="3"</td>
        </tr>
        <tr>
            <td>Team Name</td>
            <td><input type="text" name="teamName" size="20"></td>
        </tr>
        <tr>
            <td>Region</td>
            <td><input type="text" name="region"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="btnSubmit" value="save"></td>
        </tr>
    </table>
</form>
</body>
</html>

