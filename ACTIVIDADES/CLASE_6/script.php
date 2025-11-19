<?php 

	if (isset($_GET['Generar_Script'])) {
		if (empty($_GET['script']) && empty($_GET['command'])) {
			echo "Todos los campos estan incompletos, para continuar debe completar ambos campos";
		}elseif (empty($_GET['command'])) {
			echo "El campo command esta vacio";
		}elseif(empty($_GET['script'])){
			echo "El campo script esta vacio";
		}else{
			$nombreArchivo = $_GET['script'].".sh";
			$contenido = $_GET['command'];
			$archivo = fopen( $nombreArchivo,"a+");
			if (isset($archivo)) {
				fwrite($archivo,$contenido.PHP_EOL);
				fclose($archivo);
			}
		}
	}






 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>

	<form action="" method="GET">

		<label for="">
			Script Name
			<input type="text" name="script" >	
		</label>
		<label for="">
			Commands
			<input type="text" name="command" >	
		</label>
		<input type="submit" value="Generar Script" name="Generar_Script">

	</form>
	
</body>
</html>