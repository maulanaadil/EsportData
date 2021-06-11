<?php
require ('./functions/functions.php');
session_start();
if (!isset($_SESSION["playerId"]))
    header("Location: index.php?error=4");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Data management</title>
    </head>
    <body>
    <?php banner(); ?>
    <?php navigator(); ?>
    <h1>Administration Menu</h1>
    Welcome <?php echo $_SESSION["firstName"]; ?><br>
    Please select the activity you want to do by clicking on the menu.
    </body>
</html>