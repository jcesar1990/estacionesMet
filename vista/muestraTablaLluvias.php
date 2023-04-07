<?php
echo "<div align='center'>";
echo "<br>";
echo "<hr><br>";
echo "<table border=1 width= 80% align='center'>";
echo "<tr ><th colspan=5>Datos de LLUVIA ACUMULADA registrada el ".$fechaActual." hasta las ".$horaActual." por las redes de la SGIRPC y CONAGUA<br> EN FASE DE PRUEBAS</th></tr>";
echo "<tr><th>Demarcaci&oacute;n</th><th>Estaci&oacute;n</th><th>Lluvia Acumulada</th><tr>";
echo "<tr>";
$contador=0;
while($row = mysqli_fetch_array($res3, MYSQLI_ASSOC)){
      $colorCelda=obtenColorLluvia($row["mint"]);
			echo "<td class=$colorCelda>".$row["Demarcacion"]."</td>";  
      echo "<td class=$colorCelda>".$row["Estacion"]."</td>";
      echo "<td class=$colorCelda>".$row["mint"]."</td>";
			echo "</tr>";
      $contador++;
   }
  if ($contador==0) 
    echo "<b> No se han registrado lluvias este día en la Ciudad de México.<br><br></b>";
else{
    echo "<tr><td colspan=4>";
echo "<img src='' class='cuadroPurpura'> y <img src='' class='cuadroRojo'> Lluvia Intensa;&nbsp; 
<img src='' class='cuadroNaranja'> Lluvia Muy Fuerte;&nbsp;
<img src='' class='cuadroAmarillo'> Lluvia Fuerte;&nbsp;
<img src='' class='cuadroVerdeFuerte'> Lluvia Moderada;&nbsp;
<img src='' class='cuadroVerdeClaro'> y <img src='' class='cuadroAzulClaro'> Lluvia Ligera;&nbsp; 
<img src='' class='cuadroGris'> Lluvia muy ligera";
echo "</td></tr>";
}
echo "</table>";
echo "<br>";
echo "</div>";

?>