<?php
require('../../functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Data Teams</title>
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
                        <h4 class="mb-0 text-dark"> Add Teams </h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../index-admin.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="../teams.php">Teams</a></li>
                            <li class="breadcrumb-item active">Add Teams</li>
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
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Form Add Teams</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Team ID</label>
                                        <input type="text" class="form-control" id="text_id" placeholder="Enter TeamID" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Team Name</label>
                                        <input type="text" class="form-control" id="text_name" placeholder="Enter Team Name" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Region</label>
                                        <input type="text" class="form-control" id="text_region" placeholder="Enter Region" required="required">
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


        if (id == "") {
            swal({
                title: "Error!",
                text: "Must Fill The Team ID",
                icon: "error",
                button: "OK!",
            })
            return false;
        } else
            if (name == "") {
            swal({
                title: "Error!",
                text: "Must Fill Team Name",
                icon: "error",
                button: "OK!",
            })
            return false;
        } else
            if (region == "") {
            swal({
                title: "Error!",
                text: "Must Fill Region",
                icon: "error",
                button: "OK!",
            })
            return false;
        }



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
                        data : "id="+id+"&name="+name+"&region="+region,
                        url : "../../add/teams-add.php",
                        type:"POST",
                        success: function(response){
                            if(response == 1){
                                swal({
                                    title: "Success Inserted!",
                                    text: "You clicked the button!",
                                    icon: "success",
                                    button: "OK!",
                                })
                                    .then((value) => {
                                        location.href="../teams.php";
                                    });

                            } else {
                                swal({
                                    title: "Fail Deleted!",
                                    text: "Failed Delete Data!",
                                    icon: "error",
                                    button: "OK!",
                                })
                                    .then((value) => {
                                        location.reload();
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

