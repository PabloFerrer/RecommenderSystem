<!DOCTYPE html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
	
	<?php
		include "userfunctions.php";
		$user_list = user_list();
		$movie_list = movie_list();
	?>
	
    <title>Recomendaciones User-User</title>
	<script src="useruser.js"></script>
</head>
<body>
	<div id="content">
		<h1>Recomendaciones User-User:</h1>
		
		<h3>Calcular ranking de películas</h3>
		<form>
			<h4>Selecciona un usuario:</h4>
			<select name="selectuser" id="selectuser">
				
				<?php foreach ($user_list as $user){
					echo "<option value=$user>ID $user</option>";
				}?>
			</select>
			<h4>Número de items: <input type="text" id="number" value="5"></input></h4>
			<h4>Umbral de similitud: <input type="text" id="threshold" value="0.75"></input></h4>
			<input type="button" id="recommenduser" value="¡Recomendar!"></input>
		</form>
		<div id="resultuser">
			MUDA
		</div>
		
		
		<form>
			<h3>Predecir puntuación para una película</h3>
			<h4>Selecciona un usuario:</h4>
			<select name="selectuser2" id="selectuser2">
				<?php foreach ($user_list as $user){
					echo "<option value=$user>ID $user</option>";
				}?>
			</select>
		
			<h4>Selecciona una película:</h4>
		
			<select name="selectmovie" id="selectmovie">
				<?php foreach ($movie_list as $movie){
					echo "<option value=$movie[0]>$movie[0]: $movie[1]</option>";
				}?>
			</select>
			<h4>Umbral de similitud: <input type="text" id="threshold2" value="0.75"></input></h4>
			<input type="button" id="predict" value="¡Predecir!"></input>
		</form>
		<div id="prediction">
			MUDA
		</div>

			<!/*$prediction = prediction(1, 41, 0.8,'null');
			print_r($prediction);*/
			
			/*$prediction = prediction(1, 5902, 0.8,'null');
			print_r($prediction);*/
			
			
			/*$ranking = ranking(1, 0.8, 5);
			print_r($ranking);*/!>
			
		
		
	</div>
</body>
</html>