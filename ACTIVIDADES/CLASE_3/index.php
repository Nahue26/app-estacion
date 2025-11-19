<?php 
$archivo = fopen("comandos_response_71_MARTINEZ_NAHUEL.csv.txt", "r");

$comandos = 0;
$caracteres = 0;
$ultimaLinea = ''; 

if ($archivo) {
    while (($linea = fgets($archivo)) !== false) {
        $ultimaLinea = $linea; 
        $lineas[] = $linea;
    }
    fclose($archivo);


    $cantidadLineas = count($lineas);

    for ($i = 0; $i < $cantidadLineas - 1; $i++) {
        $linea = str_replace('*', '', $lineas[$i]);
        $caracteres += strlen($linea);
        
        $partes = explode('|', $linea);
        if (count($partes) == 2) {
            list($comando, $respuesta) = $partes;
            echo "<hr>";
            echo "<b>$comando</b><br>$respuesta";
            $comandos++;
        } else {
            echo $linea;
        }
    }


    echo "<br>Comandos Listados: $comandos<br>";
    echo "Caracteres Leídos: $caracteres<br>";

    echo str_replace('*', '', $ultimaLinea);
}
?>