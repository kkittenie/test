<?php
include "service/config.php";
session_start();

$register_message = "";

if (isset($_SESSION["is_login"])) {
    header("Location: dashboard.php");
    exit();
}

if (isset($_POST["register"])) {
    $full_name = $_POST["full_name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $hash_password = hash("sha256", $password);

    try {
        $sql = "INSERT INTO users (full_name, username, email, password) VALUES 
        ('$full_name', '$username', '$email', '$hash_password')";

        if ($db->query($sql)) {
            $register_message = "<span class='success'>Registration succeed 🎉 Please <a href='login.php'>login</a>.</span> ";
        } else {
            $register_message = "<span class='error'>Registration failed ❌ Try again.</span>";
        }
    } catch (mysqli_sql_exception) {
        $register_message = "<span class='error'>Username already used or not valid.</span>";
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
    <title>Register</title>

</head>
<body>
    <div class="container">
        <h3>Register Page</h3>
        <?php if (!empty($register_message)) : ?>
            <div class="message"><?= $register_message ?></div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <input type="text" placeholder="Full Name" name="full_name" required />
            <input type="text" placeholder="Username" name="username" required />
            <input type="text" placeholder="Email" name="email" required />
            <input type="password" placeholder="Password" name="password" required />
            <button type="submit" name="register">Sign Up</button>
                <div class="link">
                    <p>Already have an account? <a href="login.php">Login here</a></p>
                </div>
        </form>
    </div>
</body>
</html>

