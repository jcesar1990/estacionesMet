<?php

//and substring(e.idDemarcacion,1,2)='09' Esto va antes del LEFT JOIN para solo sacar las de la CDMX y no del EDOMEX

$qrySacaExtremos1="
SELECT m.nombreDemarcacion as Demarcacion, substring(e.idDemarcacion,1,2) as entidad, CONCAT(e.nombreEstacion,' (', p.abreviaturaDependencia,')') as Estacion, d.idEstacion nif, max(d.temperatura) as maxt, fechaHora
FROM registro_ema d INNER JOIN
c_estacion  e  ON e.idEstacion= d.idEstacion INNER JOIN
c_demarcacion m ON m.idDemarcacion=e.idDemarcacion INNER JOIN
c_dependencia p ON e.idDependencia=p.idDependencia
LEFT JOIN (SELECT t.idEstacion nif,max(`temperatura`) num_dir
		   FROM `registro_ema` t
       WHERE date(`fechaHora`)='$fechaActual'
       and temperatura < 50
       GROUP BY t.idEstacion, date(fechaHora)
      ) du ON du.nif=d.idEstacion
WHERE d.temperatura=du.num_dir
and date(fechaHora)='$fechaActual'
and hour(fechaHora) > 9
and substring(e.idDemarcacion,1,2)='09'
and d.temperatura <> 9999
GROUP BY m.nombreDemarcacion,substring(e.idDemarcacion,1,2),e.nombreEstacion
ORDER BY d.temperatura DESC
";

$qrySacaExtremos2="
SELECT m.nombreDemarcacion as Demarcacion, substring(e.idDemarcacion,1,2) as entidad, CONCAT(e.nombreEstacion,' (', p.abreviaturaDependencia,')') as Estacion, d.idEstacion nif, min(d.temperatura) as mint, fechaHora
FROM registro_ema d INNER JOIN
c_estacion  e  ON e.idEstacion= d.idEstacion INNER JOIN
c_demarcacion m ON m.idDemarcacion=e.idDemarcacion INNER JOIN
c_dependencia p ON e.idDependencia=p.idDependencia

LEFT JOIN (SELECT t.idEstacion nif,min(`temperatura`) num_dir
		   FROM `registro_ema` t
 		   WHERE date(`fechaHora`)='$fechaActual'
           GROUP BY t.idEstacion, date(fechaHora)
          ) du ON du.nif=d.idEstacion
WHERE d.temperatura=du.num_dir
and date(fechaHora)='$fechaActual'
and substring(e.idDemarcacion,1,2)='09'
and d.temperatura <> 9999
GROUP BY m.nombreDemarcacion,substring(e.idDemarcacion,1,2),e.nombreEstacion
ORDER BY d.temperatura;
";

$qrySacaExtremos3="
SELECT m.nombreDemarcacion as Demarcacion, substring(e.idDemarcacion,1,2) as entidad, CONCAT(e.nombreEstacion,' (', p.abreviaturaDependencia,')') as Estacion, d.idEstacion nif, sum(d.lluvia) as mint, fechaHora
FROM registro_ema d INNER JOIN
c_estacion  e  ON e.idEstacion= d.idEstacion INNER JOIN
c_demarcacion m ON m.idDemarcacion=e.idDemarcacion INNER JOIN
c_dependencia p ON e.idDependencia=p.idDependencia
LEFT JOIN (SELECT t.idEstacion nif,sum(`lluvia`) num_dir
		   FROM `registro_ema` t
 		   WHERE date(`fechaHora`)='$fechaActual'
           GROUP BY t.idEstacion, date(fechaHora)
          ) du ON du.nif=d.idEstacion
WHERE d.lluvia=du.num_dir
and date(fechaHora)='$fechaActual'
and substring(e.idDemarcacion,1,2)='09'
and d.lluvia <> 9999
GROUP BY m.nombreDemarcacion,substring(e.idDemarcacion,1,2),e.nombreEstacion
ORDER BY d.lluvia DESC;
";


