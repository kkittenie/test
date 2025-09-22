<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database  = "buku_safirah";

$db = mysqli_connect($hostname, $username, $password, $database);

if ($db->connect_error) {
    echo "connection_error";
    die("error!");
}
?>