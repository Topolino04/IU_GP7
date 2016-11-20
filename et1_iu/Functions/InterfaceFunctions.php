<?php

function descartar_empleados ($empleados)
{
	for ($j=0;$j<count($empleados);$j++){
		foreach ($empleados[$j] as $clave => $valor) {
			if ($clave === 'EMP_TIPO') {
				if ($valor!=3){
					unset($empleados[$j]);
				}
			}
		}
	}
	return $empleados;
}
//FUNCION PARA CONSEGUIR SOLO LOS MONITORES
function getMonitores(){
    $toret=array();
    $mysqli= new mysqli("localhost", "iu2016", "iu2016", "IU2016");
    $sql="SELECT EMP_NOMBRE, EMP_APELLIDO FROM EMPLEADOS WHERE EMP_TIPO=3 ORDER BY EMP_NOMBRE";

    $resultado=$mysqli->query($sql);
    while($tupla=$resultado->fetch_array()){
        array_push($toret,$tupla['EMP_NOMBRE']." ".$tupla['EMP_APELLIDO']);
    }

    return $toret;
}
									


//FUNCION PARA IMPRIMIR LA GESTION DE EMPLEADOS
function gestion_emp($datos)
{
	include '../Locates/Strings_Castellano.php';
	for ($j=0;$j<count($datos);$j++){
		foreach ($datos[$j] as $clave => $valor) {
			if ($clave === 'FUNCIONALIDAD_NOM' ){                              
				$nom = 'gestion de empleados';
				if (strcasecmp($valor,$nom)==0){
					echo '<li><a href="EMPLEADO_Controller.php">'.$strings['Gestion de Empleados'].'</a></li>';
					unset($datos[$j]);
					$datos = array_values($datos);
				}
			}
        }
	}
	return $datos;
}

//FUNCION PARA IMPRIMIR LA GESTION DE FUNCIONALIDADES
function gestion_fun($datos)
{
	include '../Locates/Strings_Castellano.php';
	for ($j=0;$j<count($datos);$j++){
		foreach ($datos[$j] as $clave => $valor) {
			if ($clave === 'FUNCIONALIDAD_NOM' ) {
                $nom = 'gestion de funcionalidades';
				if (strcasecmp($valor,$nom)==0){
					echo '<li><a href="FUNCIONALIDAD_Controller.php">'.$strings['Gestion de Funcionalidades'].'</a></li>';
					unset($datos[$j]);
					$datos = array_values($datos);
				}
			}
        }
	}	
	return $datos;
}

//FUNCION PARA IMPRIMIR LA GESTION DE PAGINAS
function gestion_pag($datos)
{
	include '../Locates/Strings_Castellano.php';
	for ($j=0;$j<count($datos);$j++){
		foreach ($datos[$j] as $clave => $valor) {
			if ($clave === 'FUNCIONALIDAD_NOM' ) {
                $nom = 'gestion de paginas';
				if (strcasecmp($valor,$nom)==0){
					echo '<li><a href="PAGINA_Controller.php">'.$strings['Gestion de Paginas'].'</a></li>';
					unset($datos[$j]);
					$datos = array_values($datos);
				}
			}
		}
	}
	return $datos;
}	

//FUNCION PARA IMPRIMIR LA GESTION DE ROLES
function gestion_rol($datos)
{
	include '../Locates/Strings_Castellano.php';
	for ($j=0;$j<count($datos);$j++){
		foreach ($datos[$j] as $clave => $valor) {
			if ($clave === 'FUNCIONALIDAD_NOM' ) {
                $nom = 'gestion de roles';
				if (strcasecmp($valor,$nom)==0){
					echo '<li><a href="PAGINA_Controller.php">'.$strings['Gestion de Roles'].'</a></li>';
					unset($datos[$j]);
					$datos = array_values($datos);
				}
			}
        }
	}	
	return $datos;
}

//PARA IMPRIMIR LAS GESTIONES SECUNDARIAS
function gestiones_secun($datos)
{
	include '../Locates/Strings_Castellano.php';
	$aySearches = array('á','é','í','ó','ú');
	$ayReplaces = array('a','e','i','o','u');
	for ($j=0;$j<count($datos);$j++){
		foreach ($datos[$j] as $clave => $valor) {
			if ($clave === 'FUNCIONALIDAD_NOM' ) {
				$valor = strtolower($valor);
				$cadenas = explode(" ", $valor);
				 
				$primera_palabra = array_shift($cadenas);
				$primera_letra = substr($primera_palabra,0,1);
				$primera_letra = strtoupper($primera_letra);				
				$primera_palabra = iconv_substr($primera_palabra,1);
				$primera_palabra = $primera_letra.$primera_palabra;
				array_unshift($cadenas,$primera_palabra);
				
				$ultima_palabra = array_pop($cadenas);
				$ultima_letra = substr($ultima_palabra,0,1);
				$ultima_letra = strtoupper($ultima_letra);		
				$ultima_palabra = iconv_substr($ultima_palabra,1);
				$ultima_palabra = $ultima_letra.$ultima_palabra;
				array_push($cadenas,$ultima_palabra);
				
				$nom = array_pop($cadenas);
				$controlador = strtoupper($nom);
				array_push($cadenas,$nom);
				
				$valor = implode(" ",$cadenas);
				//$controlador = strtoupper($valor);
				echo '<li><a href="'.$controlador.'_Controller.php">'.$valor.'</a></li>';
			}
		}
    }
}

function acentos($value){
    $aySearches = array('á','é','í','ó','ú');
    $ayReplaces = array('a','e','i','o','u');
    return str_replace($aySearches,$ayReplaces,$value);
}
?>