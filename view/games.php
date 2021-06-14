<?php
session_start();
if (!isset($_SESSION["playerId"]))
    header("Location: index.php?error=4");
require('../functions/functions.php');
?>

<!DOCTYPE html>
<htmL>
<head>
    <title>Games</title>
</head>
<body>
<?php banner(); ?>
<?php navigator(); ?>
<h1>View Games Played By Players</h1>
<?php
$db = dbConnect();
if ($db->connect_errno == 0) {
    getGamesSql();
    if (getGamesSql()) {
        ?>
        <a href="form/games-form-add.php">
            <button>Add Game</button>
        </a>
        <table border="1">
            <tr>
                <td>Name</td>
                <td>Game</td>
                <td>TeamName</td>
                <td>Region</td>
                <td>Action</td>
            </tr>
            <?php
            $data = getGamesSql();
            foreach ($data as $barisData) {
                ?>
                <tr>
                    <td><?php echo $barisData["name"]; ?></td>
                    <td><?php echo $barisData["gamesName"]; ?></td>
                    <td><?php echo $barisData["teamName"]; ?></td>
                    <td><?php echo $barisData["region"]; ?></td>
                    <td>
                        <a href="../view/form/games-form-edit.php?gamesId=<?php echo urlencode(
                            openssl_encrypt(
                                $barisData["gamesId"],
                                'aes-128-cbc',
                                $_SESSION["passphrase"],
                                0,
                                $_SESSION["iv"]
                            )
                        ); ?>">
                            <button>Edit</button>
                        </a>
                        <a href="../view/confirm/games-confirm-delete.php?gamesId=<?php echo urlencode(
                            openssl_encrypt(
                                $barisData["gamesId"],
                                'aes-128-cbc',
                                $_SESSION["passphrase"],
                                0,
                                $_SESSION["iv"]
                            )
                        ); ?>">
                            <button>Hapus</button>
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
</htmL>
