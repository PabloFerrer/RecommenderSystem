<!DOCTYPE html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet" type="text/css">
	
	<?php
		include "userfunctions.php";
		$movie_list = movie_list();
	?>
	
    <title>Mi Recomendador</title>
	<script src="gestion.js"></script>
</head>
<body>
	<div class="container-fluid row separacion2">
	<div class="col-md-2"></div>
	<div id="content" class="col-md-8">
		<h1>Valoraciones del Usuario 0</h1>
		<div class="panel selector">
		<h3 class="panel-heading">Votar una pelicula</h3>
		<form>
			<h4 class="panel-heading">Selecciona una película:</h4>
			<div class="panel-body">
			<select class="form-control" name="selectmovie" id="selectmovie">
				<?php foreach ($movie_list as $movie){
					echo "<option value=$movie[0]>$movie[0]: $movie[1]</option>";
				}?>
			</select>
			
			<h4>Valoración:</h4>
			<select class="form-control" name="score" id="score">
				<option value="0.5">0.5</option>
				<option value="1">1</option>
				<option value="1.5">1.5</option>
				<option value="2">2</option>
				<option value="2.5">2.5</option>
				<option value="3">3</option>
				<option value="3.5">3.5</option>
				<option value="4">4</option>
				<option value="4.5">4.5</option>
				<option value="5">5</option>
			</select>
			<input class="btn btn-info" type="button" id="ratemovie" value="Votar"></input>
		</form>
		<div id="rated"></div>
		</div>
		<div class="panel selector">
		<h3 class="panel-heading">Calcular el ranking: </h3>
		<div class="panel-body">
		<form>
			<h4>Número de items: <input class="form-control" type="text" id="number" value="5"></input></h4>
			<h4>Umbral de similitud: <input class="form-control" type="text" id="threshold" value="0.75"></input></h4>
			<input class="btn btn-info" type="button" id="recommenduser" value="Recalcular Ranking"></input>
		</form>
		<div id="resultuser"></div>
		</div>
		
		<form>
			<div class="panel selector">
			<h3 class="panel-heading">Predecir puntuación para una película</h3>
			<div class="panel-body">
		
			<h4>Selecciona una película:</h4>
		
			<select class="form-control" name="selectmovie2" id="selectmovie2">
				<?php foreach ($movie_list as $movie){
					echo "<option value=$movie[0]>$movie[0]: $movie[1]</option>";
				}?>
			</select>
			<h4>Umbral de similitud: <input class="form-control" type="text" id="threshold2" value="0.75"></input></h4>
			<input class="btn btn-info" type="button" id="predict" value="¡Predecir!"></input>
		</form>
		<div id="prediction"></div>
			</div>
		</div>
		</div>
		</div>
	</div>	
	<div class="col-md-2"></div>
	</div>
</body>
</html>