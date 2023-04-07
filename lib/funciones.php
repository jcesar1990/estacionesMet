<?php
function obtenColorTemps($vTemp)
{
    $colorCelda="";    
	if ($vTemp <-2)
    	$colorCelda='celdaPurpura'; 
		else if(($vTemp >= -2) and ($vTemp <0.9))
				$colorCelda='celdaRojo';
		else if(($vTemp >= 0.9) and ($vTemp <4))
				$colorCelda='celdaNaranja';
		else if(($vTemp >= 4) and ($vTemp <=6.4))
				$colorCelda='celdaAmarillo';		
		else if(($vTemp >6.4 ) and ($vTemp <11))
				$colorCelda='celdaGris';		
		else if(($vTemp >= 11) and ($vTemp <18))
				$colorCelda='celdaAzulClaro';		
		else if(($vTemp >= 18) and ($vTemp <21))
				$colorCelda='celdaAzulFuerte';		
		else if(($vTemp >= 21) and ($vTemp <24.6))
				$colorCelda='celdaVerdeClaro';		
		else if(($vTemp >= 24.6) and ($vTemp <28))
				$colorCelda='celdaAmarilloClaro';		
		else if(($vTemp >= 28) and ($vTemp <31))
				$colorCelda='celdaAmarillo';		
		else if(($vTemp >= 31) and ($vTemp <34))
				$colorCelda='celdaNaranja';		
		else if(($vTemp >= 34) and ($vTemp <36))
				$colorCelda='celdaRojo';		
		else if(($vTemp >= 36) and ($vTemp < 90))
				$colorCelda='celdaPurpura';		
			
				
		else $colorCelda='celdaBlanco';
					
		 return $colorCelda; 
}//fin de la funci�n

//Ligeras menores a 15 y fuertes mayores a 15
function obtenColorLluvia($vLluv)
{
    if ($vLluv <0.1)
    	 $colorCelda='celdaBlanco'; 	
		else if(($vLluv >= 0.1) and ($vLluv <2))
				$colorCelda='celdaGris';		
		else if(($vLluv >= 2) and ($vLluv <5))
				$colorCelda='celdaAzulClaro';		
		else if(($vLluv >= 5) and ($vLluv <10))
				$colorCelda='celdaVerdeClaro';		
		else if(($vLluv >= 10) and ($vLluv <15))
				$colorCelda='celdaVerdeFuerte';		
		else if(($vLluv >= 15) and ($vLluv <30))
				$colorCelda='celdaAmarillo';		
		else if(($vLluv >= 30) and ($vLluv <50))
				$colorCelda='celdaNaranja';		
		else if(($vLluv >= 50) and ($vLluv <=70))
				$colorCelda='celdaRojo';		
		else if(($vLluv > 70) and ($vLluv < 900))
				$colorCelda='celdaPurpura';		
		else $colorCelda='celdaBlanco';
					
		 return $colorCelda; 
}//fin de la funci�n


function obtenColorViento($vVto)
{
    if (($vVto <=5) or ($vVto == 9999))//Calma
    	 $colorCelda='celdaBlanco';
		else if(($vVto > 5) and ($vVto <25))//débiles
				$colorCelda='celdaGris'; 	
		else if(($vVto >= 25) and ($vVto <30))//moderados o brisa moderada
				$colorCelda='celdaAzulClaro';
		else if(($vVto >= 30) and ($vVto <40))//moderados o brisa fuerte
				$colorCelda='celdaVerdeClaro';
		else if(($vVto >= 40) and ($vVto <49.5))//moderados o brisa fuerte
				$colorCelda='celdaAmarilloClaro';	
		else if(($vVto >= 49.5) and ($vVto <59.5))//fuertes
				$colorCelda='celdaAmarillo';		
		else if(($vVto >= 59.5) and ($vVto <69.5))//muy fuertes
				$colorCelda='celdaNaranja';		
		else if(($vVto >= 69.5) and ($vVto <=79.5))//extremadamente fuertes
				$colorCelda='celdaRojo';		
		else if($vVto > 79.5)//vientos violentos
				$colorCelda='celdaPurpura';		
		else $colorCelda='celdaBlanco';
					
		 return $colorCelda; 
}//fin de la funci�n



function obtenRumbo($grados)
{
$rumbo='';
 
}//end function

?>
