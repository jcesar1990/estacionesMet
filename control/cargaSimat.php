<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<?php
include '../lib/conexion.php';
 
//Se indica en pantalla la hora de ejecución de la transacción
$salida=0;
$nomArchivo="../files/simat.txt";
$faltantes=0;      
        //Se abre el archivo de datos de las descargas y se asigna a la variable $datos
$txt_file= fopen($nomArchivo, 'r');
if ($txt_file) //Si el archivo existe se procesa
{
				
    	while ($buffer = fgets($txt_file)) 
			{
        $buffer=trim($buffer);
				
				$inicia=stripos($buffer,'timeStamp');
				if ($inicia){
					$mes= substr($buffer,$inicia+13,2);
					$dia= substr($buffer,$inicia+16,2);
					$anio= substr($buffer,$inicia+19,4);
					$hora= substr($buffer,$inicia+24,5);
					$fechaHora=$anio."-".$mes."-".$dia." ".$hora;
				}//if inicia
				else
				{
					if (stripos($buffer,'shortName'))
							$idEstacion=substr($buffer,stripos($buffer,'shortName')+13,3);
					// Se captura la temperatura
					else if (stripos($buffer,'temperature'))
					{
						
						if  ((substr($buffer,(stripos($buffer,'temperature')+15),2) <> '",') or trim(substr($buffer,(stripos($buffer,'temperature')+15),2) <> ''))
						{
							$temperatura=str_replace('",','',substr($buffer,(stripos($buffer,'temperature')+15),5));
							
							strlen($temperatura);
							if ((strlen($temperatura) <= 3))
							{
							 	  $temperatura=9999;
									echo $faltantes=$faltantes+1;
							}
						}
						else if (stripos($buffer,'temperature'))
						{
							//if  ((substr($buffer,(stripos($buffer,'temperature')+15),2) <> '",') or trim(substr($buffer,(stripos($buffer,'temperature')+15),2) <> ''))
								//	echo $temperatura=str_replace('",','',substr($buffer,(stripos($buffer,'temperature')+15),5));
						}
								
					}//else	
					
					else if (stripos($buffer,'humidity'))
					{
						if  ((substr($buffer,(stripos($buffer,'humidity')+12),2) <> '",') or trim(substr($buffer,(stripos($buffer,'humidity')+12),2) <> ''))
						{
							    $humedadRelativa=str_replace('",','',substr($buffer,(stripos($buffer,'humidity')+12),5));
									//echo strlen($humedadRelativa);
									if ((strlen($humedadRelativa) <= 2))
							{
							 	  $humedadRelativa=9999;
									$faltantes=$faltantes+1;
							}
						}
						else if (stripos($buffer,'humidity'))
						{
							if  ((substr($buffer,(stripos($buffer,'humidity')+12),2) <> '",') or trim(substr($buffer,(stripos($buffer,'humidity')+12),2) <> ''))
									echo $humedadRelativa=str_replace('",','',substr($buffer,(stripos($buffer,'humidity')+12),5));
						}		
					}//else	
					
					else if (stripos($buffer,'windDirection'))
					{
						if  ((substr($buffer,(stripos($buffer,'windDirection')+17),5) <> '",') or trim(substr($buffer,(stripos($buffer,'windDirection')+17),5) <> ''))
						{
							
							$direccionViento=str_replace('",','',substr($buffer,(stripos($buffer,'windDirection')+17),5));
							//echo strlen($direccionViento);
							if ((strlen($direccionViento) < 2))
							{
							 	  $direccionViento=9999;
									$faltantes=$faltantes+1;
							}
						}
						else if (stripos($buffer,'windDirection'))
						{
							if  ((substr($buffer,(stripos($buffer,'windDirection')+17),5) <> '",') or trim(substr($buffer,(stripos($buffer,'windDirection')+17),5) <> ''))
									$direccionViento=str_replace('",','',substr($buffer,(stripos($buffer,'windDirection')+17),5));
						}		
					}//else	
					
					else if (stripos($buffer,'windSpeed'))
					{
						if  ((substr($buffer,(stripos($buffer,'windSpeed')+13),4) <> '",') or trim(substr($buffer,(stripos($buffer,'windSpeed')+13),4) <> ''))
						{
							$velocidadViento=str_replace('",','',substr($buffer,(stripos($buffer,'windSpeed')+13),4));
							$velocidadViento=str_replace('"','',$velocidadViento);
							//echo strlen($velocidadViento);
							if ((strlen($velocidadViento) <= 1))
							{
							 	  $velocidadViento=9999;
									$faltantes=$faltantes+1;
							}
						}
						else if (stripos($buffer,'windSpeed'))
						{
							if  ((substr($buffer,(stripos($buffer,'windSpeed')+13),4) <> '",') or trim(substr($buffer,(stripos($buffer,'windSpeed')+13),4) <> ''))
									$velocidadViento=str_replace('",','',substr($buffer,(stripos($buffer,'windSpeed')+13),4));
						}		
					}//else	
        		}//fin de else inicia
				if (strstr($buffer,"}")){
					
					$inserta= str_replace(' ','',$temperatura.",".$humedadRelativa.",".$direccionViento.",".$velocidadViento.")");
					$inserta= str_replace(',"',',',$inserta);
					$inserta= str_replace('"','',$inserta);
					$inserta= str_replace(', )',',)',$inserta);
					$inserta= str_replace('','9999',$inserta);
					
				
					if($faltantes < 4)
					{
						  echo $inserta="INSERT IGNORE INTO registro_ema (fechaHora,idEstacion,temperatura,humedadRelativa,direccionViento,velocidadViento) VALUES('".$fechaHora."','".$idEstacion."',".$inserta;
							echo "<br>";
						 		$faltantes=0;
								if ($conn->query($inserta) === TRUE)
								{
               		 echo "New record created successfully";
									 
              	} 
								else 
								{
                	echo "Error: " . $inserta . "<br>" . $conn->error;
              	}//if-else	
						}	
						else
								$faltantes=0;
									
				}
				//if ($salida==1) break;
				 
				if (strstr($buffer,"]")) break;
				
			}//fin while
			fclose($txt_file);
		}//if del si exite el archivo
		else
			echo "El archivo no existe";

?>

</body>
</html>