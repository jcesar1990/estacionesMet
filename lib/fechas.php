<?php
$fechaImg=date('Ymd');
$fecha=date('Y-m-d');
$fechaTitulo=date('d')." de ".MesNomToNum(date('m'))." de ".date('Y');
$anioActual=date('Y');
$fAyer = strtotime ( '-1 day' , strtotime ( $fecha ) ) ;
$fechaTitAyer=date('d',$fAyer)." de ".MesNomToNum(date('m'),$fAyer)." de ".date('Y',$fAyer);
$fAyer = date ( 'Y-m-d' , $fAyer );
$fAyer2 = strtotime ( '-1 day' , strtotime ( $fecha ) ) ;
$fAyer2 = date ( 'Ymd' , $fAyer2 );
$mesAnt= strtotime ( '-34 day' , strtotime ( $fecha ) ) ;
$mesAnterior= date ( 'Ym' , $mesAnt );
//$mesAnterior='201805';//mes de prueba o cuando aun no se publica el del mes actual
$nombreMesAnterior=nomMes(date ('F' , $mesAnt ));
function nomMes($mesIngles){
  switch($mesIngles)
	{
  			case "January";
  			$nombre="enero";
  			break;
				case "February";
  			$nombre="febrero";
  			break;
				case "March";
  			$nombre="marzo";
  			break;
				case "April";
  			$nombre="abril";
  			break;
				case "May";
  			$nombre="mayo";
  			break;
				case "June";
  			$nombre="junio";
  			break;
				case "July";
  			$nombre="julio";
  			break;
				case "August";
  			$nombre="agosto";
  			break;
				case "September";
  			$nombre="septiembre";
  			break;
				case "October";
  			$nombre="octubre";
  			break;
			  case "November";
  			$nombre="noviembre";
  			break;
				case "December";
  			$nombre="diciembre";
  			break;
  }//switch
  return $nombre;
}//function


function MesNomToNum($mesPub){
    switch($mesPub){
			case 1:
					 $mesNombre="enero";
					 break;
			case 2:
					 $mesNombre="febrero";
					 break;
			case 3:
					 $mesNombre="marzo";
					 break;
			case 4:
					 $mesNombre="abril";
					 break;
			case 5:
					 $mesNombre="mayo";
					 break;
			case 6:
					 $mesNombre="junio";
					 break;
			case 7:
					 $mesNombre="julio";
					 break;
			case 8:
					 $mesNombre="agosto";
					 break;
			case 9:
					 $mesNombre="septiembre";
					 break;
			case 10:
					 $mesNombre="octubre";
					 break;
			case 11:
					 $mesNombre="noviembre";
					 break;
			case 12:
					 $mesNombre="diciembre";
					 break;
			}//switch
			return $mesNombre;
}//function

function numMesToAbrev($mesPub){
    switch($mesPub){
			case 1:
					 $mesNombre="ene";
					 break;
			case 2:
					 $mesNombre="feb";
					 break;
			case 3:
					 $mesNombre="mar";
					 break;
			case 4:
					 $mesNombre="abr";
					 break;
			case 5:
					 $mesNombre="may";
					 break;
			case 6:
					 $mesNombre="jun";
					 break;
			case 7:
					 $mesNombre="jul";
					 break;
			case 8:
					 $mesNombre="ago";
					 break;
			case 9:
					 $mesNombre="sep";
					 break;
			case 10:
					 $mesNombre="oct";
					 break;
			case 11:
					 $mesNombre="nov";
					 break;
			case 12:
					 $mesNombre="dic";
					 break;
			}//switch
			return $mesNombre;
}//function

function numSemToNombre($num){
		switch($num){
			case 0:
					 $numSemana="Domingo";
					 break;
			case 1:
					 $numSemana="Lunes";
					 break;
			case 2:
					 $numSemana="Martes";
					 break;
			case 3:
					 $numSemana="Mi�rcoles";
					 break;
			case 4:
					 $numSemana="Jueves";
					 break;
			case 5:
					 $numSemana="Viernes";
					 break;
			case 6:
					 $numSemana="S�bado";
					 break;
			}//switch
			return $numSemana;
}//function



function fecha_en_flg($num_mes,$num_dia_mes,$num_dia_sem,$num_anio){ 
				$str; 
                $month_name = array("", "enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"); 
                $strM=$month_name[floor($num_mes)]; 
								
                $day_name = array("","Lunes", "Martes", "Mi&eacute;rcoles", "Jueves", "Viernes", "S&aacute;bado", "Domingo"); 
                $strD=$day_name[floor($num_dia_sem)]; 
                
								$str=$strD. ", ".date('d')." de ".$strM." de ".$num_anio; 
        
        return $str; 
				//echo $str;
}//function




function diasDelMes($numAnio,$numMes)
{
    switch ($numMes)
    {
        case 1:
    				 $dias=31;
    				 break;
    		case 2:
    				 if($numAnio%4 == 0)
        	      $dias=29;
             else
                $dias=28;
    				 break;
    		case 3:
    				 $dias=31;
    				 break;
    		case 4:
    				 $dias=30;
    				 break;
    		case 5:
    				 $dias=31;
    				 break;
    		case 6:
    				 $dias=30;
    				 break;
    		case 7:
    				 $dias=31;
    				 break;
    		case 8:
    				 $dias=31;
    				 break;
    		case 9:
    				 $dias=30;
    				 break;
    		case 10:
    				 $dias=31;
    				 break;
    		case 11:
    				 $dias=30;
    				 break;
    		case 12:
    				 $dias=31;
    				 break;
    }//switch
		return $dias;
}//function
?>
