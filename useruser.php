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
	?>
	
    <title>Recomendaciones User-User</title>
	<script src="useruser.js"></script>
</head>
<body>
	<div id="content">
		<h1>Recomendaciones User-User:</h1>
		<h3>Selecciona un usuario:</h3>
		
		<form>
			<select name="selectuser" id="selectuser">
				
				<?php foreach ($user_list as $user){
					echo "<option value=$user>ID $user</option>";
				}?>
			</select>
			<p>Número de items: <input type="text" id="number" value="5"></input></p>
			<p>Umbral de similitud: <input type="text" id="threshold" value="0.75"></input></p>
			<input type="button" id="recommenduser" value="¡Recomendar!"></input>
		</form>
		<div id="resultuser">
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