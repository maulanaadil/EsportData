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
    if (isset($_GET["playerId"])) {
        $db = dbConnect();
        $playerId = $db->escape_string(openssl_decrypt($_GET["playerId"], 'aes-128-cbc', $_SESSION["passphrase"], 0, $_SESSION["iv"]));
        if ($dataTeam = getDataPlayers($playerId)) {
            ?>
        <a href="../players.php">
            <button>View Player</button>
        </a>
        <form method="post" name="frm" action="../../delete/players-delete.php">
            <input type="hidden" name="playerId" value="<?php echo $dataTeam["playerId"]; ?>">
            <table border="1">
                <tr>
                    <td>Player Id</td>
                    <td><?php echo $dataTeam["playerId"]; ?></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><?php echo $dataTeam["lastName"]; ?></td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><?php echo $dataTeam["firstName"]; ?></td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td><?php echo $dataTeam["country"]; ?></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td><?php echo $dataTeam["gender"]; ?></td>
                </tr>
                <tr>
                    <td>Team</td>
                    <td><?php echo $dataTeam["teamName"]; ?></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="btnDelete" value="Delete"></td>
                </tr>
            </table>
        </form>
    <?php
        } else
            echo "Team with Id : $playerId is empty";
    } else
        echo "IdTeam is empty";
    ?>
</body>
</html>
