<?php
require('../functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Team</title>
</head>
<body>
<?php
if (isset($_POST["btnUpdate"])) {
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $teamId = $db->escape_string($_POST["teamId"]);
        $teamName = $db->escape_string($_POST["teamName"]);
        $region = $db->escape_string($_POST["region"]);
        $sql = updateDataTeams($teamId, $teamName, $region);
        if (mysqli_query($db, $sql)) {
            if ($db->affected_rows > 0) {
                ?>Data Successfully Updated.<br>
                <a href="../teams.php">
                    <button>View Teams</button>
                </a>
                <?php
            } else {
                ?>
                    Data Update Success. Without any data changes.<br>
                <a href="../teams.php"><button>View Teams</button></a>
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
