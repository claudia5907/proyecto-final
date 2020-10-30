<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('nameDate'))
{
	function nameDate($fecha='') 
    { 	$fecha= empty($fecha)?date('Y-m-d'):$fecha;
    	$dias = array('DOMINGO','LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO');
    	$dd   = explode('-',$fecha);
    	$ts   = mktime(0,0,0,$dd[1],$dd[2],$dd[0]);
    	return $dias[date('w',$ts)];
    }
}
if(!function_exists('redondeo'))
{
    function redondeo($numero,$decimales)
	{
		$factor=pow(10,$decimales);
		return (round($numero*$factor)/$factor);
	}
}
if(!function_exists('difereciaDias'))
{
    function diferenciaDias($inicio, $fin)
    {
      $inicio = strtotime($inicio);
      $fin = strtotime($fin);
      $dif = $fin - $inicio;
      $diasFalt = (( ( $dif / 60 ) / 60 ) / 24);
     return ceil($diasFalt);
    }
}
if(!function_exists('suma_fechas'))
{
       function suma_fechas($fecha,$dias){
          $new_fecha=explode('-',$fecha);
          
          $mes = $new_fecha[1];
          $anio = $new_fecha[0];
          $dia = $new_fecha[2];
          $ultimo_dia = date( "d", mktime(0, 0, 0, $mes + 1, 0, $anio) ) ;
          $dias_adelanto = $dias;
          $siguiente = $dia + $dias_adelanto;
          if ($ultimo_dia < $siguiente)
          {
             $dia_final = $siguiente - $ultimo_dia;
             $mes++;
             if ($mes == '13')
             {
                $anio++;
                $mes = '01';
             }
             $fecha_final = $anio.'-'.$mes.'-'.$dia_final;         
          }
          else
          {
             $fecha_final = $anio.'-'.$mes.'-'.$siguiente;           
          }
          return $fecha_final;
       }
}
if(!function_exists('sumas_dias'))
{
    function sumas_dias($fecha,$ndias)
    {
    if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))
    list($dia,$mes,$año)=explode("/", $fecha);
    if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
    list($dia,$mes,$año)=explode("-",$fecha);
    $nueva = mktime(0,0,0, $mes,$dia,$año) + $ndias * 24 * 60 * 60;
    $nuevafecha=date("d/m/Y",$nueva);
    return ($nuevafecha);
    }
}
if(!function_exists('fecha_textual'))
{
    function fecha_textual($fecha)
    {
       $meses=array();
       $meses[1]="Enero";
       $meses[2]="Febrero";
       $meses[3]="Marzo";
       $meses[4]="Abril";
       $meses[5]="Mayo";
       $meses[6]="Junio";
       $meses[7]="Julio";
       $meses[8]="Agosto";
       $meses[9]="Septiembre";
       $meses[10]="Octubre";
       $meses[11]="Noviembre";
       $meses[12]="Diciembre";
         
       $array_fecha=explode("-",$fecha);
       $anio=$array_fecha[0];
       $mes=(int) $array_fecha[1];
       $dia=$array_fecha[2];
       
       $newFecha=$dia." de ".$meses[$mes]." ".$anio;
       
     return $newFecha;
    }
}
if(!function_exists('getMonthDays'))
{
    function getMonthDays($Month, $Year)
    {
      return date("d",mktime(0,0,0,$Month+1,0,$Year));
    }
}
 
