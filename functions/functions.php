<?php
define("DEVELOPMENT", true);
function dbConnect() {
    $db = new mysqli("localhost", "root", "","esport" );
    return $db;
}

function getTeamsSql() {
    $db = dbConnect();
    $sql = "SELECT * FROM teams ";
    $res = $db->query($sql);
    return $res;
}

function addTeamsSql($teamId, $teamName, $region) {
    return "INSERT INTO teams(teamId, teamName ,region) VALUES ('$teamId', '$teamName', '$region')";
}

function banner() {
    ?>
    <div id="banner">
        <h1>Tournament Esport</h1>
        <hr>
    </div>
    <?php
}

function navigator() {
    ?>
    <div id="navigator">
        | <a href="teams.php">Teams</a>
        | <a href="#">Players</a>
        | <a href="#">Games</a>
        | <a href="#">Logout</a>
        |
    </div>
<?php
}

function showError($message) {
    ?>
    <div style="width: 300px;
    background-color:#FAEBD7;
    padding:10px;
    border:1px solid red;
    margin:15px 0px;
    text-align: left;">
        <?php echo $message; ?>
    </div>
<?php
}

