<?php
require_once __DIR__ . "/../models/Usuarios.php";

if(isset($_SESSION[APP_NAME]["user"])){
    header("Location: index.php?v=panel");
    exit;
}

$token_action = $_GET['token_action'] ?? ''; // ← ESTE ES EL CORRECTO

if(empty($token_action)){
    echo "Token inválido";
    exit;
}

$usuario = new Usuarios();

if(!$usuario->activateUser($token_action)){
    echo "El token no corresponde a un usuario";
    exit;
}

header("Location: index.php?v=login");
exit;
