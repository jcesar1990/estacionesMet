<?php
echo "<div align='center'>";
echo "<br>";
echo "<hr><br>";
echo "<table  border=1 width= 80% align='center'>";
echo "<tr><th colspan=4>Temperaturas máximas registradas el ".$fechaActual.", después de las 9:00 hrs. por las redes de la SGIRPC y CONAGUA</th></tr>";
echo "<tr>
<th>Demarcaci&oacute;n</th>
<th>Estaci&oacute;n</th>
<th>Temp.<p>M&aacute;x.</th>
<th>Hora</th>
<tr>";
echo "<tr>";
while($row = mysqli_fetch_array($res1, MYSQLI_ASSOC)){
      $colorCelda=obtenColorTemps($row["maxt"]);
      
      if($row["Demarcacion"] == 'Iztacalco')
      {
            echo "<td class=$colorCelda><b>*".$row["Demarcacion"]."</b></td>";
            echo "<td class=$colorCelda><b>*".$row["Estacion"]."</b></td>";
      }
      else
      {
			echo "<td class=$colorCelda>".$row["Demarcacion"]."</td>"; 
            echo "<td class=$colorCelda>".$row["Estacion"]."</td>";
      }
      if ($row["maxt"] < 40)
            echo "<td class=$colorCelda>".$row["maxt"]."</td>";
      else
      echo "<td class=$colorCelda> - </td>";
      echo "<td class=$colorCelda>".$row["fechaHora"]."</td>";
			echo "<tr>";
   }
echo "<tr><td colspan=4>";
echo "<img src='' class='cuadroPurpura'> y <img src='' class='cuadroRojo'> Extremadamente Caluroso;&nbsp; 
<img src='' class='cuadroNaranja'> y <img src='' class='cuadroAmarillo'> Muy Caluroso;&nbsp;  
<img src='' class='cuadroAmarilloClaro'> Caluroso; <img src='' class='cuadroVerdeClaro'> C&aacute;lido;&nbsp;
<img src='' class='cuadroAzulFuerte'> Templado; <img src='' class='cuadroAzulClaro'> Fresco;&nbsp; 
<img src='' class='cuadroGris'> Fr&iacute;o"; 
echo "</td></tr>";
echo "</table>";
echo "<br>";
echo "</div>";



?>