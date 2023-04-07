<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<?php
include '../lib/conexion.php';

$arrEstacionesActivas=array();

$qryConsultaEstaciones="
SELECT idEstacion FROM `c_estacion` WHERE `idDependencia`=7 and estatus='A' ORDER BY idEstacion DESC
";

$ejecuta_sentencia = mysqli_query($conn, $qryConsultaEstaciones);
$i=0;

while($row = mysqli_fetch_array($ejecuta_sentencia, MYSQLI_ASSOC)){
       echo $estacion[$i]=$row["idEstacion"];
    
$arrRegistro=array();
echo "<br>Abre archivo: ".$nomArchivo="../files/".$row["idEstacion"].".csv";
      
        //Se abre el archivo de datos de las descargas y se asigna a la variable $datos
        $datos = @fopen($nomArchivo, "r");

        if ($datos) //Si el archivo existe se procesa
        {
            $buffer = fgets($datos, 8500); //Lee la primera linea de encabezados y la ignora
						$cont=0;
						
						echo "<br>";
						while ($buffer=fgets($datos, 8500))
						{
             		//$buffer = fgets($datos, 8500); //Lee la linea y la almacena en el buffer, maximo $largo_ln caracteres por linea
            		$arrRegistro=explode(",",$buffer);  
								$direccionViento=$arrRegistro[1];
								$direccionRacha=$arrRegistro[2];
								$velocidadViento=$arrRegistro[3];
								$velocidadRacha=$arrRegistro[4];
								$temperatura=$arrRegistro[5];
								$humedadRelativa=$arrRegistro[6];
								$presionBarometrica=$arrRegistro[7];
								$lluvia=$arrRegistro[8];
								$radiacionSolar=$arrRegistro[9];
								//$fechaHora=$arrRegistro[9];
								
								
								$dia=substr($arrRegistro[0],0,2);
								$mes=substr($arrRegistro[0],3,2);
            		$anio='20'.substr($arrRegistro[0],6,2);		
								$hora=trim(substr($arrRegistro[0],8,6));	
								$fechaHora=$anio.'-'.$mes.'-'.$dia.' '.$hora;		
								//$fechaHora=trim(substr($arrRegistro[0],0,16));
								$idEstacion="'".trim($arrRegistro[10])."'";
								
								
								echo $qryInsert="INSERT IGNORE INTO registro_ema (temperatura,humedadRelativa,velocidadViento,direccionViento,velocidadRacha,direccionRacha,presionBarometrica,lluvia,fechaHora,idEstacion)  
                VALUES ($temperatura,$humedadRelativa,$velocidadViento,$direccionViento,$velocidadRacha,$direccionRacha,$presionBarometrica,$lluvia,'$fechaHora',$idEstacion)";
								
								echo "<br>";
								
								if ($conn->query($qryInsert) === TRUE) {
               		 echo "New record created successfully";
              	} 
								else {
                	echo "Error: " . $qryInsert . "<br>" . $conn->error;
              	}//if-else
													
						$i++;
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