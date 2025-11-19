<?php
require_once __DIR__ . "/../models/Usuarios.php";

$token = $_GET['token'] ?? '';

if (empty($token)) {
    echo "Token inválido";
    exit;
}

$usuario = new Usuarios();

// Buscar usuario por token
$user = $usuario->query("
    SELECT * 
    FROM usuarios 
    WHERE token = '$token'
    LIMIT 1
");

if (count($user) == 0) {
    echo "El token no corresponde a un usuario";
    exit;
}

$user = $user[0];

// GENERAR token_action nuevo
$token_action = bin2hex(random_bytes(32));

// BLOQUEAR al usuario
$usuario->query("
    UPDATE usuarios
    SET bloqueado = 1,
        token_action = '$token_action',
        blocked_date = CURRENT_TIMESTAMP
    WHERE token = '$token'
");

// ENVIAR EMAIL DE AVISO
$subject = "Tu cuenta fue bloqueada";
$message = "
    Tu cuenta fue bloqueada por seguridad.<br><br>
    Para cambiar tu contraseña hacé clic aquí:<br><br>
    <a href='http://mattprofe.com.ar/alumno/9899/app-estacion/index.php?v=reset&token_action=$token_action'>
        Cambiar contraseña
    </a>
";
sendEmail($user['email'], $subject, $message);

// MOSTRAR AVISO
echo "Usuario bloqueado. Revisá tu correo electrónico.";
exit;
