<?php 

include_once 'service/config.php';

$id = $_GET['id'];

if ($id == '') {
    echo "<script>
        alert('User invalid.');
        document.location='index.php?page=user';
    </script>";
    exit;
}

$query = "DELETE FROM users WHERE id = '$id'";
$sql = mysqli_query($db, $query);

if ($sql && mysqli_affected_rows($db) > 0) {
    $msg = "User deleted successfully";
} else {
    $msg = "Action invalid";
}
echo "<script>
    alert('$msg');
    document.location='index.php?page=user';
</script>";
?>
