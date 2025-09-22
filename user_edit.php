<?php
include_once "service/config.php";

// Inisialisasi variabel
$fullname = '';
$username = '';
$email = '';
$password = '';
$id = '';

// Cek action dari URL
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Jika action adalah edit, ambil data user berdasarkan ID
if ($action == 'edit' && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($db, $_GET['id']);
    $query = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $fullname = $row['full_name'];
        $username = $row['username'];
        $email = $row['email'];
        $password = $row['password'];
    } else {
        echo "<script>
            alert('User invalid!');
            document.location = 'index.php?page=user';
        </script>";
        exit;
    }
}

// Proses ketika form disubmit
if (isset($_POST['save'])) {
    // Ambil data dari form dan escape untuk keamanan
    $username_new = mysqli_real_escape_string($db, $_POST['username']);
    $fullname_new = mysqli_real_escape_string($db, $_POST['name']);
    $email_new = mysqli_real_escape_string($db, $_POST['email']);
    $password_new = isset($_POST['password']) ? $_POST['password'] : '';
    $id_edit = mysqli_real_escape_string($db, $_POST['id']); // Ambil ID dari hidden input

    // Validasi input
    if (!empty($username_new) && !empty($fullname_new) && !empty($email_new)) {
        // Cek apakah username sudah digunakan oleh user lain
        $check_query = "SELECT * FROM users WHERE username = '$username_new' AND id != '$id_edit'";
        $check_result = mysqli_query($db, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            echo "<script>
                alert('Username already exist!');
            </script>";
        } else {
            // Siapkan query update
            if (!empty($password_new)) {
                // Jika password diisi, update beserta password
                $hash_password = hash("sha256", $password_new);
                $update_query = "UPDATE users SET 
                    username = '$username_new', 
                    full_name = '$fullname_new', 
                    email = '$email_new', 
                    password = '$hash_password' 
                    WHERE id = '$id_edit'";
            } else {
                // Jika password kosong, update tanpa password
                $update_query = "UPDATE users SET 
                    username = '$username_new', 
                    full_name = '$fullname_new', 
                    email = '$email_new' 
                    WHERE id = '$id_edit'";
            }

            // Eksekusi query update
            $update_result = mysqli_query($db, $update_query);

            if ($update_result) {
                // Cek apakah ada baris yang ter-update
                if (mysqli_affected_rows($db) > 0) {
                    echo "<script>
                        alert('User edited successfully!');
                        document.location = 'index.php?page=user';
                    </script>";
                } else {
                    echo "<script>
                        alert('Action invalid!');
                    </script>";
                }
            } else {
                echo "<script>
                    alert('Action invalid: " . mysqli_error($db) . "');
                </script>";
            }
        }
    } else {
        echo "<script>
            alert('Please fill all field!');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?= time()?>">
    <title>User Edit</title>
</head>
<body>
    <div class="container">
        <h3>User Edit</h3>
        <?php if ($action == 'edit' && !empty($id)): ?>
        <form action="user_edit.php" method="POST">
            <!-- Hidden input untuk menyimpan ID -->
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>" />
            
            <input type="text" 
                   name="username" 
                   placeholder="Username"
                   value="<?php echo htmlspecialchars($username); ?>" 
                   required />
            
            <input type="text" 
                   name="name" 
                   placeholder="Full Name"
                   value="<?php echo htmlspecialchars($fullname); ?>" 
                   required />
            
            <input type="email" 
                   name="email" 
                   placeholder="Email"
                   value="<?php echo htmlspecialchars($email); ?>" 
                   required />
            
            <input type="password" 
                   name="password" 
                   placeholder="Password" />
            
            <button type="submit" name="save">Edit</button>
            
        </form>
        <?php else: ?>
        <p>User ID invalid or username already exist.</p>
        <a href="index.php?page=user">Back to user management</a>
        <?php endif; ?>
    </div>
</body>
</html>