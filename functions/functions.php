<?php
define("DEVELOPMENT", true);
function dbConnect()
{
    $db = new mysqli("localhost", "root", "", "esport");
    return $db;
}

//Password
function getPassword($playerId) {
    return "SELECT password from players WHERE players.playerId = '$playerId'";

}

//DASHBOARD
function getCountPlayers() {
    $db = dbConnect();
    $sql = "SELECT count(*) as jml from players";
    $res = $db->query($sql);
    $data = $res->fetch_array();
    return $data['jml'];

}
function getCountGames() {
    $db = dbConnect();
    $sql = "SELECT count(*) as jml from games";
    $res = $db->query($sql);
    $data = $res->fetch_array();
    return $data['jml'];
}
function getCountTeams() {
    $db = dbConnect();
    $sql = "SELECT count(*) as jml from teams";
    $res = $db->query($sql);
    $data = $res->fetch_array();
    return $data['jml'];
}

// Games
function deleteDataGames($gamesId) {
    return "DELETE FROM games WHERE gamesId = '$gamesId'";
}

function updateDataGames($gamesId ,$gamesName, $playerId) {
     return "UPDATE games SET gamesName = '$gamesName', playerId = '$playerId' WHERE games.gamesId = '$gamesId'";
}

function getDataGames($gamesId) {
    $db = dbConnect();
    if ($db->connect_errno == 0 ) {
        $sql = "SELECT games.gamesId, games.gamesName, CONCAT(players.firstName, ' ',players.lastName) as Name, games.playerId FROM games, players WHERE games.gamesId = '$gamesId' AND games.playerId = players.playerId";
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

function addGamesSql($gamesName, $playerId)
{
    return "INSERT INTO games(gamesName, playerId) VALUES ('$gamesName','$playerId')";
}

function getGamesSql()
{
    $db = dbConnect();
    $sql = "SELECT games.gamesId, CONCAT(players.firstName, ' ',players.lastName) as name, games.gamesName, teams.teamName, teams.region
            FROM games, players, teams
            WHERE games.playerId = players.playerId AND players.teamId= teams.teamId";
    return $db->query($sql);
}

// Players
function deleteDataPlayers($playerId)
{
    return "DELETE FROM players WHERE playerId='$playerId'";
}

function updateDataPlayer($playerId, $lastName, $firstName, $country, $teamId, $gender)
{

    return "UPDATE players 
            SET playerId = '$playerId', lastName = '$lastName', 
                firstName = '$firstName', country = '$country', 
                teamId = '$teamId', gender = '$gender' 
            WHERE playerId = '$playerId'";
}

function getDataPlayers($playerId)
{
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $sql = "SELECT players.playerId, players.lastName, players.firstName, players.country, teams.teamId, players.gender, teams.teamName FROM players JOIN teams ON players.teamId = teams.teamId WHERE playerId = '$playerId';";
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
    return $db->query($sql);
}

// Teams
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
    return $db->query($sql);
}

function addTeamsSql($teamId, $teamName, $region)
{
    return "INSERT INTO teams(teamId, teamName ,region) VALUES ('$teamId', '$teamName', '$region')";
}

// Any

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
        | <a href="../view/index-admin.php">Home</a>
        | <a href="../../tugasAtol/view/teams.php">Teams</a>
        | <a href="../../tugasAtol/view/players.php">Players</a>
        | <a href="../../tugasAtol/view/games.php">Games</a>
        | <a href="../logout.php">Logout</a>
        |
    </div>
    <?php
}

function showError($message)
{
    ?>
    <p class="login-box-msg text-danger">
        <i class="fa fa-ban"></i> <?php echo $message; ?>
    </p>

    <?php
}

function templateAdd(){
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
    <link rel="stylesheet" href="../../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <script src="../../assets/plugins/jquery/jquery.min.js"></script>
    <script src="../../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="../../assets/js/adminlte.js"></script>
    <script src="../../assets/js/sweetalert.min.js"></script>
<?php
}

function template(){
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="../assets/js/adminlte.js"></script>
    <script src="../assets/js/sweetalert.min.js"></script>
<?php
}


function getMenuAdd(){
    ?>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->

            <!-- Notifications Dropdown Menu -->

            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-door-open"></i> Logout
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <span class="brand-text font-weight-light"><i class="fa fa-gamepad"></i> E-SPORT</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open">
                        <a href="../../view/index-admin.php" class="nav-link active">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Home
                            </p>
                        </a>

                    </li>
                    <li class="nav-item has-treeview menu-open">
                        <a href="../view/teams.php" class="nav-link active">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>
                                Teams
                            </p>
                        </a>

                    </li>
                    <li class="nav-item has-treeview menu-open">
                        <a href="../../view/players.php" class="nav-link active">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Players
                            </p>
                        </a>

                    </li>
                    <li class="nav-item has-treeview menu-open">
                        <a href="../../view/games.php" class="nav-link active">
                            <i class="nav-icon fas fa-gamepad"></i>
                            <p>
                                Games
                            </p>
                        </a>

                    </li>

                </ul l>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
<?php
}

function getMenu(){
    ?>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->

            <!-- Notifications Dropdown Menu -->

            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-door-open"></i> Logout
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <span class="brand-text font-weight-light"><i class="fa fa-gamepad"></i> E-SPORT</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open">
                        <a href="../view/index-admin.php" class="nav-link active">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Home
                            </p>
                        </a>

                    </li>
                    <li class="nav-item has-treeview menu-open">
                        <a href="../view/teams.php" class="nav-link active">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>
                                Teams
                            </p>
                        </a>

                    </li>
                    <li class="nav-item has-treeview menu-open">
                        <a href="../view/players.php" class="nav-link active">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Players
                            </p>
                        </a>

                    </li>
                    <li class="nav-item has-treeview menu-open">
                        <a href="../view/games.php" class="nav-link active">
                            <i class="nav-icon fas fa-gamepad"></i>
                            <p>
                                Games
                            </p>
                        </a>

                    </li>

                </ul l>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
<?php
}


function getFooter(){
    ?>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; <?= date("Y"); ?> <a target="_blank" href="https://github.com/maulanaadil">Maulana Adil</a>.</strong>
        All rights reserved.
    </footer>

    <?php
}

