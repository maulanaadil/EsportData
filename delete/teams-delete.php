<?php
require('../functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Team</title>
</head>
<body>
<?php
if (isset($_POST["btnDelete"])) {
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $teamId = $db->escape_string($_POST["teamId"]);
        $sql = deleteDataTeams($teamId);
        if (mysqli_query($db, $sql)) {
            if ($db->affected_rows > 0) {
                echo "Data Successfully Deleted.<br>";
            } else {
                echo "Data Failed Deleted.<br>";
            }
        } else {
            echo "Data Failed to Delete.<br>";
        }
        ?>
        <a href="../view/teams.php">
            <button>View Teams</button>
        </a>
        <?php
    } else {
        echo "Failed Conection" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
    }
}
?>
</body>
</html>
