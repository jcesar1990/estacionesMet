<html>
<head>
<title>AlertaRegional</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta charset="utf-8" />
<meta content="MSHTML 6.00.2900.2180" name="GENERATOR">
<link rel=stylesheet href="../css/alertas.css" type="text/css">
</head>
<body>
<img src="../img/Logo_CDMX.png" alt="Girl in a jacket" width="500" height="120">
<img src="../img/Logo_Dependencia.png" alt="Girl in a jacket" width="600" height="120">
<?php
include '../lib/conexion.php';
include '../lib/funciones.php';
//include '../lib/fechas.php';
date_default_timezone_set('America/Monterrey');
$fechaActual = date('Y-m-d');
$horaActual=date('G:i');
//Fecha de prueba:
//$fechaActual= '2022-09-28';
include '../modelo/queries.php';
echo "<hr>";
/* Obtiene los datos actuales */
$qrySacaActuales="
SELECT m.nombreDemarcacion as Demarcacion, substring(e.idDemarcacion,1,2) as entidad, 
e.nombreEstacion as Estacion, d.idEstacion nif, 
d.temperatura, d.humedadRelativa, d.velocidadViento, d.direccionViento,d.velocidadRacha,d.lluvia,d.radiacionSolar, d.fechaHora
FROM registro_ema d INNER JOIN
c_estacion  e  ON e.idEstacion= d.idEstacion INNER JOIN
c_demarcacion m ON m.idDemarcacion=e.idDemarcacion
LEFT JOIN (SELECT t.idEstacion nif,max(fechaHora) num_dir
		   FROM `registro_ema` t
       WHERE date(fechaHora)='$fechaActual'
       GROUP BY t.idEstacion
      ) du ON du.nif=d.idEstacion
WHERE d.fechaHora=du.num_dir
and date(fechaHora)='$fechaActual'
and substring(e.idDemarcacion,1,2)='09'
GROUP BY m.nombreDemarcacion,substring(e.idDemarcacion,1,2),e.nombreEstacion
ORDER BY d.fechaHora DESC
";
$res0=mysqli_query($conn, $qrySacaActuales);

echo "<table border=1 width= 60% align='center'>";
      echo "<tr ><th colspan=9>CONDICIONES ACTUALES registradas hasta las ".$horaActual." del ".$fechaActual." por las redes de la SGIRPC y CONAGUA</th></tr>";
      echo "<tr>
			<th>Fecha hora</th>
			<th>Demarcaci&oacute;n</th>
			<th>Estaci&oacute;n</th>
			<th>Temperatura</th>
			<th>Humedad Relativa</th>
			<th>Viento</th>
			<th>Racha</th>
			<th>Direcci&oacute;n Viento</th>
			<th>Lluvia</th>
			<tr>";
      echo "<tr>";
while($row = mysqli_fetch_array($res0, MYSQLI_ASSOC)){
						
						 	
						 		echo "<td>".$row["fechaHora"]."</td>";
          			echo "<td>".$row["Demarcacion"]."</td>";
								//echo "<td>".$row["entidad"]."</td>"; 
    						echo "<td>".$row["Estacion"]."</td>";
								echo "<td>".str_replace('9999.0','-',$row["temperatura"])."</td>";
								//if(($row["temperatura"])>20)
								//		mail("fsernag13@gmail.com","Alerta Amarilla por temperaturas altas","Se ha rebasado el umbral de temperaturas altas en la demarcación");
          			echo "<td>".str_replace('9999.0','-',$row["humedadRelativa"])."</td>";
								echo "<td>".str_replace('9999.0','-',$row["velocidadViento"])."</td>";
								echo "<td>".str_replace('9999.0','-',$row["velocidadRacha"])."</td>";
								echo "<td>".str_replace('9999.0','-',$row["direccionViento"])."</td>";
								echo "<td>".str_replace('9999.0','-',$row["lluvia"])."</td>";
          			echo "</tr>";
}//while
echo "</table>";