<?php
define("DEVELOPMENT", true);
function dbConnect() {
    $db = new mysqli("localhost", "root", "","esport" );
    return $db;
}

function deleteDataTeams($teamId) {
    return "DELETE FROM teams WHERE teamId='$teamId'";
}

function updateDataTeams($teamId, $teamName, $region) {
    return "UPDATE teams SET teamId='$teamId', teamName='$teamName', region='$region' WHERE teamId='$teamId'";
}

function getDataTeams($teamId) {
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $sql = "SELECT * from teams WHERE teams.teamId = '$teamId'";
        $res = $db->query($sql);
        if ($res) {
            if ($res->num_rows > 0) {
                $data = $res->fetch_assoc();
                $res->free();
                return $data;
            } else
                return FALSE;
        } else
            return FALSE;
    } else
        return FALSE;
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
        <h1>Data Esport</h1>
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
        | <a href="logout.php">Logout</a>
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

