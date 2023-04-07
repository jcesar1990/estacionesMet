
<?php
echo "<div align='center'>";
echo "<br>";
echo "<hr><br>";
 $registradoYa=0;
 /* Muestra las tabla*/
       echo "<table border=1 width= 80% align='center'>";
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
             <img src='' class='cuadroAzulClaro'> Rachas Moderadas (25.1 a 29.5 km/h);&nbsp;
             <img src='' class='cuadroGris'> Rachas Débiles (5 a 25 km/h);&nbsp; 
             <img src='' class='cuadroBlanco'> Calmas ( rachas menores a 5 km/h)";
 
       echo "</td></tr>";
       echo "</table>";
       echo "<br>";
       echo "</div>";
?>