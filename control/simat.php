<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<?php
include '../lib/conexion.php';
 
//Se indica en pantalla la hora de ejecución de la transacción
$qVacios=0;
echo "<br>Abre archivo: ".$nomArchivo="../files/simat.txt";
      
        //Se abre el archivo de datos de las descargas y se asigna a la variable $datos
        $datos = @fopen($nomArchivo, "r");

        if ($datos) //Si el archivo existe se procesa
        {
            echo $buffer = fgets($datos, 8500); //Lee la linea y la almacena en el buffer, maximo $largo_ln caracteres por linea
            echo "<br><br>";
            echo $buffer = fgets($datos, 8500); //Lee la linea y la almacena en el buffer, maximo $largo_ln caracteres por linea
            //quita encabezado
            $buffer = str_replace('{ "pollutionMeasurements":{ "city": "Ciudad de México", "cityCode": "MEX", "country": "México", "mesurementAgency": "SIMAT", "URL": "http://www.aire.cdmx.gob.mx/", "timeStamp":','',$buffer)  ;
            //Elimina etiquetas innecesarias que anteceden a los datos
            $buffer = str_replace('{ "name":','',$buffer);
            $buffer = str_replace(' "shortName":','',$buffer);
            $buffer = str_replace(' "location": "','',$buffer);
            $buffer = str_replace('", "temperature": "',',',$buffer);
            $buffer = str_replace('", "humidity": "',',',$buffer);
            $buffer = str_replace('", "windDirection": "',',',$buffer);
            $buffer = str_replace('", "windSpeed": "',',',$buffer);
            //Elimina la etiqueta "stations" que está justo antes de iniciar los datos de interés
            $buffer = str_replace(', "stations": ','',$buffer);
            //Reemplaza la llave y coma por sólo coma
            $buffer = str_replace('" }, ',';',$buffer);
            //Elimina las llaves y parentesis del final del string
            $buffer = str_replace(' " } ] } }','',$buffer);
            //Elimina espacios del final y del inicio
            $buffer = trim($buffer);
            //Extrae del string la fecha y la hora
            echo "<br><br>".$fecha=substr($buffer,38,10);
            $mes=substr($buffer,38,2);
            $dia=substr($buffer,41,2);
            $anio=substr($buffer,44,4);
            echo "<br><br>".$fecha=$anio."-".$mes."-".$dia;
            echo "<br><br>".$hora=substr($buffer,49,5);
            echo "<br>";
            //Busca la llave que abre, que indica el inicio de los datos
            $buffer2='"'.substr($buffer,strpos($buffer,"[")+2,8500);
            //Separa los datos separados por punto y coma y los mete a un arreglo
            $arrEstaciones=explode(";",$buffer2);  
            for($i=0; $i <=36; $i++)
            {
              $arrRegistro=explode(",",$arrEstaciones[$i]);
              for($k=0;$k<=7;$k++)
              {
                $arrRegistro[$k]=str_replace('"','',$arrRegistro[$k]);
                if(trim($arrRegistro[$k])=="")
                {
                  $arrRegistro[$k]=-999;
                  $qVacios=$qVacios+1;
                }
                else
                  $arrRegistro[$k]=trim($arrRegistro[$k]);
              }//for interno
              echo "<br>";
              if ($qVacios < 4){
                
                echo $qryInsert="INSERT INTO registroEstacion (idEstacion,fechaUtc,horaUtc,temperatura,humedadRelativa,dirViento,velViento)  
                VALUES ('$arrRegistro[1]','$fecha','$hora',$arrRegistro[4],$arrRegistro[5],$arrRegistro[6],$arrRegistro[7])";
              
              if ($conn->query($qryInsert) === TRUE) {
                echo "New record created successfully";
              } else {
                echo "Error: " . $qryInsert . "<br>" . $conn->error;
              }
              

                
            }//if de cuenta los vacios
            $qVacios=0; 
            }//for externo
         fclose ($datos); //se cierra el archivo
        }//Fin de SI el archivo 
        else // si el archivo NO existe
        {
           	echo "<font color=\"red\"><b>ERROR. El archivo".$nomArchivo." de la estación no existe en el directorio especificado!.</b></font><br>";
        }// fin de else el archivo NO existe

?>

</body>
</html>