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
		include "itemfunctions.php";
		$user_list = user_list();
	?>
	
    <title>Recomendaciones Item-Item</title>
	<script src="itemitem.js"></script>
</head>
<body>
	<div id="content">
		<h1>Recomendaciones Item-Item:</h1>
		<h3>Selecciona un usuario:</h3>
		
		<form>
			<select name="selectuser" id="selectuser">
				
				<?php foreach ($user_list as $user){
					echo "<option value=$user>ID $user</option>";
				}?>
			</select>
			<input type="button" id="recommenduser" value="¡Recomendar!"></input>
		</form>
		<div id="resultuser">Muda muda muda</div>
		<?php 

			/*$list = prediction(1,32,0.3);
			print_r($list);*/
			$list = ranking(1,0.3,5);
			print_r($list);
		?>
		
	</div>
</body>
</html>