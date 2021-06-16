<?php
session_start();
require('../../functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Games</title>
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
                            <li class="breadcrumb-item"><a href="../games.php">Games</a></li>
                            <li class="breadcrumb-item active">Edit Game</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <a class="btn btn-app btn-primary" href="../games.php">
                <i class="fa fa-th-list"></i> View Data Games
            </a>

            <?php
            if (isset($_GET['gameId'])) {
            $db = dbConnect();
            $gameId = $db->escape_string(openssl_decrypt($_GET["gameId"], 'aes-128-cbc', $_SESSION["passphrase"], 0, $_SESSION["iv"]));
            if ($dataGames = getDataGames($gameId)) {
            ?>
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Form Edit Game</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="text_id"
                                           value="<?php echo $dataGames["gameId"]; ?>" hidden readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Game Name</label>
                                    <input type="text" class="form-control" id="text_game_name"
                                           value="<?php echo $dataGames["gameName"]; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Player</label>
                                    <select name="teamName" class="form-control" id="text_player">
                                        <option value="">Select Player Name</option>
                                        <?php
                                        $dataPlayer = getPlayerSql1();
                                        foreach ($dataPlayer as $data) {
                                            echo "<option value=\"" . $data["playerId"] . "\"";
                                            if ($data["playerId"] == $dataGames["playerId"])
                                                echo " selected";
                                            echo ">" . $data["Name"] . "</option>";
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
                echo "Games with id : $gameId is empty";
            } else
                echo "Games is empty";
            ?>
        </div>
    </div>
    <?php getFooter(); ?>
</body>
<script type="text/javascript">
    function doSave() {
        let id = $("#text_id").val();
        let gameName = $("#text_game_name").val();
        let playerId = $("#text_player").val();

        swal({
            title: "Are you sure?",
            text: "Once saved, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willInsert) => {
                if (willInsert) {

                    $.ajax({
                        data: "id=" + id + "&gameName=" + gameName + "&player=" + playerId,
                        url: "../../edit/games-update.php",
                        type: "POST",
                        success: function (response) {
                            if (response == 1) {
                                swal({
                                    title: "Success Inserted!",
                                    text: "You clicked the button!",
                                    icon: "success",
                                    button: "OK!",
                                })
                                    .then((value) => {
                                        location.href = "../games.php";
                                    });

                            } else {
                                swal({
                                    title: "Fail Deleted!",
                                    text: "You clicked the button!",
                                    icon: "error",
                                    button: "OK!",
                                })
                                    .then((value) => {
                                        location.href = "../games.php";
                                    });
                            }
                        }
                    })
                } else {
                    swal("Canceled!");
                }
            });
    }

</script>

</html>
