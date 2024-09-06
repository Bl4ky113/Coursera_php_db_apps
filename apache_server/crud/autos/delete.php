<?php
require_once('../pdo.php');
session_start();

if (! isset($_SESSION['email'])) {
    die('ACCESS DENIED');
}

$auto_row = NULL;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['id'])) {
        die('Bad value for id');
    }

    if (isset($_POST['cancel'])) {
        header('Location: view.php');
        return 0;
    }

    $del_auto_stmt = $pdo->prepare("DELETE FROM autos WHERE autos_id = :id");
    $del_auto_stmt->execute(array(':id' => $_POST['id']));
    
    $_SESSION['msg'] = 'Record deleted';
    header('Location: view.php');
    return 0;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['id'])) {       
        die("Bad value for id");
    }
    $autos_stmt = $pdo->prepare("SELECT * FROM autos WHERE autos_id = :id");
    $autos_stmt->execute(array(
        ':id' => $_GET['id']
    ));

    $auto_row = $autos_stmt->fetch();

    if ($auto_row == NULL) {
        die("Bad value for id");
    }
}

$username = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>7d10a232 | Martin Steven Hernandez Ortiz</title>
</head>
<body>
    <h1>
        Deleting Automobiles
    </h1>
    <h3>
        What's new <?= htmlentities($username) ?>?
    </h3>
    <?php 
        if (isset($_SESSION['msg'])) {
    ?>
            <p style="color: red;">
                <?= htmlentities($_SESSION['msg']) ?>
            </p>
    <?php
            unset($_SESSION['msg']);
        }
    ?>
    <form
        id="car-form"
        method="POST"
        action="">
        <p>
            Are you sure that you want to delete <?= htmlentities($auto_row['year'] . ' - ' . $auto_row['make'] . ' ' . $auto_row['model'] . ' (' . $auto_row['mileage']) . ')' ?>
        </p>
        <input 
            name="id"
            value="<?= $auto_row != NULL ? $auto_row['autos_id'] : '' ?>"
            type="hidden">
        <input
            value="Delete"
            type="submit">
        <input
            value="Cancel"
            name="cancel"
            type="submit">
    </form>
</body>
</html>
