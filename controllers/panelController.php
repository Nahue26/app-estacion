<?php
if (!isset($_SESSION[APP_NAME]["user"])) {
    header("Location: index.php?v=login");
    exit;
}

/* ============================
   TRACKING DE CLIENTES
   ============================ */

// No trackear al admin
if (!isset($_SESSION['admin'])) {

    // 1) IP real
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';

    // 2) API externa
    $apiUrl = "http://ipwho.is/" . $ip;
    $response = @file_get_contents($apiUrl);
    $info = json_decode($response, true);

    // 3) Datos procesados
    $latitud   = $info['latitude']  ?? "0";
    $longitud  = $info['longitude'] ?? "0";
    $pais      = $info['country']   ?? "desconocido";
    $navegador = $_SERVER['HTTP_USER_AGENT'] ?? 'desconocido';
    $sistema   = php_uname();

    // 4) Guardar en tracker
    require_once "models/Tracker.php";
    $tracker = new Tracker();

    $tracker->save([
        "ip"        => $ip,
        "latitud"   => $latitud,
        "longitud"  => $longitud,
        "pais"      => $pais,
        "navegador" => $navegador,
        "sistema"   => $sistema
    ]);
}

/* ============================
   PANEL NORMAL
   ============================ */

$tpl = new Enano("panel");
$tpl->assignVar([
    "titulo" => "Panel de Estaciones",
    "APP_SECTION" => "Estaciones Meteorológicas",
]);
$tpl->printToScreen();
