<?php
require('../functions/functions.php');
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $gamesId = $db->escape_string($_GET["id"]);
        $sql = deleteDataGames($gamesId);
        if (mysqli_query($db, $sql)) {
            if ($db->affected_rows > 0) {
                echo 1;
            } else {
                echo 0;
                // data failed there no data
            }
        } else {
            echo 0;
//            echo "Data Failed to Delete.<br>";
        }
    } else {
        echo "Failed Conection" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
    }