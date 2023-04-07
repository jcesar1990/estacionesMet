<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<?php
include '../lib/conexion.php';

$arrRegistro=array();
echo "<br>Abre archivo: ".$nomArchivo="../files/OH.csv";
      
        //Se abre el archivo de datos de las descargas y se asigna a la variable $datos
        $datos = @fopen($nomArchivo, "r");

        if ($datos) //Si el archivo existe se procesa
        {
            $buffer = fgets($datos, 200); //Lee la primera linea de encabezados y la ignora
						$cont=0;
						
						echo "<br>";
						while ($buffer=fgets($datos, 8500))
						{
             		//$buffer = fgets($datos, 8500); //Lee la linea y la almacena en el buffer, maximo $largo_ln caracteres por linea
            		$arrRegistro=explode(",",$buffer);  
								$idEstación="'".$arrRegistro[0]."'";
								$lluviaAcumulada=$arrRegistro[1];
								$dia=substr($arrRegistro[2],0,2);
								$mes=substr($arrRegistro[2],3,2);
            		$anio='20'.substr($arrRegistro[2],6,2);		
								$hora=trim(substr($arrRegistro[2],8,6));				
								$fechaHora=$anio."-".$mes."-".$dia." ".$hora;
								echo $qryInsert="INSERT IGNORE INTO extremo (idEstacion,idVariable,valor,fechaHora)  
                VALUES ($idEstación,'LL',$lluviaAcumulada,'$fechaHora')";
								
								echo "<br>";
								
								
								if ($conn->query($qryInsert) === TRUE) {
               		 echo "New record created successfully";
              	} 
								else {
                	echo "Error: " . $qryInsert . "<br>" . $conn->error;
              	}//if-else
							
						}//end while
						
						echo "hay ".$cont." registros.";
						
         		fclose ($datos); //se cierra el archivo
       	}//Fin de SI el archivo 
        else // si el archivo NO existe
        {
           	echo "<font color=\"red\"><b>ERROR. El archivo".$nomArchivo." de la estaciÃ³n no existe en el directorio especificado!.</b></font><br>";
        }// fin de else el archivo NO existe



?>
</body>
</html>