<?php

include "userfunctions.php";

if ((isset($_REQUEST['userid'])) and (isset($_REQUEST['umbral']))and (isset($_REQUEST['limite']))){
	print_r(user_similitude(1));
	/*$ranking = ranking($_REQUEST['userid'], $_REQUEST['umbral'], $_REQUEST['limite']);
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
		";	*/
	
	
}else{
	echo "Escriba todos los datos";
}
?>