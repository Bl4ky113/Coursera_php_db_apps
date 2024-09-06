<?php
require_once('./pdo.php');
//error_log(implode(',', $_REQUEST));

if (isset($_POST['logout'])) {
    header("Location: index.php");
    return "Redirecting...";
}

if (!isset($_GET['who'])) {
     die('Name parameter missing');
}

$msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = false;
    if (strlen($_POST['make']) <= 0) {
        //header('location: autos.php?who=' . urlencode($_GET['who']) . '&msg=' . base64_encode('make is required'));
        //return 1;
        $msg = 'Make is required';
        $error = true;
    }

    if (!is_numeric($_POST['mileage']) || !is_numeric($_POST['year'])) {
        //header('location: autos.php?who=' . urlencode($_GET['who']) . '&msg=' . base64_encode('mileage and year must be numeric'));
        //return 1;
        $msg = 'Mileage and year must be numeric';
        $error = true;
    }
    
    if ($error == false) {
        $add_car_stmt = $pdo->prepare('INSERT INTO autos (make, year, mileage) VALUES (:mk, :yr, :ml)');
        $make = str_replace(';', '', $_POST['make']);
        $add_car_stmt->execute(array(
            ':mk' => $make,
            ':yr' => $_POST['year'],
            ':ml' => $_POST['mileage'],
        ));

        //header('location: autos.php?who=' . urlencode($_GET['who']) . '&msg=' . base64_encode('record inserted'));
        //return 0;
        $msg = 'Record inserted';
        error_log('SUCCESSFULLY ADDED CAR: ' . $_POST['make'] . ' ' . $_POST['year'] . ' ' . $_POST['mileage']);
    }
}

$autos_stmt = $pdo->query("SELECT * FROM autos ORDER BY make");
$autos_stmt->execute();
$autos_len = $autos_stmt->rowCount();

if (isset($_GET['msg'])) {
    $msg = base64_decode($_GET['msg']);
}
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
        Welcome back <?= htmlentities($_GET['who']) ?>
    </h3>
    <form
        id="car-form"
        method="POST"
        action="">
        <p>
            <?= $msg ?>
        </p>
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
        <input
            value="Add"
            type="submit">
        <input
            value="logout"
            name="logout"
            type="submit">
    </form>
    <hr>
    <h2>
        Current Tracking Automobiles
    </h2>
    <ul>
<?php
if ($autos_len > 0) {
    while ($auto_row = $autos_stmt->fetch()) {
?>
        <li>
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
    <script src="./src/js/script.js"></script>
</body>
</html>
