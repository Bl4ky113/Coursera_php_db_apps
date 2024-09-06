
<?php
require_once('../pdo.php');
session_start();

if (! isset($_SESSION['email'])) {
    die('ACCESS DENIED');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error_url = !isset($_POST['id']) ? 'add.php' : 'edit.php?id=' . $_POST['id'];

    if (strlen($_POST['make']) <= 0 || strlen($_POST['model']) <= 0) {
        $_SESSION['msg'] = 'All fields are required';
        header('Location: ' . $error_url);
        return 1;
    }

    if (!is_numeric($_POST['mileage']) || !is_numeric($_POST['year'])) {
        $_SESSION['msg'] = 'Mileage and year must be numeric';
        header('Location: ' . $error_url);
        return 1;
    }

    if (!isset($_POST['id'])) {
        $_SESSION['msg'] = 'Car id needed';
        header('Location: ' . $error_url);
        return 1;
    }

    $edit_car_stmt = $pdo->prepare('UPDATE autos SET make = :mk, model = :md, year = :yr, mileage = :ml WHERE autos_id = :id');
    $edit_car_stmt->execute(array(
        ':mk' => $_POST['make'],
        ':md' => $_POST['model'],
        ':yr' => $_POST['year'],
        ':ml' => $_POST['mileage'],
        ':id' => $_POST['id']
    ));

    error_log('SUCCESSFULLY EDITED CAR: ' . $_POST['make'] . ' ' . $_POST['year'] . ' ' . $_POST['mileage']);
    $_SESSION['msg'] = 'Record edited';
    header('Location: view.php');
    return 0;
}

$auto_row = NULL;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['id'])) {
        die('Car Id needed');
    }

    $autos_stmt = $pdo->prepare("SELECT * FROM autos WHERE autos_id = :id");
    $autos_stmt->execute(array(
        ':id' => $_GET['id']
    ));

    $auto_row = $autos_stmt->fetch();
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
        Tracking Automobiles
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
        <div>
            <label for="make">
                Make:       
            </label>
            <input 
                id="make"
                name="make"
                placeholder="Car's Make"
                value="<?= $auto_row != NULL ? $auto_row['make'] : '' ?>"
                type="text">
        </div>
        <div>
            <label for="model">
                Model:
            </label>
            <input 
                id="model"
                name="model"
                placeholder="Car's Model"
                value="<?= $auto_row != NULL ? $auto_row['model'] : '' ?>"
                type="text">
        </div>
        <div>
            <label for="year">
                Year:
            </label>
            <input 
                id="year"
                name="year"
                placeholder="Car's Year Model"
                value="<?= $auto_row != NULL ? $auto_row['year'] : '' ?>"
                type="text">
        </div>
        <div>
            <label for="mileage">
                Mileage:
            </label>
            <input 
                id="mileage"
                name="mileage"
                placeholder="Car's Mileage"
                value="<?= $auto_row != NULL ? $auto_row['mileage'] : '' ?>"
                type="text">
        </div>
        <input 
            name="id"
            value="<?= $auto_row != NULL ? $auto_row['autos_id'] : '' ?>"
            type="hidden">
        <input
            value="Save"
            type="submit">
        <input
            value="cancel"
            name="logout"
            type="submit">
    </form>
</body>
</html>
