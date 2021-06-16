<?php
require('./functions/functions.php');
$db = dbConnect();
if ($db->connect_errno == 0) {
    if (isset($_POST["btnLogin"])) {
        $playerId = $db->escape_string($_POST["playerId"]);
        $password = $db->escape_string($_POST["password"]);
        $sql = "SELECT playerId, firstName, lastName FROM players 
                WHERE playerId='$playerId' and password=md5('$password')";
        $res = $db->query($sql);
        if ($res) {
            if ($res-> num_rows == 1) {
                $data = $res->fetch_assoc();
                session_start();
                $_SESSION["playerId"]  = $data["playerId"];
                $_SESSION["firstName"]  = $data["firstName"];
                $_SESSION["lastName"]  = $data["lastName"];
                $_SESSION["passphrase"] = openssl_random_pseudo_bytes(16);
                $_SESSION["iv"] = openssl_random_pseudo_bytes(16);
                header("Location: view/index-admin.php");
            } else
                header("Location: index.php?error=1");
        }
    } else
        header("Location: index.php?error=2");
} else
    header("Location: index.php?error=3");
