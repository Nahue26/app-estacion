<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../mp-mailer-master/Mailer/src/Exception.php';
require_once __DIR__ . '/../mp-mailer-master/Mailer/src/PHPMailer.php';
require_once __DIR__ . '/../mp-mailer-master/Mailer/src/SMTP.php';

class MailerLib {
public static function send($to, $subject, $htmlBody){
$mail = new PHPMailer(true);
try{
require __DIR__ . '/../mp-mailer-master/credenciales.php';

$mail->isSMTP();
$mail->Host = HOST;
$mail->SMTPAuth = SMTP_AUTH;
$mail->Username = REMITENTE;
$mail->Password = PASSWORD;
$mail->SMTPSecure = SMTP_SECURE;
$mail->Port = PORT;

$mail->setFrom(REMITENTE, NOMBRE);
$mail->addAddress($to);
$mail->isHTML(true);
$mail->Subject = $subject;
$mail->Body = $htmlBody;

return $mail->send();
}catch(Exception $e){
error_log('Mailer error: ' . $e->getMessage());
return false;
}
}
}