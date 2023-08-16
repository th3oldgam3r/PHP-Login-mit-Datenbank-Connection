<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Daten aus der Datenbank abrufen
    $sql = "SELECT id FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
    } else {
        $login_error = "Ungültige Anmeldeinformationen";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Benutzername"><br>
        <input type="password" name="password" placeholder="Passwort"><br>
        <button type="submit">Anmelden</button>
    </form>
    <?php if(isset($login_error)) { echo $login_error; } ?>
</body>

</html>