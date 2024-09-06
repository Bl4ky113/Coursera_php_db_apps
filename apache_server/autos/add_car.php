<?php
require_once('./pdo.php');

if (isset($_POST['logout'])) {
    header("Location: index.php");
    return "Redirecting...";
}

if (!isset($_GET['who'])) {
     die("Name parameter missing");
}

if ((!isset($_POST['make'])) || (strlen($_POST['make']) <= 0)) {
    header('Location: autos.php?who=' . urlencode($_GET['who']) . '&msg=' . base64_encode('Make is required'));
    return 1;
}

if ((!isset($_POST['mileage']) || !isset($_POST['year'])) || (!is_numeric($_POST['mileage']) || !is_numeric($_POST['year']))) {
    header('Location: autos.php?who=' . urlencode($_GET['who']) . '&msg=' . base64_encode('Mileage and year must be numeric'));
    return 1;
}

$add_car_stm = $pdo->prepare('INSERT INTO autos (make, year, mileage) VALUES (:mk, :yr, :ml)');
error_log('HELP');
$add_car_stmt->execute(array(
    ':mk' => $_POST['make'],
    ':yr' => $_POST['year'],
    ':ml' => $_POST['mileage'],
));

header('Location: autos.php?who=' . urlencode($_GET['who']) . '&msg=' . base64_encode('Record inserted'));
return 0;
?>
