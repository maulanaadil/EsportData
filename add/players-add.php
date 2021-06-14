<?php
require('../functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Player</title>
</head>
<body>
<?php
if (isset($_POST["btnSubmit"])) {
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $playerId = $db->escape_string($_POST["playerId"]);
        $lastName = $db->escape_string($_POST["lastName"]);
        $firstName = $db->escape_string($_POST["firstName"]);
        $country = $db->escape_string($_POST["country"]);
        $teamId = $db->escape_string($_POST["teamName"]);
        $gender = $db->escape_string($_POST["gender"]);
        $password = md5($_POST['password']);
        $sql = addPlayerSql($playerId, $lastName, $firstName, $country, $teamId, $gender, $password);
        if (mysqli_query($db, $sql)) {
            if ($db->affected_rows > 0) {
                ?>
                Data Successfully Added.<br>
                <a href="../view/players.php">
                    <button>View Teams</button>
                </a>
                <?php
            }
        } else {
            ?>
            Data Added Failed.<br>
            <a href="javascript:history.back()">
                <button>Back</button>
            </a>
            <?php
        }
    } else {
        echo "Failed Connection" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";

    }
}
?>
</body>
</html>

