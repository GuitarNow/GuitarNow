<?php
function cambia_acc($dato){
	$dato = str_replace("€", "&euro;",   $dato);
	$dato = str_replace("è", "&egrave;", $dato);
	$dato = str_replace("é", "&eacute;", $dato);
	$dato = str_replace("à", "&agrave;", $dato);
	$dato = str_replace("À", "&Agrave;", $dato);
	$dato = str_replace("á", "&aacute;", $dato);
	$dato = str_replace("ò", "&ograve;", $dato);
	$dato = str_replace("ó", "&oacute;", $dato);
	$dato = str_replace("ì", "&igrave;", $dato);
	$dato = str_replace("í", "&iacute;", $dato);
	$dato = str_replace("ù", "&ugrave;", $dato);
	$dato = str_replace("ú", "&uacute;", $dato);

	return $dato;
}



function quota($stringa){
	$daQuotare = ["'", '"', "<", ">"];
	$quotate   = ["\'", '\"', "\<", "\>"];

return str_replace($daQuotare, $quotate, $stringa);

	
}

?>