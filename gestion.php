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
		$movie_list = movie_list();
	?>
	
    <title>Mi Recomendador</title>
	<script src="gestion.js"></script>
</head>
<body>
	<div id="content">
		<h1>Valoraciones del Usuario 0</h1>
		
		<h3>Votar una pelicula</h3>
		<form>
			<h4>Selecciona una película:</h4>
			<select name="selectmovie" id="selectmovie">
				<?php foreach ($movie_list as $movie){
					echo "<option value=$movie[0]>$movie[0]: $movie[1]</option>";
				}?>
			</select>
			
			<h4>Valoración:</h4>
			<select name="score" id="score">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select>
			<input type="button" id="ratemovie" value="Votar"></input>
		</form>
		<div id="rated">
			MUDA
		</div>
		
		<h3>Calcular el ranking: </h3>
		<form>
			<h4>Número de items: <input type="text" id="number" value="5"></input></h4>
			<h4>Umbral de similitud: <input type="text" id="threshold" value="0.75"></input></h4>
			<input type="button" id="recommenduser" value="Recalcular Ranking"></input>
		</form>
		<div id="resultuser">
			MUDA
		</div>
		
		
		<form>
			<h3>Predecir puntuación para una película</h3>

		
			<h4>Selecciona una película:</h4>
		
			<select name="selectmovie2" id="selectmovie2">
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
		
	</div>
</body>
</html>