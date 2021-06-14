<?php
define("DEVELOPMENT", true);
function dbConnect()
{
    $db = new mysqli("localhost", "root", "", "esport");
    return $db;
}

function updateDataPlayer($playerId, $lastName, $firstName, $country, $teamId, $gender)
{

    $sql = "UPDATE players 
            SET playerId = '$playerId', lastName = '$lastName', 
                firstName = '$firstName', country = '$country', 
                teamId = '$teamId', gender = '$gender' 
            WHERE playerId = '$playerId'";
    return $sql;
}

function getDataPlayers($playerId)
{
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $sql = "SELECT players.playerId, players.lastName, players.firstName, players.country, teams.teamId, players.gender FROM players JOIN teams ON players.teamId = teams.teamId WHERE playerId = '$playerId';";
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

function addPlayerSql($playerId, $lastName, $firstName, $country, $teamId, $gender, $password)
{
    return "INSERT INTO players(playerId, lastName, firstName, country, teamId, gender, password) VALUES ('$playerId', '$lastName', '$firstName', '$country', '$teamId', '$gender', '$password')";
}

function getPlayerSql()
{
    $db = dbConnect();
    $sql = "Select playerId, CONCAT(firstName, ' ', lastName) AS Name, country, gender, teamName from players JOIN teams WHERE players.teamId = teams.teamId";
    $res = $db->query($sql);
    return $res;
}

function deleteDataTeams($teamId)
{
    return "DELETE FROM teams WHERE teamId='$teamId'";
}

function updateDataTeams($teamId, $teamName, $region)
{
    return "UPDATE teams SET teamId='$teamId', teamName='$teamName', region='$region' WHERE teamId='$teamId'";
}

function getDataTeams($teamId)
{
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

function getTeamsSql()
{
    $db = dbConnect();
    $sql = "SELECT * FROM teams ";
    $res = $db->query($sql);
    return $res;
}

function addTeamsSql($teamId, $teamName, $region)
{
    return "INSERT INTO teams(teamId, teamName ,region) VALUES ('$teamId', '$teamName', '$region')";
}


function banner()
{
    ?>
    <div id="banner">
        <h1>Data Esport</h1>
        <hr>
    </div>
    <?php
}

function navigator()
{
    ?>
    <div id="navigator">
        | <a href="../../tugasAtol/view/teams.php">Teams</a>
        | <a href="../../tugasAtol/view/players.php">Players</a>
        | <a href="#">Games</a>
        | <a href="#">Change Password</a>
        | <a href="../logout.php">Logout</a>
        |
    </div>
    <?php
}

function showError($message)
{
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

