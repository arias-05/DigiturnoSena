<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;

class envio_mail
{
    private $mail;
    function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->SMTPDebug = SMTP::DEBUG_CLIENT;          // Habilitar salida de depuración detallada
        $this->mail->isSMTP();                                // Enviar usando SMTP
        $this->mail->Host       = 'smtp.gmail.com';           // Establecer el servidor SMTP para enviar a través de Gmail
        $this->mail->SMTPAuth   = true;                       // Habilitar autenticación SMTP
        $this->mail->Username   = 'digiturnosena01@gmail.com';       // Correo electrónico de Gmail
        $this->mail->Password   = 'kchmsbuacjrfjtfa';             // Contraseña de Gmail
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Habilitar cifrado TLS
        $this->mail->Port       = 587;
        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $this->mail->CharSet = 'utf-8';
        $this->mail->setFrom('digiturnosena01@gmail.com', 'Digiturno-SENA');
    }
    public function recepcion($mail)
    {
        $this->mail->addAddress($mail);
    }
    

    public function mensaje($Subjet, $Body)
    {
        $this->mail->isHTML(true);                                  //Set email format to HTML
        $this->mail->Subject = $Subjet;
        $this->mail->Body = $Body;
    }
    public function enviar()
    {
        $this->mail->send();
    }
    
}
