<?php

include('Session.php');
require_once("ManageRegistrati.php");

$username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; 
    $passwordR = $_POST['ridigitaPassword'];

    if($password==$passwordR){
    $reg = new ManageRegistrati();
   $reg->registrati($email, $username, $password);
   header('Location: ../../Login.php  ');
   
    }
?>