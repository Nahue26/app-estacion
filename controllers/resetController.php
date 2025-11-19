<?php
require_once __DIR__ . "/../models/Usuarios.php";

$message_div = "";

if (isset($_SESSION[APP_NAME]["user"])) {
    header("Location: index.php?v=panel");
    exit;
}

$token_action = $_GET['token_action'] ?? "";

if (empty($token_action)) {
    $message_div = "<div class='msg msg-error'>Token inválido</div>";
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $password = $_POST['txt_password'];
    $repeat   = $_POST['txt_repeat_password'];

    $usuario = new Usuarios();
    $result = $usuario->resetPassword($token_action, $password, $repeat);

    if ($result['errno'] == 202) {
        header("Location: index.php?v=login");
        exit;
    }

    $message_div = "<div class='msg msg-error'>{$result['error']}</div>";
}

$tpl = new Enano("reset");
$tpl->assignVar([
    "titulo" => "Restablecer Contraseña",
    "message_div" => $message_div
]);

$tpl->printToScreen();
