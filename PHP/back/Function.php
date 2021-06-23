<?php


function quota($stringa){
	$daQuotare = ["'", '"', "<", ">"];
	$quotate   = ["\'", '\"', "\<", "\>"];

return str_replace($daQuotare, $quotate, $stringa);

	
}

?>