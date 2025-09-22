<?php
include "service/config.php";
session_start();

$login_message = "";

if (isset($_SESSION["is_login"])) {
    header("Location: dashboard.php");
    exit();
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hash_password = hash('sha256', $password);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$hash_password'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION["name"] = $data["name"];
        $_SESSION["role"] = $data["role"]; // simpen role ke session
        $_SESSION["is_login"] = true;

        if ($data["role"] == "admin") {
            header("Location: admin.php"); // redirect ke halaman admin
        } else {
            header("Location: dashboard.php"); // redirect ke dashboard biasa
        }
        exit();
    } else {
        $login_message = "<span class='error'>Username or password invalid</span>";
    }
    $db->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?= time()?>">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h3>Login Page</h3>
        <?php if (!empty($login_message)) : ?>
            <div class="message"><?= $login_message ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <input type="text" placeholder="Username" name="username" required />
            <input type="password" placeholder="Password" name="password" required />
            <button type="submit" name="login">Login</button>
        </form>
        <div class="link">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</body>
</html>