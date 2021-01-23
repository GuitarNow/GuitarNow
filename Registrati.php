<?php
include('PHP/back/Session.php');
require_once("PHP/back/ManageRegistrati.php");
$web_page = file_get_contents('Html/Template.html');

$web_page = str_replace('<title_page/>', "Registrati", $web_page);

<<<<<<< HEAD
$nav_bar = file_get_contents('Html/Header.html');
$web_page = str_replace('<header_to_insert/>', $nav_bar, $web_page);
=======
$nav_bar = '       <li class="link" role="none" lang="en"><a href="Home.php" role="menuitem">Home</a></li> 
<li class="link" role="none"><a class="a_header" href="Prodotti.php?categoria=chitarre" role="menuitem">Prodotti</a></li>
<li class="link" role="none"><a class="a_header" href="Servizi.php" role="menuitem">Servizi</a></li>
<li class="link" role="none"><a class="a_header" href="Chisiamo.php" role="menuitem">Chi siamo</a></li>';
$web_page = str_replace('<menu_to_insert/>', $nav_bar, $web_page);
>>>>>>> a7bfc3fdf1a7772503c217e04413e1b23a55e654

$web_page = str_replace('<breadcrumbs_to_insert/>','Registrati', $web_page);

$data=file_get_contents('Html/Registrati.html');



if (isset($_POST['Registrati'])) {
    $email=$_POST['email'];
    $username=$_POST['username'];
    $password=$_POST['password']; 
    $ridpassword=$_POST['ridigitaPassword']; 

    $database = new DatabaseConnection();
    $username = stripslashes($username);
    $username = $database->escape_string($username);
               
    $utente = mysqli_fetch_assoc($database->get_result_query("select username, password,email, permessi from user where username='$username' "));
   
if($utente!=NULL){
    $data = str_replace('<errorePassERidPassReg/>', 'Username già in uso', $data);
    $data = str_replace('valueUserReg', 'value="'.$username.'"', $data);
        $data = str_replace('valueEmailReg', 'value="'.$email.'"', $data);
}else{

    if (strlen($password) <3 || strlen($username) <3 || strlen($email) ==0 || ($password)!=($ridpassword)){
        if(strlen($username) <3){
            $data = str_replace('<erroreUserReg/>', 'Inserisci almeno 3 caratteri', $data);
        }
        if(strlen($password) <3){
            $data = str_replace('<errorePassReg/>', 'Inserisci almeno 3 caratteri', $data);
        }
        if(($password)!=($ridpassword)){
            $data = str_replace('<errorePassERidPassReg/>', 'Password e Ridigita password devono essere uguali', $data);
        }
        if(strlen($email) ==0){
            $data = str_replace('<erroreEmailReg/>', 'Inserisci una mail corretta', $data);
        }
        $data = str_replace('valueUserReg', 'value="'.$username.'"', $data);
        $data = str_replace('valueEmailReg', 'value="'.$email.'"', $data);
    }
    else{
        $reg = new ManageRegistrati();
       $reg->registrati($email, $username, $password);
       header('Location: Login.php?operazione=1');
        }
}
}
$web_page = str_replace('<contenuto_to_insert/>',$data , $web_page);

echo $web_page;

?>

