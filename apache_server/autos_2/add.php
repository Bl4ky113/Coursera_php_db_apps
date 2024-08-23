<?php
require_once('./pdo.php');
session_start();

if (! isset($_SESSION['email'])) {
    die('Not logged in');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (strlen($_POST['make']) <= 0) {
        $_SESSION['msg'] = 'Make is required';
        header('Location: add.php');
        return 1;
    }

    if (!is_numeric($_POST['mileage']) || !is_numeric($_POST['year'])) {
        $_SESSION['msg'] = 'Mileage and year must be numeric';
        header('Location: add.php');
        return 1;
    }

    if ($_POST['img'] != '') {
        $url_headers = @get_headers($_POST['img']);

        if(!$url_headers || !strpos($url_headers[0], '200') || !strpos($url_headers[3], 'image/')) {
            $_SESSION['msg'] = 'Image url must be valid';
            header('Location: add.php');
            return 1;
        } 
    }
    
    $add_car_stmt = $pdo->prepare('insert into autos (make, year, mileage, img_url) values (:mk, :yr, :ml, :img)');
    $add_car_stmt->execute(array(
        ':mk' => $_POST['make'],
        ':yr' => $_POST['year'],
        ':ml' => $_POST['mileage'],
        ':img' => $_POST['img']
    ));

    error_log('SUCCESSFULLY ADDED CAR: ' . $_POST['make'] . ' ' . $_POST['year'] . ' ' . $_POST['mileage']);
    $_SESSION['msg'] = 'Record inserted';
    header('Location: view.php');
    return 0;
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
                type="text">
        </div>
        <div>
            <label for="img">
                Image URL:
            </label>
            <input 
                id="img"
                name="img"
                placeholder="Car's Image URL"
                type="text">
        </div>
        <input
            value="Add"
            type="submit">
        <input
            value="logout"
            name="logout"
            type="submit">
    </form>
</body>
</html>
