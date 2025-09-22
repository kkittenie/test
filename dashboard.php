<?php
session_start();
if (!isset($_SESSION["is_login"])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

// Ambil nama dari session (sesuai dengan yang disimpan di login.php)
$name = isset($_SESSION["full_name"]) ? $_SESSION["full_name"] : "User";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?= time()?>">
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <h3>Welcome, <?= htmlspecialchars($name) ?>! 🥨🧸</h3>
        <form action="dashboard.php" method="POST">
            <button type="submit" name="logout">Logout</button>
        </form>
    </div>
</body>
</html>