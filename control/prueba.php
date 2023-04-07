<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<?php
include '../lib/conexion.php';
//phpinfo();

ini_set("SMTP","ssl://smtp.gmail.com");
ini_set("smtp_port","25");
ini_set('sendmail_from', "fsernag13@gmail.com");
$destinatario = "fsernag13@gmail.com"; 
$asunto = "Este mensaje es de prueba"; 
$cuerpo = ' 
<html> 
<head> 
   <title>Prueba de correo</title> 
</head> 
<body> 
<h1>Hola amigos!</h1> 
<p> 
<b>Bienvenidos a mi correo electrónico de prueba</b>. Estoy encantado de tener tantos lectores. Este cuerpo del mensaje es del artículo de envío de mails por PHP. Habría que cambiarlo para poner tu propio cuerpo. Por cierto, cambia también las cabeceras del mensaje. 
</p> 
</body> 
</html> 
'; 

//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//dirección del remitente 
$headers .= "From: Paco <fsernag13@gmail.com>\r\n"; 

//dirección de respuesta, si queremos que sea distinta que la del remitente 
$headers .= "Reply-To: fsernag13@gmail.com\r\n"; 

//ruta del mensaje desde origen a destino 
$headers .= "Return-path: fsernag13@gmail.com\r\n"; 

//direcciones que recibián copia 
$headers .= "Cc: fsernag13@gmail.com\r\n"; 

//direcciones que recibirán copia oculta 
$headers .= "Bcc: fsernag13@gmail.com\r\n"; 

mail($destinatario,$asunto,$cuerpo,$headers)


?>

</body>
</html>