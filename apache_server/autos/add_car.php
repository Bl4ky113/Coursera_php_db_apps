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

if ($_POST['img'] != '') {
    $url_headers = @get_headers($_POST['img']);

    if(!$url_headers || !strpos($url_headers[0], '200') || !strpos($url_headers[3], 'image/')) {
        header('Location: autos.php?who=' . urlencode($_GET['who']) . '&msg=' . base64_encode('Image URL must be valid'));
        return 1;
    } 
}

$add_car_stmt = $pdo->prepare('INSERT INTO autos (make, year, mileage, img_url) VALUES (:mk, :yr, :ml, :img)');
$add_car_stmt->execute(array(
    ':mk' => $_POST['make'],
    ':yr' => $_POST['year'],
    ':ml' => $_POST['mileage'],
    ':img' => $_POST['img']
));

header('Location: autos.php?who=' . urlencode($_GET['who']) . '&msg=' . base64_encode('Record inserted'));
return 0;
?>
