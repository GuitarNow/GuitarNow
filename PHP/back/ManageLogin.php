<?php

require_once('DatabaseConnection.php');

session_start(); 
$error='';  
if (isset($_POST['submit'])) {
    
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Utente o Password non validi";

}
else
{

$username=$_POST['username'];
$password=$_POST['password'];

$database = new DatabaseConnection();

// proteggere MySQL injection 
$username = stripslashes($username);
$password = stripslashes($password);
$username = $database->escape_string($username);
$password = $database->escape_string($password);

$utente = mysqli_fetch_assoc($database->get_result_query("select username, password, permessi from user where (password='$password' AND username='$username') "));	

if ($username == $utente['username'] && $password == $utente['password']) {
echo "siamo entrati";
$_SESSION['login_user']=$username; 
$_SESSION['psw']=$password;
$_SESSION['permessi']=$utente['permessi'];
header("location: ../../Home.php"); // indirizzamento
} else {
$error = "Username or Password is invalid";
}

}
}


?>