<?php
$tpl = new Enano("landing");  // nombre de la vista / plantilla
$tpl->assignVar([
    "titulo" => APP_NAME,
    "APP_SECTION" => "Bienvenido",
]);
$tpl->printToScreen();
?>