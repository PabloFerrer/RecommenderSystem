<?php

include "userfunctions.php";

if ((isset($_REQUEST['userid'])) and (isset($_REQUEST['movieid'])) and (isset($_REQUEST['umbral']))){
	if((!is_numeric($_REQUEST['umbral']))){
		echo "El umbral ha de ser un número";
	}else{
		$prediction = prediction($_REQUEST['userid'], $_REQUEST['movieid'], $_REQUEST['umbral'], 'null');
		echo "Nota predicha: ",$prediction;
	}
	
}else{
	echo "Escriba todos los datos";
}
?>