<?php
echo "<div align='center'>";
echo "<br>";
echo "<hr><br>";
echo "<table border=1 width= 80% align='center'>";
echo "<tr ><th colspan=9>CONDICIONES ACTUALES registradas el ".$fechaActual." por las redes de la SGIRPC y CONAGUA (".$horaActual." horas)</th></tr>";
echo "<tr>
      <th>Fecha hora</th>
      <th>Demarcaci&oacute;n</th>
      <th>Estaci&oacute;n</th>
      <th>Temperatura <a href='http://192.168.20.17:8080/estacionesMet/index.php?a=1&o=t&s=".$dir."&v=a'><img src='img/flechas.png' alt='Ordenar Ascendente-Descendente' width='15' height='20'></th></a>
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
                          echo "<td align='center' class='celdaBlanco'>".str_replace('9999','-',round($row["humedadRelativa"],0))." %</td>";
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
                          echo "<td class='celdaBlanco'>".$rumbo."</td>";

                          $colorCelda=obtenColorLluvia($row["lluvia"]);
                          echo "<td class=$colorCelda>".str_replace('9999.0','-',$row["lluvia"])."</td>";
                echo "</tr>";
}//while
if (date('G') > 12)
{
  echo "<tr><td colspan=9>";
  echo "<b>Temperaturas:</b> <img src='' class='cuadroPurpura'> y <img src='' class='cuadroRojo'> Extremadamente Caluroso;&nbsp; 
  <img src='' class='cuadroNaranja'> y <img src='' class='cuadroAmarillo'> Muy Caluroso;&nbsp;  
  <img src='' class='cuadroAmarilloClaro'> Caluroso; <img src='' class='cuadroVerdeClaro'> C&aacute;lido;&nbsp;
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
echo "<br>";
echo "</div>";
?>