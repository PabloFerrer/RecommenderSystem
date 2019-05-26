<?php


/**
 * return user list
 *
 * @return array
 */
function user_list()
{
	include "db.php";
	$sql_query = "SELECT DISTINCT userid from ratings";
	$result = $con->query($sql_query);
	$userlist = array();
	while($row = $result->fetch_assoc()){
		array_push($userlist, $row['userid']);
	}
	
	return $userlist;
}

function movie_list()
{
	include "db.php";
	$sql_query = "SELECT DISTINCT id, title from movies";
	$result = $con->query($sql_query);
	$movielist = array();
	while($row = $result->fetch_assoc()){
		array_push($movielist, array($row['id'], $row['title']));
	}
	
	return $movielist;
}

function user_similitude($userid){
	
	include "db.php";

	$userlist = user_list();
	$similitudelist = array();
	foreach($userlist as $user){

		$sql_query = "SELECT DISTINCT ratings1.movieid, ratings1.rating AS rating1, ratings2.rating AS rating2 FROM ratings AS ratings1, ratings AS ratings2 WHERE ratings1.userid = '$userid' AND ratings2.userid='$user' AND ratings1.movieid = ratings2.movieid";

		$result = $con->query($sql_query);
		if (mysqli_num_rows($result)!=0) {
			
		$movielist2 = array();
		$ratings1 = array();
		$ratings2 = array();
		while($row = $result->fetch_assoc()){
			
			array_push($movielist2, array($row['movieid'], $row['rating1'], $row['rating2']));
			array_push($ratings1, $row['rating1']);
			array_push($ratings2, $row['rating2']);
		}
		
		$average1 = array_sum($ratings1)/count($ratings1);
		$average2 = array_sum($ratings2)/count($ratings2);
		
		$numerador = 0;
		$denominador1 = 0;
		$denominador2 = 0;
		foreach($movielist2 as $movie){
			$numerador += ($movie[1] - $average1)*($movie[2] - $average2);
			$denominador1 += pow(($movie[1] - $average1),2);
			$denominador2 += pow(($movie[2] - $average2),2);
		}
		
		if($numerador == 0){
			$similitude = $numerador;
		}else{
			$similitude = $numerador/(sqrt($denominador1)*sqrt($denominador2));
		}
		array_push($similitudelist,array($user,$similitude));
			
		}
		
	}
	return $similitudelist;
}

function prediction($userid, $movieid, $umbral, $similitude){
	include "db.php";
	
	if($similitude == 'null'){
		$similitude = user_similitude($userid);
	}
	$trulysimilarusers = array();
	$movierating = array();
	
	foreach($similitude as $user){
		if($user[1] >= $umbral and $user[0] != $userid){
			array_push($trulysimilarusers, $user);
		}
	}
	
	foreach($trulysimilarusers as $user){
		
		$sql_query = "SELECT rating FROM ratings WHERE movieid='$movieid' AND userid='$user[0]'";
		$result = $con->query($sql_query);
		if (mysqli_num_rows($result)!=0) {
			while($row = $result->fetch_assoc()){
				array_push($movierating, array($user[0], $movieid, $user[1], $row['rating']));
			}
		}
	}
	
	if(empty($movierating)){
		return "No se puede calcular para los valores dados";
	}
	
	$sql_query = "SELECT AVG(rating) AS rating FROM ratings WHERE userid='$userid'";
	$result = $con->query($sql_query);
	while($row = $result->fetch_assoc()){
		$average = $row['rating'];
	}
		
	$numerador = 0;
	$denominador = 0;
	
	foreach($movierating as $score){
		$sql_query = "SELECT AVG(rating) AS rating FROM ratings WHERE userid='$score[0]'";
		$result = $con->query($sql_query);
		while($row = $result->fetch_assoc()){
			$average2 = $row['rating'];
		}
		
		$numerador += ($score[2] * ($score[3] - $average2));
		$denominador += ($score[2]);
		
	}
	
	$prediccion = $average + $numerador/$denominador;
	return $prediccion;
}

function ranking($userid, $umbral, $limite){
	include "db.php";
	$movielist = array();
	
	$similitude = user_similitude($userid);
	$trulysimilarusers = array();
	foreach($similitude as $user){
		if($user[1] >= $umbral and $user[0] != $userid){
			array_push($trulysimilarusers, $user);
		}
	}
	
	foreach($trulysimilarusers as $similar){
		$sql_query = "SELECT movieid FROM ratings WHERE userid = '$similar[0]' AND movieid NOT IN  (SELECT movieid FROM ratings WHERE userid = '$userid')";
		$result = $con->query($sql_query);
		while($row = $result->fetch_assoc()){
			if (in_array($row['movieid'], $movielist) == false){
				array_push($movielist, $row['movieid']);
			}
		}
	}
 
	$predictlist = array();
	
	foreach($movielist as $movie){
		$predict = prediction($userid, $movie, $umbral, $similitude);
		array_push($predictlist, array($movie, $predict));
	}
	
	$order = array_column($predictlist, 1);
	array_multisort($order, SORT_DESC, $predictlist);
	array_splice($predictlist, $limite);
	
	$resultlist = array();
	
	foreach($predictlist as $predict){
		$sql_query = "SELECT title FROM movies WHERE id = '$predict[0]'";
		$result = $con->query($sql_query);
		if (mysqli_num_rows($result)!=0) {
			while($row = $result->fetch_assoc()){
				array_push($resultlist, array($predict[0], $row['title'], $predict[1]));
			}
		}else{
			array_push($resultlist, array($predict[0], "Título no disponible", $predict[1]));
		}
		
	}
	
	return $resultlist;
	
}

?>