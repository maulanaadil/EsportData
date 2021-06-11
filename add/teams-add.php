<?php
require('../functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Team</title>
</head>
<body>
<?php
if (isset($_POST["btnSubmit"])) {
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $teamId = $db->escape_string($_POST["teamId"]);
        $teamName = $db->escape_string($_POST["teamName"]);
        $region = $db->escape_string($_POST["region"]);
        $sql = addTeamsSql($teamId, $teamName, $region);
        if (mysqli_query($db, $sql)) {
            if ($db->affected_rows > 0) {
                ?>
                Data Successfully Added.<br>
                <a href="../teams.php">
                    <button>View Teams</button>
                </a>
                <?php
            }
        } else {
            ?>
            Data Failed Added. There is the same teamId.<br>
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
