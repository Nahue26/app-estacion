<?php
require_once __DIR__ . "/../models/Usuarios.php";

$message_div = "";

if (isset($_SESSION[APP_NAME]["user"])) {
    header("Location: index.php?v=panel");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = new Usuarios();
    $result = $usuario->register($_POST);

    if ($result['errno'] == 202) {
        $message_div = "<div class='msg msg-success'>{$result['error']}</div>";
    } else {
        $message_div = "<div class='msg msg-error'>{$result['error']}</div>";
    }
}

$tpl = new Enano("register");
$tpl->assignVar([
    "titulo" => "Registrarse",
    "APP_SECTION" => "Registro",
    "message_div" => $message_div
]);

$tpl->printToScreen();
?>