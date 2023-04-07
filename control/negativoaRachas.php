<?php
include '../lib/conexion.php';

$qryNegativoRachhas=
"UPDATE `registro_ema` SET velocidadRacha=-9999 WHERE velocidadRacha=9999";

$ejecuta_sentencia = mysqli_query($conn, $qryNegativoRachhas);
?>