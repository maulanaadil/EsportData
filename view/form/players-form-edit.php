<?php
session_start();
require('../../functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Player</title>
</head>
<body>
<h1>Edit Data Player Page</h1>
<?php
if (isset($_GET['playerId'])) {
    $db = dbConnect();
    $playerId = $db->escape_string(openssl_decrypt($_GET["playerId"], 'aes-128-cbc', $_SESSION["passphrase"], 0, $_SESSION["iv"]));
    if ($dataPlayer = getDataPlayers($playerId)) {
        ?>
        <a href="../players.php">
            <button>View Players</button>
        </a>
        <form method="post" name="frm" action="../../edit/player-update.php">
            <table border="1">
                <tr>
                    <td>Player Id</td>
                    <td><input type="text" name="playerId" size="15" maxlength="3"
                               value="<?php echo $dataPlayer["playerId"]; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type="text" name="lastName" size="20" value="<?php echo $dataPlayer["lastName"]; ?>">
                    </td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><input type="text" name="firstName" size="20" value="<?php echo $dataPlayer["firstName"]; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td><input type="text" name="country" size="20" value="<?php echo $dataPlayer["country"]; ?>"></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td><select name="gender">
                            <option>Select Gender</option>
                            <option value="male" <?php if($dataPlayer["gender"] == "male") {?> selected="selected" <?php }?>>Male</option>
                            <option value="female" <?php if($dataPlayer["gender"] == "female") {?> selected="selected" <?php }?>>Female</option>
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
                                    echo "<option value=\"". $data["teamId"] . "\"";
                                    if ($data["teamId"] == $dataPlayer["teamId"])
                                        echo " selected";
                                    echo ">" . $data["teamName"] . "</option>";
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
        echo "Team with Id : $playerId is empty";
} else
    echo "IdTeam is empty";
?>
</body>
</html>
