<?php
require('../functions/functions.php');


    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $teamId = $db->escape_string($_POST["id"]);
        $teamName = $db->escape_string($_POST["name"]);
        $region = $db->escape_string($_POST["region"]);
        $sql = addTeamsSql($teamId, $teamName, $region);
        if (mysqli_query($db, $sql)) {
            if ($db->affected_rows > 0) {
                echo 1;
            }else {
                echo 0;
            }
        } else {
            echo 0;
        }
    } else {
        echo "Failed Connection" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
    }


