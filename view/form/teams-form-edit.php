<?php
session_start();
require('../../functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Team</title>
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
                        <h4 class="mb-0 text-dark"> Edit Teams </h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../view/index-admin.php">Home</a></li>
                            <li class="breadcrumb-item active">Edit Teams</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <a class="btn btn-app btn-primary" href="../teams.php">
                <i class="fa fa-th-list"></i> View Data Teams
            </a>
            <?php
            if (isset($_GET['teamId'])) {
            $db = dbConnect();
            $teamId = $db->escape_string(openssl_decrypt($_GET["teamId"], "aes-128-cbc", $_SESSION["passphrase"], 0,$_SESSION["iv"]));
            if ($dataTeam = getDataTeams($teamId)) {
            ?>
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Form Edit Teams</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Team ID</label>
                                    <input type="text" class="form-control" id="text_id"  value="<?php echo $dataTeam["teamId"]; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Team Name</label>
                                    <input type="text" class="form-control" id="text_name" value="<?php echo $dataTeam["teamName"]; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Region</label>
                                    <input type="text" class="form-control" id="text_region" value="<?php echo $dataTeam["region"]; ?>">
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" onclick="doSave()" class="btn btn-primary">Submit</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
                <?php
            } else
                echo "Team with Id : $teamId is empty";
            } else
                echo "IdTeam is empty";
            ?>
            <!-- /.card -->
        </div>
    </div>


    <?php getFooter(); ?>

</div>
<script type="text/javascript">
    function doSave(){
        let id = $("#text_id").val();
        let name = $("#text_name").val();
        let region = $("#text_region").val();

        swal({
            title: "Are you sure?",
            text: "Once update, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willUpdate) => {
                if (willUpdate) {

                    $.ajax({
                        data : "id="+id+"&name="+name+"&region="+region,
                        url : "../../edit/teams-update.php",
                        type:"POST",
                        success: function(response){
                            if(response==1){
                                swal({
                                    title: "Success Updated!",
                                    text: "You clicked the button!",
                                    icon: "success",
                                    button: "OK!",
                                })
                                    .then((value) => {
                                        location.href="../teams.php";
                                    });

                            }else{
                                swal({
                                    title: "Fail Updated!",
                                    text: "You clicked the button!",
                                    icon: "error",
                                    button: "OK!",
                                })
                                    .then((value) => {
                                        location.href="../teams.php";
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
<!-- ./wrapper -->
</body>

</html>

