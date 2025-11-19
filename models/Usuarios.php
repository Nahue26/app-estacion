<?php
require_once __DIR__ . '/../mp-mailer-master/mailer.php';
require_once 'models/DBAbstract.php';
require_once __DIR__ . '/../mp-mailer-master/emailHelper.php';


class Usuarios extends DBAbstract {

    public $email;

    public function __construct() {
        parent::__construct();
        $this->email = "";
    }

    /* ============================
       REGISTRO DE USUARIO
       ============================ */
    public function register($form) {

        if (empty($form["txt_email"])) {
            return ["errno" => 400, "error" => "Falta email"];
        }

        if (empty($form["txt_password"])) {
            return ["errno" => 400, "error" => "Falta contraseña"];
        }

        if ($form["txt_password"] !== $form["txt_repeat_password"]) {
            return ["errno" => 400, "error" => "Las contraseñas no coinciden"];
        }

        // Verificar email duplicado
        $email = $this->escape($form["txt_email"]);
        $response = $this->query("SELECT * FROM usuarios WHERE email = '$email'");

        if (count($response) > 0) {
            return ["errno" => 409, "error" => "Email ya registrado. <a href='index.php?v=login'>Iniciá sesión</a>"];
        }

        // Crear usuario
        $password_hash = password_hash($form["txt_password"], PASSWORD_DEFAULT);
        $token = bin2hex(random_bytes(32));
        $token_action = bin2hex(random_bytes(32));

        $sql = "
            INSERT INTO usuarios 
            (email, pass, name, add_date, token, token_action, activo, bloqueado, recupero)
            VALUES 
            ('$email', '$password_hash', '', CURRENT_TIMESTAMP, '$token', '$token_action', 0, 0, 0)
        ";

        $this->query($sql);

        // Enviar email de activación
        $this->sendActivationEmail($email, $token_action);

        return ["errno" => 202, "error" => "Usuario creado. Revisa tu email para activar la cuenta."];
    }

private function sendActivationEmail($email, $token_action) {

    $url = "http://mattprofe.com.ar/alumno/9899/app-estacion/index.php?v=validate&token_action=" . $token_action;

    $subject = "Activa tu cuenta";
    $message = "
        Bienvenido!<br>
        Hacé clic para activar tu usuario:<br><br>
        <a href='$url'>Activar cuenta</a>
    ";

    sendEmail($email, $subject, $message);
}



