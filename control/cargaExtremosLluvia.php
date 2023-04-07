<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<?php
include '../lib/conexion.php';
//include '../lib/fechas.php';
date_default_timezone_set('America/Mexico_City');
$fechaActual = date('Y-m-d');
$fechaActual= '2023-03-26';

echo $qryCargaExtremos="
INSERT IGNORE INTO extremo(idEstacion,idVariable,valor,fechaHora)
SELECT `idEstacion`,'LL',lluvia,`fechaHora`
FROM `registro_ema` 
WHERE date(fechaHora) ='$fechaActual'
AND lluvia <> 9999
";

$res1 = mysqli_query($conn, $qryCargaExtremos);
?>
</body>
</html>