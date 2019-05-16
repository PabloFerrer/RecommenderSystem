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
	$sql_query = "SELECT DISTINCT movieid FROM `ratings` LIMIT 5000"; #AQUI HE LIMITADO JAVI PARA NO TIRARME HORA Y MEDIA POR TRY
	$result = $con->query($sql_query);
	$movielist = array();
	while($row = $result->fetch_assoc()){
		array_push($movielist, $row['movieid']);
	}
	
	return $movielist;
}

function item_similitude($movieid){
	include "db.php";

	$movielist = movie_list();
	$similitudelist = array();
	$ratinglist = array();

	
	foreach($movielist as $movie){
		$sql_query = "SELECT DISTINCT ratings1.userid, ratings1.rating AS rating1, ratings2.rating AS rating2 FROM ratings AS ratings1, ratings AS ratings2 WHERE ratings1.movieid = '$movieid' AND ratings2.movieid='$movie' AND ratings1.userid = ratings2.userid";
		$sql_query2 = "SELECT DISTINCT rating as rat FROM `ratings` WHERE userid = 2";
		$result = $con->query($sql_query);
		$result2 = $con->query($sql_query2);



		if (mysqli_num_rows($result)!=0) {
			$ratings1 = array();
			$ratings2 = array();
			
			while($row = $result->fetch_assoc()){
				array_push($ratinglist, array($movie, $row['userid'], $row['rating1'], $row['rating2']));
				array_push($ratings1, $row['rating1']);
				array_push($ratings2, $row['rating2']);				
			}
		}
		if (mysqli_num_rows($result2)!=0){
			$ratingspermovie = array();
			while($row = $result2->fetch_assoc()){
				array_push($ratingspermovie, $row['rat']);
						
			}
		}

		$average = array_sum($ratingspermovie)/count($ratingspermovie);

		$numerador = 0;
		$denominador1 = 0;
		$denominador2 = 0;
		foreach($ratinglist as $ra){
			$numerador+=($ra[1] - $average)*($ra[2] - $average);
			$denominador1+=pow($ra[1] - $average,2);
			$denominador2+=pow($ra[2] - $average,2);
		}

		if($numerador == 0){
			$similitude = $numerador;
		}else{
			$similitude = $numerador/(sqrt($denominador1)*sqrt($denominador2));
		}
		array_push($similitudelist, $similitude);

	}
	return $similitudelist;	
	
	

}

?>