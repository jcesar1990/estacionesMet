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

date_default_timezone_set('America/Monterrey');
$fechaActual = date('Y-m-d');
$horaActual=date('G:i');
include '../lib/conexion.php';
include '../lib/funciones.php';


$qrySacaExtremosVto="
SELECT idEstacion,date(`fechaHora`) as fecha, max(`velocidadRacha`) as maxVto, count(*) as frecuencia FROM `registro_ema` 
WHERE date(fechaHora)='$fechaActual'
group by `idEstacion`,date(`fechaHora`)
order by max(`velocidadRacha`) DESC;
";
$res4=mysqli_query($conn, $qrySacaExtremosVto);


$registradoYa=0;
/* Muestra las tabla*/
			echo "<table border=1 width= 60% align='center'>";
      echo "<tr ><th colspan=5>Datos de VELOCIDAD M&Aacute;XIMA Y M&Aacute;XIMA FRECUENCIA del VIENTO registrados el ".$fechaActual." hasta las ".$horaActual." por las redes de la SGIRPC y CONAGUA</th></tr>";
      echo "<tr><th>Demarcaci&oacute;n</th><th>Estaci&oacute;n</th><th>Viento M&aacute;ximo<p>Frecuencia M&aacute;xima de Direcci&oacute;n</th><tr>";
      echo "<tr>";
while($row = mysqli_fetch_array($res4, MYSQLI_ASSOC)){
      $idEstacion=$row["idEstacion"];
			$fecha=$row["fecha"];
      $maxVto=$row["maxVto"];
			$total=$row["frecuencia"];
			

      $qrySacaFrecDirVto="
      select t.direccionViento as dirVto, count(*) as frecuencia
      from (
        select case  
          when (direccionViento between 348.76 and 360) or (direccionViento between 0.5 and 11.25) then 'N'
          when direccionViento between 11.26 and 33.75 then 'NNE'
          when direccionViento between 33.76 and 56.25 then 'NE'
          when direccionViento between 56.26 and 78.75 then 'ENE'
          when direccionViento between 78.76 and 101.25 then 'E'
          when direccionViento between 101.26 and 123.75 then 'ESE'
          when direccionViento between 123.76 and 146.25 then 'SE'
          when direccionViento between 146.26 and 168.75 then 'SSE'
          when direccionViento between 168.76 and 191.25 then 'S'
          when direccionViento between 191.26 and 213.75 then 'SSW'
          when direccionViento between 213.76 and 236.25 then 'SW'
          when direccionViento between 236.26 and 258.75 then 'WSW'
          when direccionViento between 258.76 and 281.25 then 'W'
          when direccionViento between 281.26 and 303.75 then 'WNW'
          when direccionViento between 303.76 and 326.25 then 'NW'
          when direccionViento between 326.26 and 348.75 then 'NNW'
          else 'Calma' end as direccionViento
        	from registro_ema
      	where direccionViento <>9999
      	and idEstacion='$idEstacion'
				and date(fechaHora)= '$fechaActual') t
      group by t.direccionViento
      order by frecuencia desc
      ";
      $res5 = mysqli_query($conn, $qrySacaFrecDirVto);
      
			
      while($row = mysqli_fetch_array($res5, MYSQLI_ASSOC)){
						$colorCelda=obtenColorViento($maxVto);
						if($registradoYa==0)
						{
          			echo "<td class=$colorCelda>".$idEstacion."</td>"; 
    						echo "<td class=$colorCelda>".$maxVto."</td>";
          			echo "<td class=$colorCelda>".$row["dirVto"]."&nbsp(".(round(($row["frecuencia"]/$total),1)*100)." %)</td>";
          			echo "</tr>";
								$registradoYa=1;
						}//if
         }//while
			   $registradoYa=0;
				 $total=0;
      
}//while externo
			echo "<tr><td colspan=4>";
      echo "<img src='' class='cuadroPurpura'> y <img src='' class='cuadroRojo'> Lluvia Intensa;&nbsp; 
      <img src='' class='cuadroNaranja'> Lluvia Muy Fuerte;&nbsp;
      <img src='' class='cuadroAmarillo'> Lluvia Fuerte;&nbsp;
      <img src='' class='cuadroVerdeFuerte'> Lluvia Moderada;&nbsp;
      <img src='' class='cuadroVerdeClaro'> y <img src='' class='cuadroAzulClaro'> Lluvia Ligera;&nbsp; 
      <img src='' class='cuadroGris'> Lluvia muy ligera";
      echo "</td></tr>";
      echo "</table>";
 echo "<hr>";
?>