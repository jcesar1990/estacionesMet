<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<?php
$fechaActual='2023-03-26';
$varOrd='LL';
$ord='DESC';
include '../lib/conexion.php';
include '../modelo/queries.php';
$ruta="prueba.csv";
$ejecuta_sentencia = mysqli_query($conn, $qryGeneratablaLluvia);
$arrRegistro=array();
echo "<table><tr>";

if(!file_exists($ruta))
file_put_contents($ruta,"");

$archivo_csv = fopen($ruta, 'w');
while($row = mysqli_fetch_array($ejecuta_sentencia, MYSQLI_ASSOC)){                     
    $cadena=$row["latitud"].",";
    $cadena=$cadena.$row["longitud"].",";
    $cadena=$cadena.$row["Estacion"].",";
    echo $cadena=$cadena.$row["valor"];
    fputs($archivo_csv,$cadena).PHP_EOL;

}
echo "</tr></table>";