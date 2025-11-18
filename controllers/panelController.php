<?php
$tpl = new Enano("panel");
$tpl->assignVar([
    "titulo" => "Panel de Estaciones",
    "APP_SECTION" => "Estaciones Meteorológicas",
]);
$tpl->printToScreen();
