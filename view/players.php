<?php
session_start();
if (!isset($_SESSION["playerId"]))
    header("Location: index.php?error=4");
require('../functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Players</title>
</head>
<body>
<?php banner(); ?>
<?php navigator(); ?>
<h1>Data Players</h1>
<?php
$db = dbConnect();
if ($db->connect_errno == 0) {
    getPlayerSql();
    if (getPlayerSql()) {
        ?>
    <a href="form/players-form-add.php"><button>Add Player</button>
    </a>
    <table border="1">
        <tr>
            <td>Player Id</td>
            <td>Name</td>
            <td>Country</td>
            <td>Gender</td>
            <td>Team</td>
            <td>Action</td>
        </tr>
            <?php
            $data = getPlayerSql();
            foreach ($data as $barisData) {
                ?>
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
                    ); ?>">
                        <button>Edit</button>
                    </a>
                    <a href="../view/confirm/players-confirm-delete.php?playerId=<?php echo urlencode(
                        openssl_encrypt(
                            $barisData["playerId"],
                            'aes-128-cbc',
                            $_SESSION["passphrase"],
                            0,
                            $_SESSION["iv"]
                        )
                    ); ?>">
                        <button>Hapus</button>
                    </a>
                </td>
            </tr>
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
</body>
</html>
