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

function item_similitude($movieid, $userid){
	include "db.php";
	$movielist = array();
	$query = "SELECT DISTINCT rating2.movieid as movieid FROM ratings as rating1, ratings as rating2 where rating1.movieid='$movieid' and rating1.userid = rating2.userid ORDER BY `rating2`.`movieid` ASC LIMIT 20";
	$result = $con->query($query);
	if (mysqli_num_rows($result)!=0) {			
			while($row = $result->fetch_assoc()){
			array_push($movielist, $row['movieid']);
			}
		}
	$similitudelist = array();
	$ratinglist = array();



	foreach($movielist as $movie){
		$sql_query = "SELECT DISTINCT ratings1.userid, ratings1.rating AS rating1, ratings2.rating AS rating2 FROM ratings AS ratings1, ratings AS ratings2 WHERE ratings1.movieid = '$movieid' AND ratings2.movieid='$movie' AND ratings1.userid = ratings2.userid";
		
		$result = $con->query($sql_query);
		
		if (mysqli_num_rows($result)!=0) {
			$ratings1 = array();
			$ratings2 = array();
			
			while($row = $result->fetch_assoc()){
				array_push($ratinglist, array($row['userid'], $row['rating1'], $row['rating2']));
				array_push($ratings1, $row['rating1']);
				array_push($ratings2, $row['rating2']);				
			}
		}
		

		$numerador = 0;
		$denominador1 = 0;
		$denominador2 = 0;
		foreach($ratinglist as $ra){
			$sql_query2 = "SELECT AVG(rating) AS rat FROM `ratings` WHERE userid = '$ra[0]'";
			$result2 = $con->query($sql_query2);
			if (mysqli_num_rows($result2)!=0){
				while($row = $result2->fetch_assoc()){
					$average = $row['rat'];				
				}
			}
			
			$numerador+=($ra[1] - $average)*($ra[2] - $average);
			$denominador1+=pow($ra[1] - $average,2);
			$denominador2+=pow($ra[2] - $average,2);
		}

		if($numerador!=0){
			$similitude = $numerador/(sqrt($denominador1)*sqrt($denominador2));
		
		$query3 = "SELECT rating FROM ratings WHERE movieid = $movie AND userid = $userid";
		$result3 = $con->query($query3);
		if (mysqli_num_rows($result3)!=0){
				while($row = $result3->fetch_assoc()){
					$rating = $row['rating'];	
					array_push($similitudelist, array($movie,$similitude,$rating));
				}
			}
		}
	}
	return $similitudelist;	
}

function prediction($userid,$movieid,$umbral){
	include "db.php";
	$result = array();
	$prediction = 0;
	$similitudes = item_similitude($movieid,$userid);
	if(empty($similitudes)){
		return "No se puede calcular para los valores dados";
	}
	$numerador = 0;
	$denominador = 0;
	foreach($similitudes as $sim){
		if($sim[1]>=$umbral){
			$numerador+=($sim[1])*($sim[2]);
			$denominador+=($sim[1]);
		}
	}
	if($numerador == 0 or $denominador == 0){
		return "No se puede calcular para los valores dados";
	}else{
		$prediction = $numerador/$denominador;
	}


	return $prediction;	
	}

function ranking($userid,$umbral,$limit){
	include "db.php";
	$notseenmovies = array();
	$predictions = array();
	$counter = 0;
	$userquery = "SELECT DISTINCT movieid FROM ratings WHERE userid != '$userid' AND movieid NOT IN 
				(SELECT movieid FROM ratings WHERE userid = '$userid') ORDER BY movieid ASC LIMIT 50";
	$result = $con->query($userquery);
	while($row = $result->fetch_assoc()){
		$movie = $row['movieid'];	
		array_push($notseenmovies, $movie);
	}
	foreach($notseenmovies as $mov){
		if($counter == $limit){
			return $predictions;
		}
		$pred = prediction($userid,$mov,$umbral);

		if(is_string($pred)){
			$pred = 'nada';
		}else{		

			if($pred >= 5){
				$pred = 5;
				$query = "SELECT title FROM movies WHERE id = '$mov'";
				$res = $con->query($query);
				if (mysqli_num_rows($res)!=0){
					while($row = $res->fetch_assoc()){
						$title = $row['title'];
					}	
				}else{
					$title = 'Título no disponible.';
				}
				array_push($predictions, array($mov,$title,$pred));

				$counter += 1;
			}
		}
	}
	$order = array_column($predictions, 0);
	array_multisort($order, SORT_DESC, $predictions);
	array_splice($predictions, $limit);
	return $predictions;

}
	


?>