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
                                $halaman = isset($_GET['page'])?(int)$_GET['page'] : 1;
                                $batas =5;
                                $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;
                                $previous = $halaman - 1;
                                $next = $halaman + 1;
                                $jumlah = getPlayerSqlCount()->fetch_array();
                                $total_halaman = ceil($jumlah['jml']/$batas);
                                if ($db->connect_errno == 0) {
                                if (getPlayerSql(0, 5)) {
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
                                        $data = getPlayerSql($halaman_awal,$batas)->fetch_all(MYSQLI_ASSOC);
                                        if (isset($_GET['search'])) {
                                            $halaman = isset($_GET['page'])?(int)$_GET['page'] : 1;
                                            $data = mysqli_query($db, "Select playerId, CONCAT(firstName, ' ', lastName) AS Name, country, gender, teamName from players JOIN teams ON players.teamId = teams.teamId WHERE CONCAT(firstName, ' ', lastName) LIKE '%" . $_GET['search'] . "%'");
                                            $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;
                                            $previous = $halaman - 1;
                                            $next = $halaman + 1;
                                            $jumlahSearch = getPlayerSearchSqlCount()->fetch_array();
                                            $total_halaman =  ceil($jumlahSearch['jml']/$batas);
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
                                        <li class="page-item">
                                            <a class="page-link" <?php if($halaman > 1){ echo "href='?page=$previous'"; } ?>>Previous</a>
                                        </li>
                                        <?php

                                        for($x=1;$x<=$total_halaman;$x++){
                                            if($total_halaman==1){
                                                $disabled="disabled";
                                            }else{
                                                $disabled="";
                                            }
                                            ?>
                                            <li class="page-item <?= $disabled; ?>"><a class="page-link" href="?page=<?php echo $x ?>"><?php echo $x; ?></a></li>
                                            <?php
                                        }
                                        ?>
                                        <li class="page-item">
                                            <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?page=$next'"; } ?>>Next</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
        </section>
    </div>
    <?php getFooter(); ?>
</div>
<script type="text/javascript">
    function doDelete(id) {
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
                        data: "id=" + id,
                        url: "../delete/players-delete.php",

                        success: function (response) {
                            if (response == 1) {
                                swal({
                                    title: "Success Deleted!",
                                    text: "You clicked the button!",
                                    icon: "success",
                                    button: "Aww yiss!",
                                })
                                    .then((value) => {
                                        location.reload();
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
                    swal("Your imaginary file is safe!");
                }
            });
    }
</script>
</body>
</html>
