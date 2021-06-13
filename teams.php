<?php
session_start();
if (!isset($_SESSION["playerId"]))
    header("Location: index.php?error=4");

require('./functions/functions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Teams</title>
</head>
<body>
<?php banner(); ?>
<?php navigator(); ?>
<h1>Data Teams</h1>
<?php
$db = dbConnect();
if ($db->errno == 0) {
    getTeamsSql();
    if (getTeamsSql()) {
        ?>
        <a href="./add/teams-form-add.php">
            <button>Add Team</button>
        </a>
        <table border="1">
            <tr>
                <td>Id Team</td>
                <td>Team Name</td>
                <td>Region</td>
                <td>Action</td>
            </tr>
            <?php
            $data = getTeamsSql()->fetch_all(MYSQLI_ASSOC); // ambil seluruh baris data
            foreach ($data as $barisdata) { // telurusi satu per satu
                ?>
                <tr>
                    <td><?php echo $barisdata["teamId"]; ?></td>
                    <td><?php echo $barisdata["teamName"]; ?></td>
                    <td><?php echo $barisdata["region"]; ?></td>
                    <td>
                        <a href="./edit/teams-form-edit.php?teamId=<?php echo urlencode(
                            openssl_encrypt(
                                $barisdata["teamId"],
                                'aes-128-cbc',
                                $_SESSION["passphrase"],
                                0,
                                $_SESSION["iv"]
                            )
                        ); ?>">
                            <button>Edit</button>
                        </a>
                        <a href="./delete/teams-confirm-delete.php?teamId=<?php echo urlencode(
                                openssl_encrypt(
                                        $barisdata["teamId"],
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
    } else {
        echo "Failed Execution SQL" . (DEVELOPMENT ? " : " . $db->error : "") . "<br>";
    }
} else {
    echo "Failed Connect" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
}
?>
</body>
</html>
