<?php
require_once __DIR__ . "/mailer.php";

function sendEmail($to, $subject, $body){
    return MailerLib::send($to, $subject, $body);
}
