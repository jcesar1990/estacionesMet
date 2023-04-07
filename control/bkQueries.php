<?php
$qrySacaExtremos1="
SELECT m.nombreDemarcacion as Demarcacion, substring(e.idDemarcacion,1,2) as entidad, e.nombreEstacion as Estacion, d.idEstacion nif, max(d.temperatura) as maxt, fechaHora
FROM registro_ema d INNER JOIN
c_estacion  e  ON e.idEstacion= d.idEstacion INNER JOIN
c_demarcacion m ON m.idDemarcacion=e.idDemarcacion
LEFT JOIN (SELECT t.idEstacion nif,max(`temperatura`) num_dir
		   FROM `registro_ema` t
       WHERE date(`fechaHora`)='$fechaActual'
       GROUP BY t.idEstacion, date(fechaHora)
      ) du ON du.nif=d.idEstacion
WHERE d.temperatura=du.num_dir
and date(fechaHora)='$fechaActual'
and substring(e.idDemarcacion,1,2)='09'
and d.temperatura <> 9999
GROUP BY m.nombreDemarcacion,substring(e.idDemarcacion,1,2),e.nombreEstacion
ORDER BY d.temperatura DESC
";

$qrySacaExtremos2="
SELECT m.nombreDemarcacion as Demarcacion, substring(e.idDemarcacion,1,2) as entidad, e.nombreEstacion as Estacion, d.idEstacion nif, min(d.temperatura) as mint, fechaHora
FROM registro_ema d INNER JOIN
c_estacion  e  ON e.idEstacion= d.idEstacion INNER JOIN
c_demarcacion m ON m.idDemarcacion=e.idDemarcacion
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
SELECT m.nombreDemarcacion as Demarcacion, substring(e.idDemarcacion,1,2) as entidad, e.nombreEstacion as Estacion, d.idEstacion nif, sum(d.lluvia) as mint, fechaHora
FROM registro_ema d INNER JOIN
c_estacion  e  ON e.idEstacion= d.idEstacion INNER JOIN
c_demarcacion m ON m.idDemarcacion=e.idDemarcacion
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


	
			



?>
