<?php
require('../functions/functions.php');

    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $teamId = $db->escape_string($_GET["id"]);
        $sql = deleteDataTeams($teamId);
        if (mysqli_query($db, $sql)) {
            if ($db->affected_rows > 0) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo "Data Failed to Delete.<br>";
        }
        ?>

        <?php
    } else {
        echo "Failed Conection" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
    }
?>