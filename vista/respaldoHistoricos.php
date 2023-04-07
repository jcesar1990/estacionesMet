<?php
echo "<div align='center'>";
echo "<br>";
echo "<hr><br>";
date_default_timezone_set('America/Monterrey');
$act=$_GET['a'];
$ord=$_GET['o'];
$dir=$_GET['s'];

if ($dir=="DESC")
    $dir="ASC";
else
    $dir="DESC";
switch ($ord)
{
	case "t":
		$varOrd="temperatura";
        $ord="temperatura ".$dir.", d.fechaHora DESC";
		break;
    case "f":
        $varOrd="temperatura";
        $ord="d.fechaHora DESC";
        break;
    case "v":
        $varOrd="d.velocidadViento";
        $ord="d.velocidadViento DESC, d.fechaHora DESC ";
        break;
                
	default:
		$ord= "m.nombreDemarcacion";
}

if(isset($_GET['f'])) {
	$hayFecha=1;
	$fechaActual=substr($_GET['f'],0,4)."-".substr($_GET['f'],4,2)."-".substr($_GET['f'],6,2);
	$horaActual='';
}//if
else{
		$hayFecha=0;
		$fechaActual = date('Y-m-d');
		$horaActual=date('G:i');
}//else
include '../modelo/queries.php';
/*
if ((!($hayFecha)) and  ($act=1)){
    
	echo "<table border=1 width= 60% align='center'>";
      
      echo "<tr ><th colspan=9>CONDICIONES ACTUALES registradas el ".$fechaActual." por las redes de la SGIRPC y CONAGUA (".$horaActual." horas)</th></tr>";
      echo "<tr>
			<th>Fecha hora</th>
			<th>Demarcaci&oacute;n</th>
			<th>Estaci&oacute;n</th>
			<th>Temperatura <a href='http://192.168.20.17:8080/estacionesMet/control/muestraExtremos.php?a=1&o=t&s=".$dir."'><img src='../img/flechas.png' alt='Ordenar Ascendente-Descendente' width='15' height='20'></th></a>
			<th>H. R.</th>
			<th>Viento</th>
			<th>Racha</th>
			<th>Direcci&oacute;n Viento</th>
			<th>Lluvia</th>
			<tr>";
      echo "<tr>";
while($row = mysqli_fetch_array($res0, MYSQLI_ASSOC)){
						    
						 	
						 		echo "<td>".$row["fechaHora"]."</td>";
								if($row["Demarcacion"] == 'Iztacalco')
								{
              						echo "<td><b>".$row["Demarcacion"]."</b></td>";
        							echo "<td><b>".$row["Estacion"]."</b></td>";
								}
								else
								{
								 		echo "<td>".$row["Demarcacion"]."</td>";	
        								echo "<td>".$row["Estacion"]."</td>";
								}
								//echo "<td>".$row["entidad"]."</td>";
                                $colorCelda=obtenColorTemps($row["temperatura"]); 
								if ($row["temperatura"] < 40) 
									echo "<td class=$colorCelda>".str_replace('9999.0','-',$row["temperatura"])."</td>";
          			            else
								  	echo "<td class=$colorCelda> - </td>";
								echo "<td align='center'>".str_replace('9999','-',round($row["humedadRelativa"],0))." %</td>";
                                $colorCelda=obtenColorViento($row["velocidadViento"]);
								echo "<td class=$colorCelda>".str_replace('9999.0','-',$row["velocidadViento"])."</td>";
                                $colorCelda=obtenColorViento($row["velocidadRacha"]);
								echo "<td class=$colorCelda>".str_replace('9999.0','-',$row["velocidadRacha"])."</td>";
								$grados=(float)($row["direccionViento"]);
								switch ($grados) 
               { 
                        case 0:
              							 $rumbo='Calma';
              							 break;
              					case ($grados >= 348.76 && $grados <= 360):
              							 $rumbo='N';
              							 break;
												case ($grados > 0 && $grados <= 11.25):
              							 $rumbo='N';
              							 break;
              					case ($grados >= 11.26 && $grados <= 33.75): 
              							 $rumbo='NNE';
              							 break;
              					case ($grados >= 33.76 && $grados <= 56.25):
              							 $rumbo='NE';
              							 break;
              					case ($grados >= 56.26 && $grados <= 78.75): 
              							 $rumbo='ENE';
              							 break;
              					case ($grados >= 78.76 && $grados <= 101.25): 
              							 $rumbo='E';
              							 break;
              					case ($grados >= 101.26 && $grados <= 123.75): 
              							 $rumbo='ESE';
              							 break;
              					case ($grados >= 123.76 && $grados <= 146.25): 
              							 $rumbo='SE';
              							 break;
              					case ($grados >= 146.26 && $grados <= 168.75): 
              							 $rumbo='SSE';
              							 break;
              					case ($grados >= 168.76 && $grados <= 191.25): 
              							 $rumbo='S';
              							 break;
              					case ($grados >= 191.26 && $grados <= 213.75): 
              							 $rumbo='SSW';
              							 break;
              					case ($grados >= 213.76 && $grados <= 236.25): 
              							 $rumbo='SW';
              							 break;
              					case ($grados >= 236.26 && $grados <= 258.75): 
              							 $rumbo='WSW';
              							 break;
              					case ($grados >= 258.76 && $grados <= 281.25): 
              							 $rumbo='W';
              							 break;
              					case ($grados >= 281.26 && $grados <= 303.75): 
              							 $rumbo='WNW';
              							 break;
              					case ($grados >= 303.76 && $grados <= 326.250): 
              							 $rumbo='NW';
              							 break;
              					case ($grados >= 326.26 && $grados <= 348.75): 
              							 $rumbo='NNW';
              							 break;
												case 9999:
														 $rumbo='-';
              	}//switch
								echo "<td>".$rumbo."</td>";

                                $colorCelda=obtenColorLluvia($row["lluvia"]);
								echo "<td class=$colorCelda>".str_replace('9999.0','-',$row["lluvia"])."</td>";
          			echo "</tr>";
}//while
if (date('G') > 12)
{
        echo "<tr><td colspan=9>";
        echo "<b>Temperaturas:</b> <img src='' class='cuadroPurpura'> y <img src='' class='cuadroRojo'> Extremadamente Caluroso;&nbsp; 
        <img src='' class='cuadroNaranja'> y <img src='' class='cuadroAmarillo'> Muy Caluroso;&nbsp;  
        <img src='' class='cuadroVerdeFuerte'> Caluroso; <img src='' class='cuadroVerdeClaro'> C&aacute;lido;&nbsp;
        <img src='' class='cuadroAzulFuerte'> Templado; <img src='' class='cuadroAzulClaro'> Fresco;&nbsp; 
        <img src='' class='cuadroGris'> Fr&iacute;o"; 
        echo "</td></tr>";
}
else {
        echo "<tr><td colspan=9>";
        echo "
        <img src='' class='cuadroAzulFuerte'> Templado&nbsp;&nbsp; 
        <img src='' class='cuadroAzulClaro'> Fresco&nbsp;&nbsp; 
        <img src='' class='cuadroGris'> Fr&iacute;o&nbsp;
        <img src='' class='cuadroAmarillo'> y <img src='' class='cuadroNaranja'> Muy Fr&iacute;o;&nbsp;
        <img src='' class='cuadroRojo'> y <img src='' class='cuadroPurpura'> Extremadamente Fr&iacute;o;&nbsp; 
        ";
        echo "</td></tr>";
}//else de cuadritos según la hora
echo "</table>";
}//si hay fecha de par�metroi de entrada


// ************************** MUESTRAS TEMPERATURAS M�XIMAS  ********************************************
$res1 = mysqli_query($conn, $qrySacaExtremos1);
include '../vista/muestraTablaMaximas.php';
// ************************** MUESTRAS TEMPERATURAS M�NIMAS  ********************************************
$res2 = mysqli_query($conn, $qrySacaExtremos2);
include '../vista/muestraTablaMinimas.php';
// ************************** LLUVIAS ACUMULADAS AL MOMENTO  ********************************************
//$res3 = mysqli_query($conn, $qrySacaExtremos3);
$res3 = mysqli_query($conn, $qrySacaAcumLluvia);
include '../vista/muestraTablaLluvias.php'; 
// ************************** FRECUENCIA DE VIENTOS  ********************************************
		
/*		
$qrySacaExtremosVto="
SELECT m.nombreDemarcacion,d.idEstacion,
CONCAT(e.nombreEstacion,' (', p.abreviaturaDependencia,')') as estacion,
date(d.fechaHora) as fecha, max(`velocidadViento`) as maxVto, max(velocidadRacha) as maxRacha, count(*) as frecuencia 
FROM `registro_ema` d INNER JOIN
c_estacion  e  ON e.idEstacion= d.idEstacion INNER JOIN
c_demarcacion m ON m.idDemarcacion=e.idDemarcacion INNER JOIN
c_dependencia p ON e.idDependencia=p.idDependencia
WHERE date(fechaHora)='$fechaActual'
and substring(e.idDemarcacion,1,2)='09'
and direccionViento <>9999
and velocidadViento <> 9999
group by d.idEstacion,date(d.fechaHora)
order by  max(`velocidadViento`) DESC,max(velocidadRacha) DESC
";

$res4=mysqli_query($conn, $qrySacaExtremosVto);
$registradoYa=0;


	  echo "<table border=1 width= 60% align='center'>";
      echo "<tr ><th colspan=5>Datos de VELOCIDAD M&Aacute;XIMA Y M&Aacute;XIMA FRECUENCIA de VIENTO registrados el ".$fechaActual." hasta las ".$horaActual." por las redes de la SGIRPC y CONAGUA</th></tr>";
      echo "<tr><th>Demarcaci&oacute;n</th><th>Estaci&oacute;n</th><th>Viento M&aacute;ximo</th><th>Racha M&aacute;xima</th><th>Frecuencia M&aacute;xima de Direcci&oacute;n</th><tr>";
      echo "<tr>";
while($row = mysqli_fetch_array($res4, MYSQLI_ASSOC)){
      $demarcacion=$row["nombreDemarcacion"];
			$idEstacion=$row["idEstacion"];
			$estacion=$row["estacion"];
			$fecha=$row["fecha"];
      		$maxVto=$row["maxVto"];
			$maxRacha=$row["maxRacha"];
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
      	where idEstacion='$idEstacion'
				and direccionViento <>9999
				and date(fechaHora)= '$fechaActual') t
      group by t.direccionViento
      order by frecuencia desc
      ";
			
      $res5 = mysqli_query($conn, $qrySacaFrecDirVto);
      
			while($row = mysqli_fetch_array($res5, MYSQLI_ASSOC)){
						$colorCelda=obtenColorViento($maxRacha);
						if($registradoYa==0)
						{
          			        echo "<td class=$colorCelda>".$demarcacion."</td>";
							echo "<td class=$colorCelda>".$estacion."</td>"; 
    						echo "<td class=$colorCelda>".str_replace('9999.0','-',$maxVto)."</td>";
							echo "<td class=$colorCelda>".str_replace('9999.0','-',$maxRacha)."</td>";
          			        echo "<td class=$colorCelda>".$row["dirVto"]."&nbsp(".(round(($row["frecuencia"]/$total),1)*100)." %)</td>";
          			        echo "</tr>";
							$registradoYa=1;
						}//if
         }//while
			   $registradoYa=0;
				 $total=0;
      
}//while externo
			echo "<tr><td colspan=5>";
      echo "<img src='' class='cuadroPurpura'>Rachas violentas (> 79.5 km/h);&nbsp;
			<img src='' class='cuadroRojo'> Rachas extremadamente fuertes (69.5 a 79.4 km/h);&nbsp; 
            <img src='' class='cuadroNaranja'> Rachas Muy Fuertes (59.5 a 69.4 km/h);&nbsp;
            <img src='' class='cuadroAmarillo'> Rachas Fuertes (49.5 a 59.4 km/h);&nbsp;
            <img src='' class='cuadroAmarilloClaro'> Rachas Moderadas(40 a 49.5 km/h);&nbsp; 
            <img src='' class='cuadroVerdeClaro'> Rachas Moderadas (30 a 39.5 km/h);&nbsp; 
            <img src='' class='cuadroGris'> Rachas Débiles (5 a 25 km/h);&nbsp; 
            <img src='' class='cuadroBlanco'> Calmas ( rachas menores a 5 km/h)";

      echo "</td></tr>";
      echo "</table>";
 echo "<hr>";
 */
echo "<br>";
echo "</div>";
?>
