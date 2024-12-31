<?php 
require('./class.phpmailer');
require('./class.smtp');

// ReCAPTCHA validation
$secretKey = "6LcBtaoqAAAAAAhbwNpbdAnFV-WsSy03-bJlyYot";
$responseKey = $_POST['g-recaptcha-response'];
$userIP = $_SERVER['REMOTE_ADDR'];

// Verificar la respuesta del reCAPTCHA con la API de Google
$verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP");
$responseData = json_decode($verifyResponse);

if (!$responseData->success) {
    die("Error: Por favor verifica el reCAPTCHA.");
}

// Capturar los datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$correo = $_POST['email'];
$descripcion = $_POST['descripcion'];

// Configurar PHPMailer
$mail = new PHPMailer();
$mail->IsSMTP();										
$mail->Host = "mail.minicargadoreskleber.com";  		
$mail->SMTPAuth = true;								
$mail->Username = "contacto@minicargadoreskleber.com";	
$mail->Password = "Vanessa2019vane";					

$mail->From = "adesigns7@gmail.com"; //contacto@minicargadoreskleber.com
$mail->FromName = "Mailer";
$mail->AddAddress("contacto@minicargadoreskleber.com", "Web");
$mail->AddReplyTo("contacto@minicargadoreskleber.com", "Información");

$mail->WordWrap = 50;
$mail->IsHTML(true);

$mail->Subject = "Mensaje desde la Web";
$mail->Body    = "Nombre: $nombre <br> Apellido: $apellido <br> Telefono: $telefono <br> E-mail: $correo <br> Mensaje: $descripcion <br>";
$mail->AltBody = "$nombre /n $apellido cuerpo de texto sin formato para los clientes de correo no HTML";

if(!$mail->Send()) {
    echo "El mensaje no se ha podido enviar. <p>";
    echo "Error: " . $mail->ErrorInfo;
    exit;
}
echo '<script type="text/javascript">
    window.location="http://minicargadoreskleber.com";
    </script>';
?>
