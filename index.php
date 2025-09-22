<?php
// session_start();
include "service/config.php";


//page selector
$page = isset($_GET['page'])? $_GET['page'] : "home";
switch ($page){
    case 'login' : include "login.php"; break;
    case 'logout' : include "dashboard.php"; break;
    case 'register' : include "register.php"; break;
    case 'user' : include "admin.php"; break;
    case 'useredit' : include "user_edit.php"; break;
    case 'userdelete' : include "user_delete.php"; break;
    case 'home' : 
    default      :include "home.php"; 
}
?>
