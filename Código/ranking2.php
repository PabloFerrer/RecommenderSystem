<?php

include "itemfunctions.php";

if ((isset($_REQUEST['userid'])) and (isset($_REQUEST['umbral']))and (isset($_REQUEST['limite']))){
	if((! ctype_digit(strval($_REQUEST['limite']))) or ($_REQUEST['limite'] === '0')){
		echo "El número de items ha de ser un número entero superior a cero";
	}else if((!is_numeric($_REQUEST['umbral']))){
		echo "El umbral ha de ser un número";
	}else{
	
		$ranking = ranking($_REQUEST['userid'], $_REQUEST['umbral'], $_REQUEST['limite']);
		echo "
				<table>
					<tr>
						<th>Película</th>
						<th>Puntuacion Predicha</th>
					</tr>
		";			
		foreach ($ranking as $rank){
			echo "
					<tr>
						<th>",$rank[0],": ",$rank[1],"</th>
						<th>",$rank[2],"</th>
					</tr>";
			}
			
			
			echo"	
					
				</table>
			";
	
	}
}else{
	echo "Escriba todos los datos";
}
?>