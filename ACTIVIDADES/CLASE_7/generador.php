<?php 

if (isset($_GET['Generar'])) {
	$archivo = fopen('/var/www/html/alumno/71alumnos.csv', 'r');
	var_dump($archivo);
	

}




 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>

	<form action="" method="GET">
		<input type="submit" value="Generar" name="Generar">
	</form>	
</body>
</html>