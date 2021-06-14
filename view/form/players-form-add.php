<?php
require('../../functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Data Player</title>
</head>
<body>
<h1>Add Data Player Page</h1>
<a href="../players.php">
    <button>View Player</button>
</a>
<form method="post" name="frm" action="../../add/players-add.php">
    <table border="1">
        <tr>
            <td>Player Id</td>
            <td><input type="text" name="playerId" size="15" maxlength="3"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password" size="15"></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><input type="text" name="lastName" size="20"></td>
        </tr>
        <tr>
            <td>First Name</td>
            <td><input type="text" name="firstName" size="20"></td>
        </tr>
        <tr>
            <td>Country</td>
            <td><input type="text" name="country" size="20"></td>
        </tr>
        <tr>
            <td>Gender</td>
            <td><select name="gender">
                    <option>Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Team</td>
            <td>
                <select name="teamName">
                    <option>Select Your Team</option>
                    <?php
                        $dataTeam = getTeamsSql();
                        foreach ($dataTeam as $data) {
                            echo "<option value=\"" . $data["teamId"] . "\">". $data["teamName"]. "</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="btnSubmit" value="save"></td>
        </tr>
    </table>
</form>
</body>
</html>
