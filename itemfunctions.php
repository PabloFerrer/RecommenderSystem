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
	$sql_query = "SELECT DISTINCT movieid FROM `ratings`";
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
	
	$ratinglist = array();
	
	foreach($movielist as $movie){
		$sql_query = "SELECT DISTINCT ratings1.userid, ratings1.rating AS rating1, ratings2.rating AS rating2 FROM ratings AS ratings1, ratings AS ratings2 WHERE ratings1.movieid = '$movieid' AND ratings2.movieid='$movie' AND ratings1.userid = ratings2.userid";
		$result = $con->query($sql_query);
		if (mysqli_num_rows($result)!=0) {
			while($row = $result->fetch_assoc()){
				array_push($ratinglist, array($movie, $row['userid'], $row['rating1'], $row['rating2']));
			}
		}
	}
	
	
	return $ratinglist;

}

?>