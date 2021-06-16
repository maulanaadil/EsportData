<?php
require('../../functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Data Player</title>
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
                        <h4 class="mb-0 text-dark"> Add Player </h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../index-admin.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="../players.php">Players</a></li>
                            <li class="breadcrumb-item active">Add Player</li>
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
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Form Add Players</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Player ID</label>
                                    <input type="text" class="form-control" id="text_id" placeholder="Enter Player ID">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="text_password"
                                           placeholder="Enter Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Last Name</label>
                                    <input type="text" class="form-control" id="text_last_name"
                                           placeholder="Enter Last Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">First Name</label>
                                    <input type="text" class="form-control" id="text_first_name"
                                           placeholder="Enter First Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Country</label>
                                    <input type="text" class="form-control" id="text_country"
                                           placeholder="Enter Country">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Gender</label>
                                    <select name="gender" class="form-control" id="text_gender">
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Team</label>
                                    <select name="teamName" class="form-control" id="text_team">
                                        <option value="">Select Your Team</option>
                                        <?php
                                        $dataTeam = getTeamSql1();
                                        foreach ($dataTeam as $data) {
                                            echo "<option value=\"" . $data["teamId"] . "\">" . $data["teamName"] . "</option>";
                                        }
                                        ?>
                                    </select>
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
    function doSave() {
        let id = $("#text_id").val();
        let password = $("#text_password").val();
        let lastName = $("#text_last_name").val();
        let firstName = $("#text_first_name").val();
        let country = $("#text_country").val();
        let gender = $("#text_gender").val();
        let team = $("#text_team").val();


        if (id == "") {
            swal({
                title: "Error!",
                text: "Must Fill The Team ID",
                icon: "error",
                button: "OK!",
            })
            return false;
        } else if (password == "") {
            swal({
                title: "Error!",
                text: "Must Fill Password",
                icon: "error",
                button: "OK!",
            })
            return false;
        } else if (lastName == "") {
            swal({
                title: "Error!",
                text: "Must Fill LastName",
                icon: "error",
                button: "OK!",
            })
            return false;
        } else if (firstName == "") {
            swal({
                title: "Error!",
                text: "Must Fill FirstName",
                icon: "error",
                button: "OK!",
            })
            return false;
        } else if (country == "") {
            swal({
                title: "Error!",
                text: "Must Fill Country",
                icon: "error",
                button: "OK!",
            })
            return false;
        } else if (gender == "") {
            swal({
                title: "Error!",
                text: "Must Select Gender",
                icon: "error",
                button: "OK!",
            })
            return false;
        } else if (team == "") {
            swal({
                title: "Error!",
                text: "Must Select Team",
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
                        data: "id=" + id + "&password=" + password + "&lastName=" + lastName + "&firstName=" + firstName + "&country=" + country + "&gender=" + gender + "&team=" + team,
                        url: "../../add/players-add.php",
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
                                        location.href = "../players.php";
                                    });

                            } else {
                                swal({
                                    title: "Fail Deleted!",
                                    text: "You clicked the button!",
                                    icon: "error",
                                    button: "OK!",
                                })
                                    .then((value) => {
                                        location.href = "../players.php";
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
