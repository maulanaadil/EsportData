<?php
require('../functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Games</title>
</head>
<body>
<?php
if (isset($_POST["btnDelete"])) {
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $gamesId = $db->escape_string($_POST["gamesId"]);
        $sql = deleteDataGames($gamesId);
        if (mysqli_query($db, $sql)) {
            if ($db->affected_rows > 0) {
                echo "Data Successfully Deleted.<br>";
            } else {
                echo "Data Failed Deleted. There's no data<br>";
            }
        } else {
            echo "Data Failed to Delete.<br>";
        }
        ?>
        <a href="../view/games.php">
            <button>View Games</button>
        </a>
        <?php
    } else {
        echo "Failed Conection" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
    }
}
?>
</body>
</html>