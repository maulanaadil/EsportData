<?php
require('../functions/functions.php');
?>

<!DOCTYPE html>
<htmL>
<head>
    <title>Update Player</title>
</head>
<body>
<?php
if (isset($_POST["btnUpdate"])) {
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $playerId = $db->escape_string($_POST["playerId"]);
        $lastName = $db->escape_string($_POST["lastName"]);
        $firstName = $db->escape_string($_POST["firstName"]);
        $country = $db->escape_string($_POST["country"]);
        $gender = $db->escape_string($_POST["gender"]);
        $teamName = $db->escape_string($_POST["teamName"]);
        $sql = updateDataPlayer($playerId, $lastName, $firstName, $country, $teamName, $gender);
        if (mysqli_query($db, $sql)) {
            if ($db->affected_rows > 0) {
                ?>Data Successfully Updated.<br>
                <a href="../view/players.php.php">
                    <button>View Teams</button>
                </a>
                <?php
            } else {
                ?>
                Data Update Success. Without any data changes.<br>
                <a href="../view/teams.php"><button>View Teams</button></a>
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
</htmL>
