<?php 
$lineas = [];
$encabezado = [];

if (isset($_POST['apellido'])) {
    $apellido = $_POST['apellido'];
    $nombre = $_POST['nombre'];
    $fecha = $_POST['anioNaci'];
    $localidad = $_POST['localidad'];
    $provincia = $_POST['provincia'];

    //abrimos el archivo csv para obtener el id maximo
    $archivoLectura = fopen('nomina.csv', 'r');
    $idmax = 0;

    if ($archivoLectura) {
        while (($fila = fgets($archivoLectura)) !== false) {
            $linea = explode(',', $fila);
            $id = (int) trim($linea[0]);
            if ($id > $idmax) {
                $idmax = $id;
            }
        }
        fclose($archivoLectura);
    }

    $idNuevo = $idmax + 1;

    // Se escribe la nueva linea en el archivo css con los datos completados en el formulario
    $archivoEscritura = fopen('nomina.csv', 'a');
    if ($archivoEscritura) {
        $datos = array($idNuevo, $apellido, $nombre, $fecha, $localidad, $provincia);
        fputcsv($archivoEscritura, $datos);
        fclose($archivoEscritura);
    } else {
        echo " No se pudo abrir el archivo";
    }
}

// se muestran los datos en el archivo csv
$archivo = fopen('nomina.csv', 'r');
if ($archivo) {
    $encabezado = fgetcsv($archivo, 1000, ",");

    $encabezado = array_filter($encabezado, function($value) {
        return $value !== ''; 
    });
    $encabezado = array_values($encabezado);

    while (($linea = fgetcsv($archivo, 1000, ",")) !== false) {
        $linea = array_filter($linea, function($value) {
            return $value !== ''; 
        });
        $linea = array_values($linea);
        $lineas[] = $linea;
    }

    fclose($archivo);
}
?>



<table border="1">
    <thead>
        <tr>
            <?php foreach ($encabezado as $value): ?>
                <th><?php echo htmlspecialchars($value); ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lineas as $fila): ?>
            <?php if (!empty($fila)): ?>
                <tr>
                    <?php foreach ($fila as $dato): ?>
                        <td><?php echo htmlspecialchars($dato); ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
</table>

<br><br>
<form action="" method="POST">
    Apellido: <input type="text" name="apellido" required><br>
    Nombre: <input type="text" name="nombre" required><br>
    Año de Nacimiento: <input type="number" name="anioNaci" required><br>
    Localidad: <input type="text" name="localidad" required><br>
    Provincia: <input type="text" name="provincia" required><br><br>
    <input type="submit" value="Guardar">
</form>
