<?php


require_once('DatabaseConnection.php');
session_start();
if(isset($_SESSION['login_user'])){
    $database = new DatabaseConnection();
    
    echo session_id();

    $user_check=$_SESSION['login_user'];
$psw_check=$_SESSION['psw'];




$row =  mysqli_fetch_assoc($database->get_result_query("select username,password AS psw ,permessi from user where username='$user_check' AND password = '$psw_check'"));
$login_session =$row['username'];
$psw_session =$row['psw'];
$admin_session =$row['permessi'];
}




?>