<html>
<head>
<title>Datos Estaciones</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv='refresh' content='600'>
<meta charset="utf-8" />
<meta content="MSHTML 6.00.2900.2180" name="GENERATOR">
<link rel=stylesheet href="../css/alertas.css" type="text/css">
</head>
<body>
<img src="../img/Logo_CDMX.png" alt="Girl in a jacket" width="500" height="120">
<img src="../img/Logo_Dependencia.png" alt="Girl in a jacket" width="600" height="120">
<?php


//include '../lib/fechas.php';
date_default_timezone_set('America/Monterrey');
$act=$_GET['a'];
$ord=$_GET['o'];
$dir=$_GET['s'];

if ($dir=="DESC")
    $dir="ASC";
else
    $dir="DESC";
switch ($ord)
{
	case "t":
		$varOrd="temperatura";
        $ord="temperatura ".$dir.", d.fechaHora DESC";
		break;
    case "f":
        $varOrd="temperatura";
        $ord="d.fechaHora DESC";
        break;
    case "v":
        $varOrd="d.velocidadViento";
        $ord="d.velocidadViento DESC, d.fechaHora DESC ";
        break;
                
	default:
		$ord= "m.nombreDemarcacion";
}

if(isset($_GET['f'])) {
	$hayFecha=1;
	$fechaActual=substr($_GET['f'],0,4)."-".substr($_GET['f'],4,2)."-".substr($_GET['f'],6,2);
	$horaActual='';
}//if
else{
		$hayFecha=0;
		$fechaActual = date('Y-m-d');
		$horaActual=date('G:i');
}//else
//Fecha de prueba:
//$fechaActual= '2022-10-20';
include '../modelo/queries.php';
echo "<hr>";


// ************************** MUESTRAS TEMPERATURAS M�XIMAS  ********************************************
$res1 = mysqli_query($conn, $qrySacaExtremos1);
include '../vista/muestraTablaMaximas.php';

 echo "<hr>";
?>
</body> 
</html>