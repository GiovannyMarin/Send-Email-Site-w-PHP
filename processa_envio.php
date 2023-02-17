<?php

require "./biblio/PHPMailer/OAuthTokenProvider.php";
require "./biblio/PHPMailer/Exception.php";
require "./biblio/PHPMailer/OAuth.php";
require "./biblio/PHPMailer/PHPMailer.php";
require "./biblio/PHPMailer/POP3.php";
require "./biblio/PHPMailer/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mensagem
{
    private $para = null;
    private $assunto = null;
    private $mensagem = null;

    public function __get($attr)
    {
        return $this->$attr;
    }

    public function __set($attr, $valor)
    {
        return $this->$attr = $valor;
    }

    public function mensagemValida()
    {
        if (empty($this->para) || empty($this->assunto) || empty($this->mensagem)) {
            return false;
        }

        return true;
    }
}

$mensagem = new Mensagem();

$mensagem->__set('para', $_POST['para']);
$mensagem->__set('assunto', $_POST['assunto']);
$mensagem->__set('mensagem', $_POST['mensagem']);


if ($mensagem->mensagemValida()) {
    echo 'n eh valida';
    die();
}

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'aerocold266@gmail.com';                     //SMTP username
    $mail->Password   = 'ncsjvejzuuyodkwv';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('giovanny466@hotmail.com', 'Giovanny');
    $mail->addAddress('giovanny466@hotmail.com', 'Joe User');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Assunto';
    $mail->Body    = 'oi eu sou o conteudo do <strong>email</strong>';
    $mail->AltBody = 'oi eu sou o conteudo do email';

    $mail->send();
    echo 'Nao foi possivel enviar esse email, tente novamente mais tarde';
} catch (Exception $e) {
    echo "Detalhes do erro: {$mail->ErrorInfo}";
}



?><!-->