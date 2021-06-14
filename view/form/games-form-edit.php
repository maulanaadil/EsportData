<?php
session_start();
require('../../functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Games</title>
</head>
<body>
<?php
if (isset($_GET['gamesId'])) {
    $db = dbConnect();
    $gamesId = $db->escape_string(openssl_decrypt($_GET["gamesId"], 'aes-128-cbc', $_SESSION["passphrase"], 0, $_SESSION["iv"]));
    if ($dataGames = getDataGames($gamesId)) {
        ?>
        <a href="../games.php">
            <button>View Games</button>
        </a>
        <form method="post" name="frm" action="../../edit/games-update.php">
            <table border="1">
                <tr>
                    <td>Game Name</td>
                    <td>
                        <input type="text" name="gamesId" size="20" value="<?php echo $dataGames["gamesId"]; ?>" hidden readonly>
                        <input type="text" name="gamesName" size="20"
                               value="<?php echo $dataGames["gamesName"]; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Player Name</td>
                    <td><select name="playerId">
                            <option>Select Player Name</option>
                            <?php
                            $dataPlayer = getPlayerSql();
                            foreach ($dataPlayer as $data) {
                                echo "<option value=\"" . $data["playerId"] . "\"";
                                if ($data["playerId"] == $dataGames["playerId"])
                                    echo " selected";
                                echo ">" . $data["Name"] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="btnUpdate" value="Update">
                    <input type="reset" value="Reset">
                </td>
            </table>
        </form>
        <?php
    } else
        echo "Games with id : $gamesId is empty";
} else
    echo "Games is empty";
?>
</body>
</html>
