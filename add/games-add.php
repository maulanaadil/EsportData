<?php
require('../functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>
        Add Player Games
    </title>
</head>
<body>
<?php
if (isset($_POST["btnSubmit"])) {
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $gamesName = $db->escape_string($_POST["gamesName"]);
        $playerId = $db->escape_string($_POST["playerId"]);
        $sql = addGamesSql($gamesName, $playerId);
        if (mysqli_query($db, $sql)) {
            if ($db->affected_rows > 0) {
                ?>
                Data Successfully Added.<br>
                <a href="../view/games.php">
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