$qrySacaAcumLluvia="	
SELECT m.nombreDemarcacion as Demarcacion, substring(e.idDemarcacion,1,2) as entidad, CONCAT(e.nombreEstacion,' (', p.abreviaturaDependencia,')') as Estacion, d.idEstacion nif, sum(`valor`) as mint 
FROM `extremo` d INNER JOIN
c_estacion  e  ON e.idEstacion= d.idEstacion INNER JOIN
c_demarcacion m ON m.idDemarcacion=e.idDemarcacion INNER JOIN
c_dependencia p ON e.idDependencia=p.idDependencia
WHERE date(fechaHora)='$fechaActual'
GROUP BY d.idEstacion
HAVING sum(`valor`) > 0
ORDER BY sum(`valor`) DESC;
";	

$qrySacaActuales="
 SELECT m.nombreDemarcacion as Demarcacion, substring(e.idDemarcacion,1,2) as entidad, 
 CONCAT(e.nombreEstacion,' (', p.abreviaturaDependencia,')') as Estacion, d.idEstacion nif, 
 d.temperatura, d.humedadRelativa, d.velocidadViento, d.direccionViento,d.velocidadRacha,d.lluvia,d.radiacionSolar, d.fechaHora
 FROM registro_ema d INNER JOIN
 c_estacion  e  ON e.idEstacion= d.idEstacion INNER JOIN
 c_demarcacion m ON m.idDemarcacion=e.idDemarcacion INNER JOIN
 c_dependencia p ON e.idDependencia=p.idDependencia
 LEFT JOIN (SELECT t.idEstacion nif,max(fechaHora) num_dir
        FROM `registro_ema` t
        WHERE date(fechaHora)='$fechaActual'
        GROUP BY t.idEstacion
       ) du ON du.nif=d.idEstacion
 WHERE d.fechaHora=du.num_dir
 and date(fechaHora)='$fechaActual'
 and $varOrd < 9000
 GROUP BY m.nombreDemarcacion,substring(e.idDemarcacion,1,2),e.nombreEstacion
 ORDER BY $ord 
 ";


             
 $qrySacaExtremosVto="
 SELECT m.nombreDemarcacion,d.idEstacion,
 CONCAT(e.nombreEstacion,' (', p.abreviaturaDependencia,')') as estacion,
 date(d.fechaHora) as fecha, max(`velocidadViento`) as maxVto, max(velocidadRacha) as maxRacha, count(*) as frecuencia 
 FROM `registro_ema` d INNER JOIN
 c_estacion  e  ON e.idEstacion= d.idEstacion INNER JOIN
 c_demarcacion m ON m.idDemarcacion=e.idDemarcacion INNER JOIN
 c_dependencia p ON e.idDependencia=p.idDependencia
 WHERE date(fechaHora)='$fechaActual'
 and substring(e.idDemarcacion,1,2)='09'
 and direccionViento <>9999
 and velocidadViento <> 9999
 group by d.idEstacion,date(d.fechaHora)
 order by  max(`velocidadRacha`) DESC,max(velocidadViento) DESC
 ";
 


 $qryGeneratablaLluvia="
 SELECT e.latitud, e.longitud, m.nombreDemarcacion as Demarcacion, substring(e.idDemarcacion,1,2) as entidad, CONCAT(e.nombreEstacion,' (', p.abreviaturaDependencia,')') as Estacion, d.idEstacion nif, sum(`valor`) as valor 
FROM `extremo` d INNER JOIN
c_estacion  e  ON e.idEstacion= d.idEstacion INNER JOIN
c_demarcacion m ON m.idDemarcacion=e.idDemarcacion INNER JOIN
c_dependencia p ON e.idDependencia=p.idDependencia
WHERE date(fechaHora)='$fechaActual'
GROUP BY d.idEstacion
HAVING sum(`valor`) > 0
ORDER BY sum(`valor`) DESC
";
?>