if(!function_exists('getSumaMes'))
{
    function getSumaMes($fecha,$suma)
    {
       //$fecha = date('Y-m-j');
		$nuevafecha = strtotime ( '+'.$suma.' day' , strtotime ( $fecha ) ) ;
		$nuevafecha = date ( 'Y-m-j' , $nuevafecha );

		return $nuevafecha; 
    }
}
if(!function_exists('getIntervaloFecha'))
{
    function getIntervaloFecha($fecha1,$fecha2)
    {
       $datetime1 = date_create($fecha1);
	   $datetime2 = date_create($fecha2);
	   $intervalo = date_diff($datetime1, $datetime2);
	  return $intervalo->format('%a');
    }
}
if(!function_exists('getDiasAtrasoRegistro'))
{
    function getDiasAtrasoRegistro($fecha1,$fecha2,$nro_dias_a_saber)
	{
		$numro_dia_ini=date('N',strtotime($fecha1))+1;
		$numro_dia_fin=date('N',strtotime($fecha2));
		$numero_dias=getIntervaloFecha($fecha1,$fecha2);
		$resp=0;
		for($i=1;$i<=$numero_dias;$i++){
		  if($numro_dia_ini==$nro_dias_a_saber){
			 $resp++;
		  }
		  
		  if($numro_dia_ini==7){
			 $numro_dia_ini=1;
		  }else{
			 $numro_dia_ini++;
		  }
		}
	  return $resp;	
	}
}
if(!function_exists('numtoletras'))
{
    function numtoletras($xcifra)
	{
		$xarray = array(0 => "Cero",
			1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
			"DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
			"VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
			100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
		);
	//
		$xcifra = trim($xcifra);
		$xlength = strlen($xcifra);
		$xpos_punto = strpos($xcifra, ".");
		$xaux_int = $xcifra;
		$xdecimales = "00";
		if (!($xpos_punto === false)) {
			if ($xpos_punto == 0) {
				$xcifra = "0" . $xcifra;
				$xpos_punto = strpos($xcifra, ".");
			}
			$xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
			$xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
		}

		$XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
		$xcadena = "";
		for ($xz = 0; $xz < 3; $xz++) {
			$xaux = substr($XAUX, $xz * 6, 6);
			$xi = 0;
			$xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
			$xexit = true; // bandera para controlar el ciclo del While
			while ($xexit) {
				if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
					break; // termina el ciclo
				}

				$x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
				$xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
				for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
					switch ($xy) {
						case 1: // checa las centenas
							if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
								
							} else {
								$key = (int) substr($xaux, 0, 3);
								if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
									$xseek = $xarray[$key];
									$xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
									if (substr($xaux, 0, 3) == 100)
										$xcadena = " " . $xcadena . " CIEN " . $xsub;
									else
										$xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
									$xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
								}
								else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
									$key = (int) substr($xaux, 0, 1) * 100;
									$xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
									$xcadena = " " . $xcadena . " " . $xseek;
								} // ENDIF ($xseek)
							} // ENDIF (substr($xaux, 0, 3) < 100)
							break;
						case 2: // checa las decenas (con la misma lógica que las centenas)
							if (substr($xaux, 1, 2) < 10) {
								
							} else {
								$key = (int) substr($xaux, 1, 2);
								if (TRUE === array_key_exists($key, $xarray)) {
									$xseek = $xarray[$key];
									$xsub = subfijo($xaux);
									if (substr($xaux, 1, 2) == 20)
										$xcadena = " " . $xcadena . " VEINTE " . $xsub;
									else
										$xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
									$xy = 3;
								}
								else {
									$key = (int) substr($xaux, 1, 1) * 10;
									$xseek = $xarray[$key];
									if (20 == substr($xaux, 1, 1) * 10)
										$xcadena = " " . $xcadena . " " . $xseek;
									else
										$xcadena = " " . $xcadena . " " . $xseek . " Y ";
								} // ENDIF ($xseek)
							} // ENDIF (substr($xaux, 1, 2) < 10)
							break;
						case 3: // checa las unidades
							if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
								
							} else {
								$key = (int) substr($xaux, 2, 1);
								$xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
								$xsub = subfijo($xaux);
								$xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
							} // ENDIF (substr($xaux, 2, 1) < 1)
							break;
					} // END SWITCH
				} // END FOR
				$xi = $xi + 3;
			} // ENDDO

			if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
				$xcadena.= " DE";

			if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
				$xcadena.= " DE";

			// ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
			if (trim($xaux) != "") {
				switch ($xz) {
					case 0:
						if (trim(substr($XAUX, $xz * 6, 6)) == "1")
							$xcadena.= "UN BILLON ";
						else
							$xcadena.= " BILLONES ";
						break;
					case 1:
						if (trim(substr($XAUX, $xz * 6, 6)) == "1")
							$xcadena.= "UN MILLON ";
						else
							$xcadena.= " MILLONES ";
						break;
					case 2:
						if ($xcifra < 1) {
							$xcadena = "CERO BOLIVIANOS $xdecimales/100 ";
						}
						if ($xcifra >= 1 && $xcifra < 2) {
							$xcadena = "UN BOLIVIANO $xdecimales/100  ";
						}
						if ($xcifra >= 2) {
							$xcadena.= " BOLIVIANOS $xdecimales/100  "; //
						}
						break;
				} // endswitch ($xz)
			} // ENDIF (trim($xaux) != "")
			// ------------------      en este caso, para México se usa esta leyenda     ----------------
			$xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
			$xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
			$xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
			$xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
			$xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
			$xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
			$xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
		} // ENDFOR ($xz)
		return trim($xcadena);
	}
}
if(!function_exists('test_input'))
{
    function test_input($data)
	{
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  //$data = mysql_real_escape_string($data);
		  return $data;
	}
}
if(!function_exists('generarCodigo'))
{
    function generarCodigo($longitud)
	{
		 $key = '';
		 $pattern = '1234567890ABCDEFGHYJKLMNOPQRSTUWXYZ';
		 $max = strlen($pattern)-1;
		 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
		 return $key;
	}
}
if(!function_exists('miniatura'))
{
    function miniatura($archivo, $local, $ancho, $alto)
	{    
		$arrNombre = explode(".", $local);
		$nombre = $arrNombre[0];
		$extension = $arrNombre[1];
		if($extension=="jpg" || $extension=="jpeg") $nuevo = imagecreatefromjpeg($archivo);
		if($extension=="png") $nuevo = imagecreatefrompng($archivo);
		if($extension=="gif") $nuevo = imagecreatefromgif($archivo);
		$thumb = imagecreatetruecolor($ancho, $alto); // Lo haremos de un tamaño 100x100
		$ancho_original = imagesx($nuevo);
		$alto_original = imagesy($nuevo);
		imagecopyresampled($thumb,$nuevo,0,0,0,0,$ancho,$alto,$ancho_original,$alto_original);
		$thumb_name = "$nombre.$extension";
		if($extension=="jpg" || $extension=="jpeg") imagejpeg($thumb, $thumb_name,90); // 90 es la calidad de compresión
		if($extension=="png") imagepng($thumb, $thumb_name);
		if($extension=="gif") imagegif($thumb, $thumb_name);
	}
}
if(!function_exists('paginate'))
{
    function paginate($reload, $page, $tpages, $adjacents) 
	{
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$out = '<ul class="pagination pagination-large">'; 
		// previous label 
		if($page==1) {
			$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
		} else if($page==2) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load(".($page-1).")'>$prevlabel</a></span></li>";
		}
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load(1)'>1</a></li>";
		}
		// interval
		if($page>($adjacents+2)) {
			$out.= "<li><a>...</a></li>";
		}
		// pages
		$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
		$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
		for($i=$pmin; $i<=$pmax; $i++) {
			if($i==$page) {
				$out.= "<li class='active'><a>$i</a></li>";
			}else if($i==1) {
				$out.= "<li><a href='javascript:void(0);' onclick='load(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load(".$i.")'>$i</a></li>";
			}
		} 
		// interval 
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		} 
		// last 
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load($tpages)'>$tpages</a></li>";
		} 
		// next 
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		} 
		$out.= "</ul>";
		return $out;
	}
}
if(!function_exists('getNumeroSemana'))
{
	function getNumeroSemana($fecha)
    {
		$ddate = $fecha;
		$duedt = explode("-", $ddate);
		$date  = mktime(0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);
		$week  = (int)date('W', $date);
		return $week;		
	}
}
if(!function_exists('getFechaActual'))
{
    function getFechaActual()
    {		
		date_default_timezone_set("America/La_Paz");		
	    $format_fecha = "%Y-%m-%d";	  
	    $time = time();		
	    $fecha_actual = mdate($format_fecha, $time);
		return $fecha_actual;
    }
}
if(!function_exists('getAnioActual'))
{
    function getAnioActual()
    {		
		date_default_timezone_set("America/La_Paz");		
	    $format_anio = "%Y";	  
	    $time = time();		
	    $anio_actual = mdate($format_anio, $time);
		return $anio_actual;
    }
}
if(!function_exists('NumeroSemanasTieneUnAno'))
{
    function NumeroSemanasTieneUnAno($year) { 
		$date = new DateTime; # Establecemos la fecha segun el estandar ISO 8601 (numero de semana) 
		$date->setISODate($year, 53); # Si estamos en la semana 53 devolvemos 53, sino, es que estamos en la 52 
		if($date->format("W")=="53") 
			return 53;
		else 
			return 52; 
	}
}
if(!function_exists('getFechasSemana'))
{
    function getFechasSemana($week, $year)
    {		
		$date_string = $year . 'W' . sprintf('%02d', $week);
	
		$array_fechas[0] = date('Y-m-d', strtotime($date_string));		 	//Lunes
		$array_fechas[1] = date('Y-m-d', strtotime($date_string . '2')); 	//Martes
		$array_fechas[2] = date('Y-m-d', strtotime($date_string . '3')); 	//Miercoles
		$array_fechas[3] = date('Y-m-d', strtotime($date_string . '4')); 	//Jueves
		$array_fechas[4] = date('Y-m-d', strtotime($date_string . '5')); 	//Viernes
		$array_fechas[5] = date('Y-m-d', strtotime($date_string . '6')); 	//Sabado
		$array_fechas[6] = date('Y-m-d', strtotime($date_string . '7'));	//Domingo
	
		return $array_fechas;			
	}
}

