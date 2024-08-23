<?php
require_once('./pdo.php');
session_start();

if (! isset($_SESSION['email'])) {
    die('Not logged in');
}

$username = $_SESSION['email'];

$autos_stmt = $pdo->query("SELECT * FROM autos ORDER BY make");
$autos_stmt->execute();
$autos_len = $autos_stmt->rowCount();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>7d10a232 | Martin Steven Hernandez Ortiz</title>
</head>
<body>
    <h1>
        Tracking Automobiles
    </h1>
    <h3>
        Welcome back <?= htmlentities($username) ?>
    </h3>
    <h2>
        Current Tracking Automobiles
    </h2>
    <?php 
        if (isset($_SESSION['msg'])) {
    ?>
            <p style="color: darkgreen;">
                <?= htmlentities($_SESSION['msg']) ?>
            </p>
    <?php
            unset($_SESSION['msg']);
        }
    ?>
    <div>
        <a href="./add.php">Add New</a>
        |
        <a href="./login.php?logout=1">Logout</a>
    </div>
    <ul>
<?php
if ($autos_len > 0) {
    while ($auto_row = $autos_stmt->fetch()) {
?>
        <li>
            <?php if ($auto_row['img_url'] != '') { ?>
                <img 
                    width=100
                    height=100
                    src="<?= htmlentities($auto_row['img_url'])?>"
                    alt="car image">
            <?php }?>
            <?= htmlentities($auto_row['year']) ?>
            <?= htmlentities($auto_row['make']) ?> /
            <?= htmlentities($auto_row['mileage']) ?>
        </li>
<?php 
    }
} else { 
?>
        <li>No automobiles available</li>
<?php } ?>
    </ul>
</body>
</html>
