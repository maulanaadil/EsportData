<?php
require('../functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Games</title>
</head>
<body>
<?php
if (isset($_POST["btnUpdate"])) {
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $gamesId = $db->escape_string($_POST["gamesId"]);
        $gamesName = $db->escape_string($_POST["gamesName"]);
        $playerId = $db->escape_string($_POST["playerId"]);
        $sql = updateDataGames($gamesId, $gamesName, $playerId);
        if (mysqli_query($db, $sql)) {
            if ($db->affected_rows > 0) {
                ?>Data Successfully Updated.<br>
                <a href="../view/games.php">
                    <button>View Games</button>
                </a>
                <?php
            } else {
                ?>
                Data Update Success. Without any data changes.<br>
                <a href="../view/games.php"><button>View Games</button></a>
                <?php
            }
        } else {
            ?>
            Data Updated Failed.<br>
            <a href="javascript:history.back()">
                <button>Back</button>
            </a>
            <?php
        }
    } else
        echo "Failed Connection" . (DEVELOPMENT ? " : " .$db->connect_error : ""). "<br>";
}
?>
</body>
</html>
