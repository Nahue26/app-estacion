<?php

$chipid = $_GET['id'] ?? null;

if (!$chipid) {
    die("Falta el parámetro ID");
}

if(!isset($_SESSION[APP_NAME]["user"])){
    header("Location: index.php?v=login");
    exit;
}

$lista = @file_get_contents("https://mattprofe.com.ar/proyectos/app-estacion/datos.php?mode=list-stations");
$lista = json_decode($lista, true);

$nombreEstacion = "Estación $chipid"; 

if (is_array($lista)) {
    foreach ($lista as $st) {
        if ($st["chipid"] == $chipid) {
            $nombreEstacion = $st["apodo"];
            break;
        }
    }
}

$tpl = new Enano("detalle");
$tpl->assignVar([
    "chipid" => $chipid,
    "nombre" => $nombreEstacion
]);
$tpl->printToScreen();
