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
		include "itemfunctions.php";
		$user_list = user_list();
		$movie_list = movie_list();
	?>
	
    <title>Recomendaciones Item-Item</title>
	<script src="itemitem.js"></script>
</head>
<body>

<div class="container-fluid row separacion2">
	<div class="col-md-2"></div>
	<div id="content" class="col-md-8">
		<h1>Recomendaciones Item-Item:</h1>
		<div class="panel selector">
		<h3 class="panel-heading panel-info">Calcular ranking de películas</h3>
		<div class="panel-body">
		<form>
			<h4>Selecciona un usuario:</h4>
			<select class="form-control" name="selectuser" id="selectuser">
				
				<?php foreach ($user_list as $user){
					echo "<option value=$user>ID $user</option>";
				}?>
			</select>
			<h4>Número de items: <input class="form-control" type="text" id="number" value="5"></input></h4>
			<h4>Umbral de similitud: <input class="form-control" type="text" id="threshold" value="0.75"></input></h4>
			<input class="btn btn-info" type="button" id="recommenduser" value="¡Recomendar!"></input>
		</form>
		<div id="resultuser"></div>
		</div>
		</div>
		<div class="panel selector">		
		<form>
			<h3 class="panel-heading panel-info">Predecir puntuación para una película</h3>
			<div class=" panel-body">
			<h4>Selecciona un usuario:</h4>
			<select class="form-control" name="selectuser2" id="selectuser2">
				<?php foreach ($user_list as $user){
					echo "<option value=$user>ID $user</option>";
				}?>
			</select>
		
			<h4>Selecciona una película:</h4>
		
			<select class="form-control" name="selectmovie" id="selectmovie">
				<?php foreach ($movie_list as $movie){
					echo "<option value=$movie[0]>$movie[0]: $movie[1]</option>";
				}?>
			</select>
			<h4>Umbral de similitud: <input class="form-control" type="text" id="threshold2" value="0.75"></input></h4>
			<input class="btn btn-info" type="button" id="predict" value="¡Predecir!"></input>
		</form>
		<div  id="prediction"></div>	
		</div>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>
</body>
</html>