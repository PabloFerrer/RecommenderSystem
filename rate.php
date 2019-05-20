<?php

include "db.php";
include "userfunctions.php";

if ((isset($_REQUEST['movieid'])) and (isset($_REQUEST['rating']))){
	
	$movie = $_REQUEST['movieid'];
	$rating = $_REQUEST['rating'];
	
	$sql_query = "SELECT DISTINCT movieid from ratings WHERE movieid='$movie' and userid='0'";
	$result = $con->query($sql_query);
	if (mysqli_num_rows($result) != 0){
		echo "El usuario ha votado esta película en el pasado";
	}else{
		$sql_query = "INSERT INTO ratings(userid, movieid, rating) VALUES ('0', $movie, $rating)";
		if($con->query($sql_query) === TRUE){
			echo "El usuario ha votado la película ",$movie," con un ",$rating;
		}else{
			echo "Error inseperado";
		}
	}
	
	
	
		/*$sql_query = "SELECT rating FROM ratings WHERE movieid='$movieid' AND userid='$user[0]'";
		$result = $con->query($sql_query);
		if (mysqli_num_rows($result)!=0) {
			while($row = $result->fetch_assoc()){
				array_push($movierating, array($user[0], $movieid, $user[1], $row['rating']));
			}
		}
	*/
	/*if((! ctype_digit(strval($_REQUEST['limite']))) or ($_REQUEST['limite'] === '0')){
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
	
	}*/
}else{
	echo "Escriba todos los datos";
}
?>