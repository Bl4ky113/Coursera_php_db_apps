<?php
session_start();

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['logout'])) {
        session_destroy();
        header("Location: index.php");
        return 1;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cancel'])) {
        header("Location: index.php");
        return 1;
    }

    if ((key_exists('email', $_POST) && $_POST['email'] === '') || (key_exists('pass', $_POST) && $_POST['pass'] === '')) {
        error_log("Login fail " . $_POST['email'] . " email/pwd missing");
        $_SESSION['msg'] = 'User name and password are required';
        header("Location: login.php");
        return 1;
    }

    if ($stored_hash !== hash('md5', $salt . $_POST['pass'])) {
        error_log("Login fail " . $_POST['email'] . " " . hash('md5', $salt . $_POST['pass']));
        $_SESSION['msg'] = 'Incorrect password';
        header("Location: login.php");
        return 1;
    }

    if (!str_contains($_POST['email'], '@')) {
        error_log("Login fail " . $_POST['email'] . " email err");
        $_SESSION['msg'] = 'Email must have an at-sign (@)';
        header("Location: login.php");
        return 1;
    }

    error_log("Login success " . $_POST['email']);
    $_SESSION['email'] = $_POST['email'];

    header('Location: ./autos/view.php');
    return 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>7d10a232 - Martin Steven Hernandez Ortiz</title>
  <style>
    * {
      font-family: Arial;
    }
  </style>
</head>
<body>
  <header>
    <h1>Login</h1>
  </header>
  <main>
    <?php 
        if (isset($_SESSION['msg'])) { 
    ?>
            <p style="color: red;">
                <?= htmlentities($_SESSION['msg']) ?>
            </p>
    <?php
            unset($_SESSION['msg']);
        } else {
    ?>
            <p>
                Enter your username and password to log in
            </p>
    <?php
        }
    ?>
    <form
      method="POST">
      <label for="username">
        Email:
      </label>
      <input
        id="username"
        name="email"
        type="text">
      <label for="password">
        User password:
      </label>
      <input
        id="password"
        name="pass"
        type="password">
      <br>
      <input
        value="Log In"
        type="submit">
      <input
        value="Cancel"
        name="cancel"
        type="submit">
    </form>
    <p>
      <!-- Hey, the password is: php123 -->
    </p>
  </main>
</body>
</html>
