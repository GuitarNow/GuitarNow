<?php

$web_page = file_get_contents('Amministratore.html');

$web_page = str_replace('<title_page/>', "Amministrazione", $web_page);

$web_page = str_replace('<breadcrumbs_to_insert/>','Amministrazione', $web_page);

$web_page = str_replace('<contenuto_to_insert/>', '<div id="headerAmm">
<img id="logo" src="../Images/logo_bianco.png" alt="" />
</div>
<div id="breadcrumbsAmm">
<p>Ti trovi in: 
       <breadcrumbs_to_insert/>           
</p>
</div>
<div id="contenutoAmm" class="contenuto">
<form action="PHP/back/ManageLogin.php" method="post"  class="form" >
<fieldset>
<img src="../Images/logo_bianco.png" alt="" />
<label for="username">Username</label>
<input name="username" id="username" maxlength="20" placeholder="teo99"/>
<label for="password">Password</label>
<input type="password" name="password" id="password" maxlength="20" />
<input type="submit" name="submit" value="Accedi" id="loginAccedi" />
<p id="cambpass"><a href="cambio_psw.php">password dimenticata</a></p>
</fieldset>
</form>
</div>', $web_page);

echo $web_page;

?>