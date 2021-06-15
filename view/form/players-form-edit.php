<?php
session_start();
require('../../functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Player</title>
    <?php templateAdd(); ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <?php getMenuAdd(); ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="mb-0 text-dark"> Edit Game </h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../index-admin.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="../players.php">Players</a></li>
                            <li class="breadcrumb-item active">Edit Player</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <a class="btn btn-app btn-primary" href="../players.php">
                <i class="fa fa-th-list"></i> View Data Players
            </a>
            <?php
            if (isset($_GET['playerId'])) {
                $db = dbConnect();
                $playerId = $db->escape_string(openssl_decrypt($_GET["playerId"], 'aes-128-cbc', $_SESSION["passphrase"], 0, $_SESSION["iv"]));
                if ($dataPlayer = getDataPlayers($playerId)) {
                    ?>
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                <!-- general form elements -->
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Form Edit Players</h3>
                                    </div>

                                    <!-- /.card-header -->
                                    <!-- form start -->

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Player ID</label>
                                            <input type="text" class="form-control" id="text_id"
                                                   value="<?php echo $dataPlayer["playerId"]; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Last Name</label>
                                            <input type="text" class="form-control" id="text_last_name"
                                                   value="<?php echo $dataPlayer["lastName"]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">First Name</label>
                                            <input type="text" class="form-control" id="text_first_name"
                                                   value="<?php echo $dataPlayer["firstName"]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Country</label>
                                            <input type="text" class="form-control" id="text_country"
                                                   value="<?php echo $dataPlayer["country"]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Gender</label>
                                            <select name="gender" class="form-control" id="text_gender">
                                                <option value="">Select Gender</option>
                                                <option value="male" <?php if ($dataPlayer["gender"] == "male") { ?> selected="selected" <?php } ?>>
                                                    Male
                                                </option>
                                                <option value="female" <?php if ($dataPlayer["gender"] == "female") { ?> selected="selected" <?php } ?>>
                                                    Female
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Team</label>
                                            <select name="teamName" class="form-control" id="text_team">
                                                <option value="">Select Your Team</option>
                                                <?php
                                                $dataTeam = getTeamsSql();
                                                foreach ($dataTeam as $data) {
                                                    echo "<option value=\"" . $data["teamId"] . "\"";
                                                    if ($data["teamId"] == $dataPlayer["teamId"])
                                                        echo " selected";
                                                    echo ">" . $data["teamName"] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" onclick="doSave()" class="btn btn-primary">Submit</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } else
                    echo "Team with Id : $playerId is empty";
            } else
                echo "IdTeam is empty";
            ?>
            <!-- /.card -->
        </div>
    </div>
    <?php getFooter(); ?>

</div>

<script>
    // TODO: ADD SCRIPT GAN
</script>
</body>
</html>
