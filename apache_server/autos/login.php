
<?php
function handle_login () {
    $salt = 'XyZzy12*_';
    $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';

    if (count($_POST) <= 0) {
        return 'Enter your username and password to log in';
    }

    if (isset($_POST['cancel'])) {
        header("Location: index.php");
        return "Redirecting...";
    }

    if ((key_exists('who', $_POST) && $_POST['who'] === '') || (key_exists('pass', $_POST) && $_POST['pass'] === '')) {
        return 'User name and password are required';
    }

    if ($stored_hash !== hash('md5', $salt . $_POST['pass'])) {
        error_log("Login fail " . $_POST['who'] . " " . hash('md5', $salt . $_POST['pass']));
        return 'Incorrect password';
    }

    if (!str_contains($_POST['who'], '@')) {
        return 'Email must have an at-sign (@)';
    }

    error_log("Login success " . $_POST['who']);
    header("Location: autos.php?who=" . urlencode($_POST['who']));
    return 'Redirecting...';
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
    <p>
      <b><?= handle_login() ?></b>
    </p>
    <form
      method="POST">
      <label for="username">
        Email:
      </label>
      <input
        id="username"
        name="who"
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
