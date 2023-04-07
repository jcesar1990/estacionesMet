<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<?php
include '../lib/conexion.php';
//include '../lib/fechas.php';
date_default_timezone_set('America/Mexico_City');
$fechaActual = date('Y-m-d');

$qryCargaExtremos="
INSERT IGNORE INTO extremo(idEstacion,idVariable,valor,fechaHora) 
SELECT d.idEstacion nif, 'TX',max(d.temperatura) as maxt, fechaHora 
 FROM registro_ema d INNER JOIN 
 c_estacion e ON e.idEstacion= d.idEstacion INNER JOIN 
 c_demarcacion m ON m.idDemarcacion=e.idDemarcacion LEFT JOIN 

		 (SELECT t.idEstacion nif,date(fechaHora),'TX',max(`temperatura`) num_dir 
         FROM `registro_ema` t 
         WHERE date(`fechaHora`)='$fechaActual' 
         GROUP BY t.idEstacion, date(fechaHora)
         ORDER BY max(`temperatura`) DESC) du ON du.nif=d.idEstacion     
         WHERE d.temperatura=du.num_dir 
 and date(fechaHora)='$fechaActual'  
 GROUP BY m.nombreDemarcacion,substring(e.idDemarcacion,1,2),e.nombreEstacion 
 ORDER BY d.temperatura DESC;
";

$res1 = mysqli_query($conn, $qryCargaExtremos);

echo "Registros de temperatura m&aacute;xima actualizados en la base de datos el ".date('Y-m-d G:i');
?>
</body>
