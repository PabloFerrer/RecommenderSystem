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

function user_similitude($userid){
	include "db.php";
	$sql_query = "SELECT DISTINCT movieid FROM `ratings` WHERE userid = '$userid'";
	$result = $con->query($sql_query);
	$movielist = array();
	while($row = $result->fetch_assoc()){
		array_push($movielist, $row['movieid']);
	}
	
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

?>