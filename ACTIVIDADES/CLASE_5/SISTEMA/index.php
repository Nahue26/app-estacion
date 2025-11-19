<?php 

	$archivo = fopen("navegacion.log", "a+");
	$fecha = date("Ymd_His");
    $ip = $_SERVER['REMOTE_ADDR'];
    $navegador = $_SERVER['HTTP_USER_AGENT'];

    $ingresos=0;
	$login=0;

	while ($renglon=fgetcsv($archivo,0, "|")) {
		if ($renglon[0]=="*") {
			$ingresos+=1;
		}else{
			$login+=1;
		}
	}

	if (isset($_GET['btn'])) {
		
    	$linea = "+|$fecha|$ip|$navegador|Apreto Login." . PHP_EOL;
    	fwrite($archivo, $linea);
    	fclose($archivo);
	}else{
		if ($archivo) {
	    	$linea = "*|$fecha|$ip|$navegador|anónimo ingreso a index.php." . PHP_EOL;
	    	fwrite($archivo, $linea);
	    	fclose($archivo);
		} else {
    		echo "error al crear el archivo";
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
		<input type="submit" value="Login" name="btn">
	</form>
	<table border="1">
		<tr>
			<td>Ingresos</td>
			<td> <?=$ingresos ?> </td>
		</tr>
		<tr>
			<td>Login</td>
			<td><?=$login ?></td>
		</tr>
		
	</table>
	
</body>
</html>