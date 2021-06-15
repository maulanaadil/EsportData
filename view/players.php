<?php
session_start();
if (!isset($_SESSION["playerId"]))
    header("Location: ../index.php?error=4");
require('../functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Players</title>
    <?php template() ?>
</head>
<body>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <?php getMenu(); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="mb-0 text-dark"> Data Players </h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../view/index-admin.php">Home</a></li>
                            <li class="breadcrumb-item active">Players</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                        <span class="fa-pull-right">
                            <a class="btn btn-app btn-primary" href="form/players-form-add.php">
                                <i class="fas fa-plus"></i> Add Players
                            </a>

                            <a class="btn btn-app btn-primary" href="players.php">
                                <i class="fa fa-sync"></i> Refresh
                            </a>

                        </span>
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header">

                                <h3 class="card-title">Data Players</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <form method="get" action="">
                                            <input type="text" name="search" class="form-control float-right"
                                                   placeholder="Search">

                                        </form>
                                    </div>
                                </div>

                                <br>
                                <?php
                                $db = dbConnect();
                                if ($db->connect_errno == 0) {
                                if (getPlayerSql()) {
                                ?>
                                <div class="card-body table-responsive p-0">
                                    <hr>
                                    <table class="table table-hover text-nowrap table-sm table-striped">
                                        <thead>
                                        <tr>
                                            <th>Player Id</th>
                                            <th>Name</th>
                                            <th>Country</th>
                                            <th>Gender</th>
                                            <th>Team</th>
                                            <th width="50">Action</th>
                                        </tr>
                                        </thead>
                                        <?php
                                        $data = getPlayerSql();
                                        if (isset($_GET['search'])) {
                                            $data = mysqli_query($db, "Select playerId, CONCAT(firstName, ' ', lastName) AS Name, country, gender, teamName from players JOIN teams ON players.teamId = teams.teamId WHERE CONCAT(firstName, ' ', lastName) LIKE '%" . $_GET['search'] . "%'");
                                        }
                                        foreach ($data as $barisData) {
                                            ?>
                                            <tbody>
                                            <tr>
                                                <td><?php echo $barisData["playerId"]; ?></td>
                                                <td><?php echo $barisData["Name"]; ?></td>
                                                <td><?php echo $barisData["country"]; ?></td>
                                                <td><?php echo $barisData["gender"]; ?></td>
                                                <td><?php echo $barisData["teamName"]; ?></td>
                                                <td>
                                                    <a href="../view/form/players-form-edit.php?playerId=<?php echo urlencode(
                                                        openssl_encrypt(
                                                            $barisData["playerId"],
                                                            'aes-128-cbc',
                                                            $_SESSION["passphrase"],
                                                            0,
                                                            $_SESSION["iv"]
                                                        )
                                                    ); ?>" class="btn btn-warning btn-xs">
                                                        <i class="fa fa-edit"
                                                           style="margin-left: 5px;margin-right: 5px;color : #fff"></i>
                                                    </a>
                                                    <button onclick="doDelete('<?= $barisData['playerId']; ?>')"
                                                            class="btn btn-danger btn-xs">
                                                        <i class="fa fa-trash"
                                                           style="margin-left: 5px;margin-right: 5px;color : #fff"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                    <?php
                                    } else
                                        echo "Failed Execution SQL" . (DEVELOPMENT ? " : " . $db->error : "") . "<br>";
                                    } else
                                        echo "Failed Connect" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
                                    ?>
                                </div>

                                <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
        </section>
    </div>
    <?php getFooter(); ?>
</div>
<script type="text/javascript">
    function doDelete(id){
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        data : "id="+id,
                        url : "../delete/players-delete.php",

                        success: function(response){
                            if(response===1){
                                swal({
                                    title: "Success Deleted!",
                                    text: "You clicked the button!",
                                    icon: "success",
                                    button: "Aww yiss!",
                                })
                                    .then((value) => {
                                        location.reload();
                                    });

                            }else{
                                swal({
                                    title: "Fail Deleted!",
                                    text: "You clicked the button!",
                                    icon: "danger",
                                    button: "Aww yiss!",
                                })
                                    .then((value) => {
                                        location.reload();
                                    });
                            }
                        }
                    })
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
    }
</script>
</body>
</html>
