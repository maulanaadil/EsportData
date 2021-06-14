<?php
session_start();
require('../../functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Confirm Delete</title>
</head>
<body>
<h1>Confirm Delete Page</h1>
<?php
if (isset($_GET["gamesId"])) {
    $db = dbConnect();
    $gamesId = $db->escape_string(openssl_decrypt($_GET["gamesId"], 'aes-128-cbc', $_SESSION["passphrase"], 0, $_SESSION["iv"]));
    if ($dataGames = getDataGames($gamesId)) {
        ?>
        <a href="../games.php">
            <button>View Games</button>
        </a>
        <form method="post" name="frm" action="../../delete/games-delete.php">
            <input type="hidden" name="gamesId" value="<?php echo $dataGames["gamesId"]; ?>">
            <table border="1">
                <tr>
                    <td>Game Name</td>
                    <td> <?php echo $dataGames["gamesName"]; ?></td>
                </tr>
                <tr>
                    <td>Player Name</td>
                    <td> <?php echo $dataGames["Name"]; ?></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="btnDelete" value="Delete"></td>
                </tr>
            </table>
        </form>
        <?php
    } else
        echo "Team with Id : $gamesId is empty";
} else
    echo "GamesId is empty";
?>
</body>
</html>
