<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

function proxy($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $resp = curl_exec($ch);
    curl_close($ch);
    return $resp;
}

$mode = $_GET['mode'] ?? '';
$chipid = $_GET['chipid'] ?? '';
$cant = $_GET['cant'] ?? '';

$BASE = "https://mattprofe.com.ar/proyectos/app-estacion/datos.php";

if ($mode === 'list-stations') {
    echo proxy("$BASE?mode=list-stations");
    exit;
}

if ($mode === 'visit-station' && $chipid) {
    echo proxy("$BASE?mode=visit-station&chipid=$chipid");
    exit;
}

if ($chipid && $cant) {
    // Esto responde al panel (vista de detalle)
    echo proxy("$BASE?chipid=$chipid&cant=$cant");
    exit;
}

echo json_encode(["error" => "Parámetros inválidos"]);
