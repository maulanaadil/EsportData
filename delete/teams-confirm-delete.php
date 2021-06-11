<?php
session_start();
require('../functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Confirm Delete</title>
</head>
<body>
<h1>Confirm Delete Page</h1>
<?php
if (isset($_GET["teamId"])) {
    $db = dbConnect();
    $teamId = $db->escape_string(openssl_decrypt($_GET["teamId"], "aes-128-cbc", $_SESSION["passphrase"], 0,$_SESSION["iv"]));
    if ($dataTeam = getDataTeams($teamId)) {
        ?>
        <a href="../teams.php">
            <button>View Team</button>
        </a>
        <form method="post" name="frm" action="teams-delete.php">
            <input type="hidden" name="teamId" value="<?php echo $dataTeam["teamId"]; ?>">
            <table border="1">
                <tr>
                    <td>Id Team</td>
                    <td><?php echo $dataTeam["teamId"]; ?></td>
                </tr>
                <tr>
                    <td>Team Name</td>
                    <td><?php echo $dataTeam["teamName"]; ?></td>
                </tr>
                <tr>
                    <td>Region</td>
                    <td><?php echo $dataTeam["region"]; ?></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="btnDelete" value="Delete"></td>
                </tr>
            </table>
        </form>
        <?php
    } else
        echo "Team with Id : $teamId is empty";
} else
    echo "IdTeam is empty";
?>
</body>
</html>