function subfijo($xx)
{ // esta función regresa un subfijo para la cifra
	$xx = trim($xx);
	$xstrlen = strlen($xx);
	if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
		$xsub = "";
	//
	if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
		$xsub = "MIL";
	//
	return $xsub;
}
if(!function_exists('getMes'))
{
    function getMes($nro_mes)
    {
       $meses=array();
       $meses[1]="Enero";
       $meses[2]="Febrero";
       $meses[3]="Marzo";
       $meses[4]="Abril";
       $meses[5]="Mayo";
       $meses[6]="Junio";
       $meses[7]="Julio";
       $meses[8]="Agosto";
       $meses[9]="Septiembre";
       $meses[10]="Octubre";
       $meses[11]="Noviembre";
       $meses[12]="Diciembre";
	   
	   $mes=(int)$nro_mes;
       return ($meses[$mes]);
    }
}
if(!function_exists('semanaAnio'))
{
	function semanaAnio($year) { 
	   $date = new DateTime; # Establecemos la fecha segun el estandar ISO 8601 (numero de semana) 
	   $date->setISODate($year, 53); # Si estamos en la semana 53 devolvemos 53, sino, es que estamos en la 52 
	   if($date->format("W")=="53"){ 
		   return 53;}
	   else{ 
		  return 52;} 
	 }
}		
if(!function_exists('formatoFechaFriendDDMMYY'))
{
	function formatoFechaFriendDDMMYY($_fecha)
	{
		if(!empty($_fecha)){
			$partes_fecha = explode("-",$_fecha);
			$fecha = $partes_fecha[2]."/".$partes_fecha[1]."/".$partes_fecha[0];
			return $fecha;
		} else{
			return "";
		}		
	}
}
if(!function_exists('resta_fecha_dia'))
{
	function resta_fecha_dia($fecha) { 
	    //$fecha = date('Y-m-j');
		$nuevafecha = strtotime ('-1 day' , strtotime ($fecha)) ;
		$nuevafecha = date ('Y-m-d' ,$nuevafecha);
        return $nuevafecha;
		 
	 }
}
if(!function_exists('getFechaHoraActual'))
{
    function getFechaHoraActual()
    {		
		date_default_timezone_set("America/La_Paz");		
	    $format_fecha_hora = "%Y-%m-%d %H:%i:%s";	  
	    $time = time();		
	    $fecha_hora_actual = mdate($format_fecha_hora, $time);
		return $fecha_hora_actual;
    }
}
if(!function_exists('interval_date'))
{
	function interval_date($init){
        //print_r($init);
        //formateamos las fechas a segundos tipo 1374998435
        $diferencia = strtotime(date('Y-m-d')) - strtotime($init);
        //comprobamos el tiempo que ha pasado en segundos entre las dos fechas
        //floor devuelve el número entero anterior, si es 5.7 devuelve 5
        //$tiempo = "Hace " . floor($diferencia/86400) . " dias";
        $tiempo = floor($diferencia/86400);
        return $tiempo;
    }
}
if(!function_exists('diasAjuste'))
{
	function diasAjuste()
	{
	    $dias=20;
        //$dias=11;
        return $dias;
	}
}
if(!function_exists('diasAjusteMatadero'))
{
	function diasAjusteMatadero()
	{
	    $dias=4;
	    return $dias;
	}
}
if(!function_exists('diasAjusteLaPaz'))
{
	function diasAjusteLaPaz()
	{
	    $dias=3;
        return $dias;
	}
}