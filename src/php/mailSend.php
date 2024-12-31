<?php 
require('./class.phpmailer');
require('./class.smtp');

$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$telefono=$_POST['telefono'];
$correo=$_POST['email'];
$descripcion=$_POST['descripcion'];

$mail = new PHPMailer();
$mail->IsSMTP();										// Establecer envío SMTP
$mail->Host = "mail.minicargadoreskleber.com";  		// Especificar el servidor principal y de respaldo
$mail->SMTPAuth = true;									// Activar la autenticación SMTP
$mail->Username = "contacto@minicargadoreskleber.com";	// SMTP nombre de usuario
$mail->Password = "Vanessa2019vane";					// SMTP contraseña

$mail->From = "adesigns7@gmail.com";
$mail->FromName = "Mailer";
$mail->AddAddress("adesigns7@gmail.com", "Web");			// opcional
$mail->AddReplyTo("adesigns7@gmail.com", "Información");

$mail->WordWrap = 50;
$mail->IsHTML(true);

$mail->Subject = "Mensaje desde la Web";
$mail->Body    = "Nombre: $nombre <br> Apellido: $apellido <br> Telefono: $telefono <br> E-mail: $correo <br> Mensaje: $descripcion <br>";
$mail->AltBody = "$nombre /n $apellido cuerpo de texto sin formato para los clientes de correo no HTML";

if(!$mail->Send())
{
echo "El mensaje no se ha podido enviar. <p>";
echo "Error: " . $mail->ErrorInfo;
exit;
}
echo '<script type="text/javascript">
	window.location="http://minicargadoreskleber.com";
	</script>';
?>