    /* ============================
       ACTIVACIÓN DE CUENTA
       ============================ */
    public function activateUser($token_action) {

        $token_action = $this->escape($token_action);

        $user = $this->query("
            SELECT * 
            FROM usuarios 
            WHERE token_action = '$token_action'
            AND activo = 0
        ");

        if (count($user) == 0) return false;

        $this->query("
            UPDATE usuarios
            SET activo = 1,
                token_action = '',
                active_date = CURRENT_TIMESTAMP
            WHERE token_action = '$token_action'
        ");

        $this->sendActivationConfirmationEmail($user[0]['email']);

        return true;
    }


    private function sendActivationConfirmationEmail($email) {
        $subject = "Cuenta activada";
        $message = "Tu cuenta fue activada exitosamente. Ya podés iniciar sesión.";
        sendEmail($email, $subject, $message);
    }


    /* ============================
       LOGIN + SEGURIDAD
       ============================ */
    public function authenticate($email, $password) {

        $email = $this->escape($email);

        if (empty($email) || empty($password)) {
            return ["errno" => 400, "error" => "Falta email o contraseña"];
        }

        $userData = $this->query("SELECT * FROM usuarios WHERE email = '$email'");

        if (count($userData) == 0) {
            return ["errno" => 404, "error" => "Credenciales no válidas"];
        }

        $user = $userData[0];

        if ($user['activo'] == 0) {
            return ["errno" => 401, "error" => "Tu usuario aún no fue validado. Revisá tu correo."];
        }

        if ($user['bloqueado'] == 1 || $user['recupero'] == 1) {
            return ["errno" => 423, "error" => "Tu usuario está bloqueado. Revisá tu correo."];
        }

        if (!password_verify($password, $user['pass'])) {
            $this->sendFailedLoginEmail($user);
            return ["errno" => 403, "error" => "Credenciales no válidas"];
        }

        // Login correcto
        $this->email = $email;
        $_SESSION[APP_NAME]["user"] = $this;
        $_SESSION[APP_NAME]["user_id"] = $user['id_user'];
        $_SESSION[APP_NAME]["token"] = $user['token'];

        $this->sendLoginSuccessEmail($user);

        return ["errno" => 202, "error" => "Acceso válido", "user" => $user];
    }


    private function sendLoginSuccessEmail($user) {
        $subject = "Inicio de sesión exitoso";
        $message = "
            Iniciaste sesión correctamente.<br>
            IP: ".$_SERVER['REMOTE_ADDR']."<br>
            Navegador: ".$_SERVER['HTTP_USER_AGENT']."<br><br>
            Si no fuiste vos, bloqueá tu cuenta:<br>
             <a href='https://mattprofe.com.ar/alumno/9899/app-estacion/index.php?v=blocked&token={$user['token']}'>
                Bloquear cuenta
            </a>
        ";
        sendEmail($user['email'], $subject, $message);
    }


    private function sendFailedLoginEmail($user) {
        $subject = "Intento fallido de inicio de sesión";
        $message = "
            Se intentó acceder a tu cuenta con contraseña incorrecta.<br>
            IP: ".$_SERVER['REMOTE_ADDR']."<br>
            Navegador: ".$_SERVER['HTTP_USER_AGENT']."<br><br>
            Si no fuiste vos, bloqueá tu cuenta:<br>
            <a href='https://mattprofe.com.ar/alumno/9899/app-estacion/index.php?v=blocked&token={$user['token']}'>
                Bloquear cuenta
            </a>
        ";
        sendEmail($user['email'], $subject, $message);
    }


    /* ============================
       RECUPERACIÓN DE CONTRASEÑA
       ============================ */
    public function recovery($email) {

        $email = $this->escape($email);

        $user = $this->query("SELECT * FROM usuarios WHERE email = '$email'");

        if (count($user) == 0) {
            return ["errno" => 404, "error" => "El email no está registrado"];
        }

        $token_action = bin2hex(random_bytes(32));

        $this->query("
            UPDATE usuarios
            SET recupero = 1,
                recover_date = CURRENT_TIMESTAMP,
                token_action = '$token_action'
            WHERE email = '$email'
        ");

        $this->sendRecoveryEmail($email, $token_action);

        return ["errno" => 202, "error" => "Se envió un email para restablecer la contraseña."];
    }


    private function sendRecoveryEmail($email, $token_action) {

    $url = "http://mattprofe.com.ar/alumno/9899/app-estacion/index.php?v=reset&token_action=" . $token_action;

    $subject = "Restablecer contraseña";
    $message = "
        Para restablecer tu contraseña hacé clic en:<br><br>
        <a href='$url'>Restablecer contraseña</a>
    ";

    sendEmail($email, $subject, $message);
}



    public function resetPassword($token_action, $password, $repeat_password) {

        $token_action = $this->escape($token_action);

        if ($password !== $repeat_password) {
            return ["errno" => 400, "error" => "Las contraseñas no coinciden"];
        }

        $user = $this->query("
            SELECT * 
            FROM usuarios 
            WHERE token_action = '$token_action'
            AND (recupero = 1 OR bloqueado = 1)
        ");

        if (count($user) == 0) {
            return ["errno" => 404, "error" => "Token inválido"];
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $this->query("
            UPDATE usuarios
            SET pass = '$hash',
                token_action = '',
                recupero = 0,
                bloqueado = 0
            WHERE token_action = '$token_action'
        ");

        $this->sendResetConfirmationEmail(
            $user[0]['email'],
            $user[0]['token']
        );

        return ["errno" => 202, "error" => "Contraseña restablecida"];
    }


    private function sendResetConfirmationEmail($email, $token) {
        $subject = "Contraseña restablecida";
        $message = "
            Tu contraseña fue restablecida.<br><br>
            Si no fuiste vos, podés bloquear tu cuenta:<br>
            <a href='https://mattprofe.com.ar/alumno/9899/app-estacion/index.php?v=blocked&token=$token'>
                Bloquear cuenta
            </a>
        ";
        sendEmail($email, $subject, $message);
    }


    /* ============================
       ESCAPAR STRINGS
       ============================ */
    private function escape($str) {
        return $this->getConnection()->real_escape_string($str);
    }

}
?>
