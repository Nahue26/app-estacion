<?php
require_once __DIR__ . "/../models/Usuarios.php";

$message_div = ""; // <--- ESTA es la que entiende el template

if(isset($_SESSION[APP_NAME]["user"])){
    header("Location: index.php?v=panel");
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $usuario = new Usuarios();
    $result = $usuario->authenticate($_POST['txt_email'], $_POST['txt_password']);

    if($result['errno'] == 202){
        header("Location: index.php?v=panel");
        exit;
    } else {
        // Armamos el HTML del mensaje aquí
        $message_div = "<div style='color:red; margin-bottom: 20px;'>{$result['error']}</div>";
    }
}

$tpl = new Enano("login");
$tpl->assignVar([
    "titulo" => "Iniciar Sesión",
    "APP_SECTION" => "Login",
    "message_div" => $message_div  // <--- ESTA SÍ EXISTE
]);

$tpl->printToScreen();
