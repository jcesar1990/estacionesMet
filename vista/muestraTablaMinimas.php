<?php
echo "<div align='center'>";
echo "<br>";
echo "<hr><br>";
echo "<table border=1 width= 80% align='center'>";
echo "<tr ><th colspan=5>Datos de temperaturas m&iacute;nimas registradas el ".$fechaActual." por las redes de la SGIRPC y CONAGUA</th></tr>";
echo "<tr><th>Demarcaci&oacute;n</th><th>Estaci&oacute;n</th><th>Temp.<p>M&iacute;n.</th><th>Hora</th><tr>";
echo "<tr>";
while($row = mysqli_fetch_array($res2, MYSQLI_ASSOC)){
			$colorCelda=obtenColorTemps($row["mint"]);
      if($row["Demarcacion"] == 'Cuauhtémoc')
      {
        echo "<td class=$colorCelda><b>".$row["Demarcacion"]."</b></td>";
        echo "<td class=$colorCelda><b>".$row["Estacion"]."</b></td>";
      }
      else
      {
        echo "<td class=$colorCelda>".$row["Demarcacion"]."</td>";  
        echo "<td class=$colorCelda>".$row["Estacion"]."</td>";
      }
      echo "<td class=$colorCelda>".$row["mint"]."</td>";
      echo "<td class=$colorCelda>".$row["fechaHora"]."</td>";
			echo "</tr>";
   }
echo "<tr><td colspan=4>";
echo "
<img src='' class='cuadroAzulFuerte'> Templado&nbsp;&nbsp; 
<img src='' class='cuadroAzulClaro'> Fresco&nbsp;&nbsp; 
<img src='' class='cuadroGris'> Fr&iacute;o&nbsp;
<img src='' class='cuadroAmarillo'> y <img src='' class='cuadroNaranja'> Muy Fr&iacute;o;&nbsp;
<img src='' class='cuadroRojo'> y <img src='' class='cuadroPurpura'> Extremadamente Fr&iacute;o;&nbsp; 
";


 
echo "</td></tr>";
echo "</table>";
echo "<br>";
echo "</div>";
?>