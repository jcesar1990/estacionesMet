<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<?php
include '../lib/conexion.php';

$arrEstacionesActivas=array();

$qryConsultaEstaciones="
SELECT idEstacion FROM `c_estacion` WHERE `idDependencia`=6 and estatus='A'
";

$ejecuta_sentencia = mysqli_query($conn, $qryConsultaEstaciones);

while($row = mysqli_fetch_array($ejecuta_sentencia, MYSQLI_ASSOC)){
      //$estacion[$i]=$row["idEstacion"];
    
$arrRegistro=array();
echo "<br>Abre archivo: ".$nomArchivo="../files/".$row["idEstacion"].".txt";
      
        //Se abre el archivo de datos de las descargas y se asigna a la variable $datos
        $datos = @fopen($nomArchivo, "r");

        if ($datos) //Si el archivo existe se procesa
        {
           echo  $buffer = fgets($datos, 8500); //Lee la primera linea de encabezados y la ignora
						$cont=0;
						
						echo "<br>";
						
						
						while ($buffer=fgets($datos, 8500))
						{
             		echo $buffer = fgets($datos, 8500); //Lee la linea y la almacena en el buffer, maximo $largo_ln caracteres por linea
            		echo "<br>";
							
								echo $arrRegistro=explode("\t",$buffer); 
								/* 
								$temperatura=$arrRegistro[0];
								$humedadRelativa=$arrRegistro[1];
								$puntoRocio=$arrRegistro[2];
								$velocidadViento=$arrRegistro[3];
								$direccionViento=$arrRegistro[4];
								$velocidadRacha=$arrRegistro[5];
								$direccionRacha=$arrRegistro[6];
								$presionBarometrica=$arrRegistro[7];
								$lluvia=$arrRegistro[8];
								$dia=substr($arrRegistro[9],0,2);
								$mes=substr($arrRegistro[9],3,2);
            		$anio=substr($arrRegistro[9],6,4);		
								$hora=trim(substr($arrRegistro[9],10,6));				
								echo $fechaHora="'".$anio."-".$mes."-".$dia." ".$hora."'";
								
								$idEstacion="'".trim($arrRegistro[10])."'";
								
								
								echo $qryInsert="INSERT IGNORE INTO registro_ema (temperatura,humedadRelativa,puntoRocio,velocidadViento,direccionViento,velocidadRacha,direccionRacha,presionBarometrica,lluvia,fechaHora,idEstacion)  
                VALUES ($temperatura,$humedadRelativa,$puntoRocio,$velocidadViento,$direccionViento,$velocidadRacha,$direccionRacha,$presionBarometrica,$lluvia,$fechaHora,$idEstacion)";
								
								echo "<br>";
										
								if ($conn->query($qryInsert) === TRUE) {
               		 echo "New record created successfully";
              	} 
								else {
                	echo "Error: " . $qryInsert . "<br>" . $conn->error;
              	}//if-else conexion
						*/
						$cont++;
						}//end while
						
						echo "hay ".$cont." registros.";
						
         		fclose ($datos); //se cierra el archivo
						
       	}//Fin de SI el archivo 
        else // si el archivo NO existe
        {
           	echo "<font color=\"red\"><b>ERROR. El archivo".$nomArchivo." de la estación no existe en el directorio especificado!.</b></font><br>";
        }// fin de else el archivo NO existe

}//fin del while principal

/*
Ejemplo para listar elementos
 //Fetching all the rows as arrays
   while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
      print("ID: ".$row["ID"]."\n");
      print("First_Name: ".$row["First_Name"]."\n");
      print("Last_Name: ".$row["Last_Name"]."\n");
      print("Place_Of_Birth: ".$row["Place_Of_Birth"]."\n");
      print("Country: ".$row["Country"]."\n");
   }

*/

?>
</body>
</html>