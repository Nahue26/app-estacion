<?php 

	echo "<h1>Nahuel Martinez</h1>";

	if (isset($_POST['value'])) {
		$make_courses = fopen("make_courses.sh", "a+");
		$make_students = fopen("make_students.sh", "a+");
	}

	$archivo = fopen("padron.csv", "r");

	if ($archivo) {

		while (!feof($archivo)) {
			$linea = fgetcsv($archivo,1000,"|");

			if ($linea[3]<="40000000") {
				$datos[] = $linea;
			}
		}
		fclose($archivo);
	}

	

	

	?>

	<form method="POST">

		<input type="submit" name="value"  value="Generar Cursos y Listados">
		
	</form>
	
	<a href="make_courses.sh">make_courses</a>
	<a href="make_students.sh">make_students</a>

	<table border="1">
		<thead>
			<th>
				Nro. Orden
			</th>
			<th>
				Apellido y Nombre
			</th>
			<th>
				DNI
			</th>
		</thead>
		<tbody>


			<?php
				foreach ($datos as $fila) {

			        if (!empty($fila)) { 
			            echo "<tr>";
			            unset($fila[2]);
			            unset($fila[4]);
			            foreach ($fila as $dato) {
			                echo "<td>" . htmlspecialchars($dato) . "</td>";
			            }
			            echo "</tr>";
			        }
			    }
			?>	
			
		</tbody>
		
	</table>


