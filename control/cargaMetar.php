<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv='refresh' content='600'>
</head>

<?php
include '../lib/conexion.php';
date_default_timezone_set('America/Monterrey');
$fechaActual = date('Y-m-d');
$horaActual=date('G:i');
$arrEstacionesActivas=array();


$arrRegistro=array();
//echo $fechaActual."; ".$horaActual."<br>Abre archivo: ".$nomArchivo="../files/".$row["idEstacion"].".csv";
$nomArchivo="../files/MMMX.csv";
      
        //Se abre el archivo de datos de las descargas y se asigna a la variable $datos
        $datos = @fopen($nomArchivo, "r");
		$buffer=1;
        if ($datos) //Si el archivo existe se procesa
        {
            //echo $buffer = fgets($datos, 8500); //Lee la primera linea de encabezados y la ignora
						//while ($buffer=fgets($datos, 8500))
						while ($buffer)
						{
             		            echo $buffer = fgets($datos, 8500); //Lee la linea y la almacena en el buffer, maximo $largo_ln caracteres por linea
            		            echo "<br>";
                                $arrRegistro=explode(",",$buffer);  
								
                                echo "<br>Estacion:".$idEstacion=$arrRegistro[0];
								$fechaHoraZ=$arrRegistro[1];
								echo "<br>viento:".$viento=$arrRegistro[2];
								echo "<br>visibilidad:".$visibilidad=$arrRegistro[3];
								echo "<br>condicionCielo:".$condicionCielo=$arrRegistro[4];
								echo "<br>tempPtoRocio:".$tempPtoRocio=$arrRegistro[5];
echo "<br>".substr($tempPtoRocio,0,1);
								if(!is_numeric(substr($tempPtoRocio,0,1)))
	echo "<br>tempPtoRocio:".$tempPtoRocio=$arrRegistro[6];
if(!is_numeric(substr($tempPtoRocio,0,1)))
	echo "<br>tempPtoRocio:".$tempPtoRocio=$arrRegistro[7];



								echo "<br>altimetro:".$altimetro=$arrRegistro[6];
								echo "<br>nosig:".$nosig=$arrRegistro[7];
							
                                
								$dia=substr($arrRegistro[1],0,2);
								$mes=date('m');
								$anio=date('Y');
            		            
								$hora=trim(substr($arrRegistro[1],2,2));
								$minutos=trim(substr($arrRegistro[1],4,2));	
								$hora=$hora.":".$minutos;			
								echo "<br>fechaHoraUTC:".$fechaHora=$anio."-".$mes."-".$dia." ".$hora;
								$fechaHora = new DateTime($fechaHora, new DateTimeZone('UTC'));
								$fechaHora->setTimezone(new DateTimeZone('America/Monterrey'));
								$fechaHora->format('Y-m-d H:i');
								echo "<br>fechaHora:".$fechaHora = $fechaHora->format('Y-m-d H:i');

								echo "<br>dirViento:".$dirViento=(int)substr($arrRegistro[2],0,3);
								echo "<br>velViento:".$velViento=((int)substr($arrRegistro[2],3,2))*1.85;

								if(strlen($arrRegistro[2]) > 7){
									echo "<br>velRacha:".$velRacha=(int)substr($arrRegistro[2],6,2);
									echo "<br>dirRacha:".$dirRacha=$dirViento;
								}else{
									echo "<br>velRacha:".$velRacha=9999;
									echo "<br>dirRacha:".$dirRacha=9999;
								}

								if (strlen($arrRegistro[3])==3)
									echo "<br>visibilidad:".$visibilidad=(int)substr($arrRegistro[3],0,1);	
								else
									echo "<br>visibilidad:".$visibilidad=(int)substr($arrRegistro[3],0,2);

							
								echo "<br>temperatura:".$temperatura=(int)substr($tempPtoRocio,0,2);

								echo "<br>humedadRelativa:".$humedadRelativa=9999;
								echo "<br>puntoRocio:".$puntoRocio=9999;
								echo "<br>presionBarometrica:".$presionBarometrica=9999;
								echo "<br>lluvia:".$lluvia=9999;

								echo "<br>";
                             
                                
                               
                                    echo $qryInsert="INSERT IGNORE INTO registro_ema (temperatura,humedadRelativa,puntoRocio,velocidadViento,direccionViento,velocidadRacha,direccionRacha,presionBarometrica,lluvia,fechaHora,idEstacion)  
                                        VALUES ($temperatura,$humedadRelativa,$puntoRocio,$velViento,$dirViento,$velRacha,$dirRacha,$presionBarometrica,$lluvia,'$fechaHora','$idEstacion')";
                                   
								 
								   if ($conn->query($qryInsert) === TRUE) 
									{
               		 					echo "New record created successfully";
									}
									else
									{
                						echo "Error: " . $qryInsert . "<br>" . $conn->error;
              						}           
								
							}
								
								
							
				/*				
						$i++;
						$cont++;
						}//end while
						
						echo "hay ".$cont." registros.";
				*/		
         		fclose ($datos); //se cierra el archivo
      // 	}//Fin de SI el archivo 
      /*  else // si el archivo NO existe
        {
           	echo "<font color=\"red\"><b>ERROR. El archivo".$nomArchivo." de la estación no existe en el directorio especificado!.</b></font><br>";
        }// fin de else el archivo NO existe

//}//fin del while principal
	}

Ejemplo para listar elementos
 //Fetching all the rows as arrays
   while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
      print("ID: ".$row["ID"]."\n");
      print("First_Name: ".$row["First_Name"]."\n");
      print("Last_Name: ".$row["Last_Name"]."\n");
      print("Place_Of_Birth: ".$row["Place_Of_Birth"]."\n");
      print("Country: ".$row["Country"]."\n");*/
		}//principal