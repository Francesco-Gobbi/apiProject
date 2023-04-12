<?php
// * utilizzo della libreria endroid/qr-code
use Endroid\QrCode\QrCode;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once("vendor/autoload.php");

password_hash($_REQUEST['psw'], PASSWORD_BCRYPT, 1);

if($_REQUEST['REQUEST_URI']=="/register.php"&&isset($_REQUEST['submit'])){
    $code = rand(0,PHP_INT_MAX);
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER; // Enable verbose debug output
        $mail->isSMTP(); // Send using SMTP
        $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = 'host.gmail.com'; // SMTP username
        $mail->Password   = '';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587; // TCP port to connect to
        //Recipients
        $mail->setFrom($usermail, 'Mailer');
        $mail->addAddress($_REQUEST['name']); // Add a recipient
} 
catch( Error | PDOException $e) {
    $_ENV['error'] = $e->getMessage();
    header('Location: ../index.php');
    exit();
}
?>
hny6yhg
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
    <form action="" method="post">
    <input type="text" name="name" id="name" placeholder="Enter your name">
    <br>
    <input type="password" name="psw" placeholder="Enter your password">
    <input type="submit" value="Submit" name="submit">
    </form>
</body>
</html>
