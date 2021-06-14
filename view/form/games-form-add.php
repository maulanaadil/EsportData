<?php
require('../../functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>
        Add Data Games
    </title>
</head>
<body>
<h1>Add Player Games</h1>
    <a href="../games.php">
        <button>View Game</button>
    </a>
<form method="post" name="frm" action="../../add/games-add.php">
    <table border="1">
        <tr>
            <td>Game Name</td>
            <td><input type="text" name="gamesName" size="20"></td>
        </tr>
        <tr>
            <td>Player Name</td>
            <td>
                <select name="playerId">
                    <option>Select Player Name</option>
                    <?php
                        $dataPlayer = getPlayerSql();
                        foreach ($dataPlayer as $data) {
                            echo "<option value=\"". $data["playerId"]. "\">". $data["Name"]. "</option>";
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
