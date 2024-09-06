<?php
require_once('../pdo.php');
session_start();

if (! isset($_SESSION['email'])) {
    die('ACCESS DENIED');
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
    <style>
        * {
            font-family: arial;
        }

        table {
            border: 1px solid black;
            border-collapse: separate;
        }

        table tr, 
        table td {
            border: 1px solid black;
        }
    </style>
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
        <a href="./add.php">Add New Entry</a>
    </div>
    <div>
        <a href="../login.php?logout=1">Logout</a>
    </div>
    <br>
    <table>
        <tr>
            <td>Year</td>
            <td>Make</td>
            <td>Model</td>
            <td>Mileage</td>
            <td>Options</td>
        </tr>
        <?php
        if ($autos_len > 0) {
            while ($auto_row = $autos_stmt->fetch()) {
        ?>
            <tr>
                <td>
                    <?= htmlentities($auto_row['year']) ?>
                </td>
                <td>
                    <?= htmlentities($auto_row['make'])?>
                </td>
                <td>
                    <?= htmlentities($auto_row['model'])?>
                </td>
                <td>
                    <?= htmlentities($auto_row['mileage']) ?>
                </td>
                <td>
                    <a href="./edit.php?id=<?= htmlentities($auto_row['autos_id']) ?>">
                        Edit
                    </a>
                    |
                    <a href="./delete.php?id=<?= htmlentities($auto_row['autos_id']) ?>">
                        Delete
                    </a>
                </td>
            </tr>
        <?php 
            }
        } else { 
        ?>
            <tr>
                <td>No cars available</td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
