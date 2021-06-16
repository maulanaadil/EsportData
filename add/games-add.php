<?php
require('../functions/functions.php');


    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $gameName = $db->escape_string($_POST["gameName"]);
        $playerId = $db->escape_string($_POST["player"]);
        $sql = addGamesSql($gameName, $playerId);
        if (mysqli_query($db, $sql)) {
            if ($db->affected_rows > 0) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    } else {
        echo "Failed Connection" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
    }
