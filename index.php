<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Red de Estaciones</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel=stylesheet href="css/alertas.css" type="text/css">
</head>
<body>
<header>
    <img src="img/Logo_CDMX.png" alt="Girl in a jacket" width="300" height="72">
    <img src="img/Logo_Dependencia.png" alt="Girl in a jacket" width="360" height="72">
    <h4>Base de Datos Meteorológica Integral de Alerta Temprana</h4>
    <nav>
      <ul class="header-nav">
        <li class="header-nav__item"><a href="http://192.168.20.17:8080/estacionesMet/index.php?a=1&o=t&s=ASC&v=a">Actual</a></li>
        <li class="header-nav__item"><a href="http://192.168.20.17:8080/estacionesMet/index.php?a=1&o=t&s=ASC&v=l">Lluvia</a></li>
        <li class="header-nav__item"><a href="http://192.168.20.17:8080/estacionesMet/index.php?a=1&o=t&s=ASC&v=x">T. Máximas</a></li>
        <li class="header-nav__item"><a href="http://192.168.20.17:8080/estacionesMet/index.php?a=1&o=t&s=ASC&v=n">T. Mínimas</a></li>
        <li class="header-nav__item"><a href="http://192.168.20.17:8080/estacionesMet/index.php?a=1&o=t&s=ASC&v=v">Vientos</a></li>
        <li class="header-nav__item"><a href="http://192.168.20.17:8080/estacionesMet/index.php?a=0&o=t&s=ASC&v=t">Históricos</a></li>
      </ul>
    </nav>
  </header>
  <main>

<?php
$segundos = 600; header ("Refresh:".$segundos);
if(isset($_GET['f'])) {
  $hayFecha=1;
  $fechaActual=substr($_GET['f'],0,4)."-".substr($_GET['f'],4,2)."-".substr($_GET['f'],6,2);
  $act=0;
  $ord="t";
  $dir="ASC";
  $v="t";
}//if
else{
    if (isset($_GET['a'])) {
	$hayFecha=0;
	$fechaActual = date('Y-m-d');
	$horaActual=date('G:i');
    $act=$_GET['a'];
    $ord=$_GET['o'];
    $dir=$_GET['s'];
    $v=$_GET['v'];
    }
    else{
        $hayFecha=0;
        $fechaActual = date('Y-m-d');
        $horaActual=date('G:i');
        $act=1;
        $ord='t';
        $dir='ASC';
        $v='a'; 
    }
}

//Fecha de prueba:
//$fechaActual= '2022-10-20';

date_default_timezone_set('America/Monterrey');
 

?>

  
<?php
 include 'lib/conexion.php';
 include 'lib/funciones.php';
 $fAyer = strtotime ( '-1 day' , strtotime ( $fechaActual ) ) ;
 $fAyer = date ( 'Y-m-d' , $fAyer );
 if (!($hayFecha) and  $act==0){
  ?>
  <div>
  <form action="http://192.168.20.17:8080/estacionesMet/index.php?a=0&o=t&s=ASC&v=t&f=20230306">
  <table align='center' width=60%>
    <tr valign='middle'><td align='right'>
  <label for="dateEmision">Seleccione la fecha de consulta:</label>
  </td><td  valign='middle'>
  <?php echo '<input type="date" id="f" name="f" min="2023-01-01" max='.$fAyer.' value="'.$fAyer.'";' ?>
  <datalist id="listaEmision">
      <option value="2022-12-05 13:00"></option>
  </datalist>
  </td>
  <td align='left'>
  <input type="submit" name="submit" id="submit" value="submit">
  </td></tr>
  </table>
</form> 
</div>
<?php
}
 
 
 
 if ($dir=="DESC")
     $dir="ASC";
 else
     $dir="DESC";

    if(isset($_GET['f'])) {
        $hayFecha=1;
        //$fechaActual=substr($_GET['f'],0,4)."-".substr($_GET['f'],4,2)."-".substr($_GET['f'],6,2);
        $fechaActual=$_GET['f'];
        $horaActual='';
    }//if
    else{
            $hayFecha=0;
            $fechaActual = date('Y-m-d');
            $horaActual=date('G:i');
    }//else
    //Fecha de prueba:
    //$fechaActual= '2022-10-20';
    
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

 include 'modelo/queries.php';

 switch ($v)
 {
     case "x":
        $res1 = mysqli_query($conn, $qrySacaExtremos1);
        include 'vista/muestraTablaMaximas.php';
        break;
     case "n":
        $res2 = mysqli_query($conn, $qrySacaExtremos2);
        include 'vista/muestraTablaMinimas.php';
        break;
     case "l":
        $res3 = mysqli_query($conn, $qrySacaAcumLluvia);
        include 'vista/muestraTablaLluvias.php';
        break;
     case "a":
        $res0=mysqli_query($conn, $qrySacaActuales);
        include 'vista/muestraActuales.php';
        break;    
     case "v":  
        $res4=mysqli_query($conn, $qrySacaExtremosVto);
        include 'vista/muestraTablaViento.php';
        break;
     default:
        
 }



 
 if ($hayFecha and  $act==0){
     $res1 = mysqli_query($conn, $qrySacaExtremos1);
      include 'vista/muestraTablaMaximas.php';
      $res2 = mysqli_query($conn, $qrySacaExtremos2);
      include 'vista/muestraTablaMinimas.php';
      $res3 = mysqli_query($conn, $qrySacaAcumLluvia);
      include 'vista/muestraTablaLluvias.php';
      $res4=mysqli_query($conn, $qrySacaExtremosVto);
      include 'vista/muestraTablaViento.php';
 }

 ?>
 </body> 
 </html>

  </main>