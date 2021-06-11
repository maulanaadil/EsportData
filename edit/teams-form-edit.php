<?php
session_start();
require('../functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Team</title>
</head>
<body>
    <h1>Edit Data Team Page</h1>
    <?php
        if (isset($_GET['teamId'])) {
            $db = dbConnect();
            $teamId = $db->escape_string(openssl_decrypt($_GET["teamId"], "aes-128-cbc", $_SESSION["passphrase"], 0,$_SESSION["iv"]));
            if ($dataTeam = getDataTeams($teamId)) {
                ?>
                <a href="../teams.php"><button>View Team</button></a>
                <form method="post" name="frm" action="teams-update.php">
                    <table border="1">
                        <tr>
                            <td>Id Team</td>
                            <td><input type="text" name="teamId" size="15" maxlength="3" value="<?php echo $dataTeam["teamId"]; ?>"readonly></td>
                        </tr>
                        <tr>
                            <td>Team Name</td>
                            <td><input type="text" name="teamName" size="20" value="<?php echo $dataTeam["teamName"]; ?>"></td>
                        </tr>
                        <tr>
                            <td>Region</td>
                            <td><input type="text" name="region" value="<?php echo $dataTeam["region"]; ?>"></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><input type="submit" name="btnUpdate" value="Update">
                                <input type="reset" value="Reset">
                            </td>
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

