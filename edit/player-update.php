<?php
require('../functions/functions.php');

$db = dbConnect();
    if ($db->connect_errno == 0) {
        $playerId = $db->escape_string($_POST["id"]);
        $lastName = $db->escape_string($_POST["lastName"]);
        $firstName = $db->escape_string($_POST["firstName"]);
        $country = $db->escape_string($_POST["country"]);
        $gender = $db->escape_string($_POST["gender"]);
        $teamName = $db->escape_string($_POST["team"]);
        $sql = updateDataPlayer($playerId, $lastName, $firstName, $country, $teamName, $gender);
        if (mysqli_query($db, $sql)) {
            if ($db->affected_rows > 0) {
                echo 1;
            } else {
                echo 2;
            }
        } else {
            echo 0;
        }
    } else
        echo "Failed Connection" . (DEVELOPMENT ? " : " .$db->connect_error : ""). "<br>";

