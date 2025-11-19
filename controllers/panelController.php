<?php
if(!isset($_SESSION[APP_NAME]["user"])){
    header("Location: index.php?v=login");
    exit;
}

$tpl = new Enano("panel");
$tpl->assignVar([
    "titulo" => "Panel de Estaciones",
    "APP_SECTION" => "Estaciones Meteorológicas",
]);
$tpl->printToScreen();
