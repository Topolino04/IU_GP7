<?php

/*
jrodeiro
V0 : 11/10/2016
$listFields: Lista de campos que quiero que aparezcan en el formulario
$fieldsDef: array de definición de campos del formulario para una entidad
NO implementado: Por defecto, el action será el controlador de la entidad del formulario ENTIDAD_Controller.php
NO implementado: Por defecto, el method será POST
NO implementado: Pasar un array con los submits/reset
*/

	function createForm($listFields, $fieldsDef, $strings, $values, $required, $noedit)
	{

		foreach ($listFields as $field) { //miro todos los campos que me piden en su orden
			for ($i = 0; $i < count($fieldsDef); $i++) { //recorro todos los campos de la definición de formulario para encontrarlo
				//echo $field . ':' . $fieldsDef[$i]['required'] . '<br>';
				if ($field == $fieldsDef[$i]['name']) { //si es el que busco
					switch ($fieldsDef[$i]['type']) {
						case 'text':
							if(isset($fieldsDef[$i]['texto'])){
								$str = "\t" . $strings[$fieldsDef[$i]['texto']];
							}
							else{
							$str = "\t" . $strings[$fieldsDef[$i]['name']];}
							$str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
							$str .= " name = '" . $fieldsDef[$i]['name'] . "'";
							$str .= " size = '" . $fieldsDef[$i]['size'] . "'";
							if (isset($values[$fieldsDef[$i]['name']])) {
								$str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
							} else {
								$str .= " value = '" . $fieldsDef[$i]['value'] . "'";

							}
							if ($fieldsDef[$i]['pattern'] <> '') {
								$str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
							}
							if ($fieldsDef[$i]['validation'] <> '') {
								$str .= " " . $fieldsDef[$i]['validation'];
							}

							if (is_bool($required)) {
								if (!$required) {
									$str .= ' ';
								} else {
									$str .= ' required ';
								}
							} else {
								if (!isset($required[$field])) {

										$str .= 'required';


									}
									else{
										$str .= '';
								}
							}

							if (is_bool($noedit)) {
								if ($noedit) {
									$str .= ' readonly ';
								}
							} else {
								if (isset($noedit[$field])) {
									if ($noedit[$field]) {
										$str .= ' readonly ';
									}
								}
							}
							$str .= " ><br>\n";
							echo $str;
							break;
						case 'date':
							$str = "\t" . $strings[$fieldsDef[$i]['name']];
							$str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
							$str .= " name = '" . $fieldsDef[$i]['name'] . "'";
							$str .= " min = '" . $fieldsDef[$i]['min'] . "'";
							$str .= " max = '" . $fieldsDef[$i]['max'] . "'";
							if (isset($values[$fieldsDef[$i]['name']])) {
								$str .= " value = '" . ($values[$fieldsDef[$i]['name']]) . "'";
							} else {
								$str .= " value = '" . $fieldsDef[$i]['value'] . "'";

							}
							if ($fieldsDef[$i]['pattern'] <> '') {
								$str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
							}
							if ($fieldsDef[$i]['validation'] <> '') {
								$str .= " " . $fieldsDef[$i]['validation'];
							}

							if (is_bool($required)) {
								if (!$required) {
									$str .= ' ';
								} else {
									$str .= ' required ';
								}
							} else {
								if (isset($required[$field])) {
									if (!$required[$field]) {
										$str .= ' ';
									} else {
										$str -= ' required ';
									}
								}
							}

							if (is_bool($noedit)) {
								if ($noedit) {
									$str .= ' readonly ';
								}
							} else {
								if (isset($noedit[$field])) {
									if ($noedit[$field]) {
										$str .= ' readonly ';
									}
								}
							}
							$str .= " ><br>\n";
							echo $str;
							break;
						case 'email':
							$str = "\t" . $strings[$fieldsDef[$i]['name']];
							$str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
							$str .= " name = '" . $fieldsDef[$i]['name'] . "'";
							$str .= " size = '" . $fieldsDef[$i]['size'] . "'";
							if (isset($values[$fieldsDef[$i]['name']])) {
								$str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
							} else {
								$str .= " value = '" . $fieldsDef[$i]['value'] . "'";

							}
							if ($fieldsDef[$i]['pattern'] <> '') {
								$str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
							}
							if ($fieldsDef[$i]['validation'] <> '') {
								$str .= " " . $fieldsDef[$i]['validation'];
							}

							if (is_bool($required)) {
								if (!$required) {
									$str .= ' ';
								} else {
									$str .= ' required ';
								}
							} else {
								if (isset($required[$field])) {
									if (!$required[$field]) {
										$str .= ' ';
									} else {
										$str -= ' required ';
									}
								}
							}

							if (is_bool($noedit)) {
								if ($noedit) {
									$str .= ' readonly ';
								}
							} else {
								if (isset($noedit[$field])) {
									if ($noedit[$field]) {
										$str .= ' readonly ';
									}
								}
							}
							$str .= " ><br>\n";
							echo $str;
							break;
						case 'search':
							break;
						case 'url':
							$str = "\t" . $strings[$fieldsDef[$i]['name']];
							$str .= " : <a target='_blank' href='".$values[$fieldsDef[$i]['name']]."'>Ver</a>" ;
							$str .= " <br>\n";
							echo $str;
							break;
						case 'tel':
							break;
						case 'password':
							$str = "\t" . $strings[$fieldsDef[$i]['name']];
							$str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
							$str .= " name = '" . $fieldsDef[$i]['name'] . "'";
							$str .= " size = '" . $fieldsDef[$i]['size'] . "'";
							if (isset($values[$fieldsDef[$i]['name']])) {
								$str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
							} else {
								$str .= " value = '" . $fieldsDef[$i]['value'] . "'";

							}
							if ($fieldsDef[$i]['pattern'] <> '') {
								$str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
							}
							if ($fieldsDef[$i]['validation'] <> '') {
								$str .= " " . $fieldsDef[$i]['validation'];
							}

							if (is_bool($required)) {
								if (!$required) {
									$str .= ' ';
								} else {
									$str .= ' required ';
								}
							} else {
								if (isset($required[$field])) {
									if (!$required[$field]) {
										$str .= ' ';
									} else {
										$str -= ' required ';
									}
								}
							}

							if (is_bool($noedit)) {
								if ($noedit) {
									$str .= ' readonly ';
								}
							} else {
								if (isset($noedit[$field])) {
									if ($noedit[$field]) {
										$str .= ' readonly ';
									}
								}
							}
							$str .= " ><br>\n";
							echo $str;
							break;
						case 'number':
							$str = "\t" . $strings[$fieldsDef[$i]['name']];
							$str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
							$str .= " name = '" . $fieldsDef[$i]['name'] . "'";
							$str .= " min = '" . $fieldsDef[$i]['min'] . "'";
							$str .= " max = '" . $fieldsDef[$i]['max'] . "'";
							if (isset($values[$fieldsDef[$i]['name']])) {
								$str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
							} else {
								$str .= " value = '" . $fieldsDef[$i]['value'] . "'";

							}
							if ($fieldsDef[$i]['pattern'] <> '') {
								$str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
							}
							if ($fieldsDef[$i]['validation'] <> '') {
								$str .= " " . $fieldsDef[$i]['validation'];
							}

							if (is_bool($required)) {
								if (!$required) {
									$str .= ' ';
								} else {
									$str .= ' required ';
								}
							} else {
								if (isset($required[$field])) {
									if (!$required[$field]) {
										$str .= ' ';
									} else {
										$str -= ' required ';
									}
								}
							}

							if (is_bool($noedit)) {
								if ($noedit) {
									$str .= ' readonly ';
								}
							} else {
								if (isset($noedit[$field])) {
									if ($noedit[$field]) {
										$str .= ' readonly ';
									}
								}
							}
							$str .= " ><br>\n";
							echo $str;
							break;
						case 'chekbox':
							break;
						case 'radio':
							break;
						case 'file':
							$str = "\t" . $strings[$fieldsDef[$i]['name']];
							$str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
							$str .= " name = '" . $fieldsDef[$i]['name'] . "'";

							if (isset($values[$fieldsDef[$i]['name']])) {
								$str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
							} else {
								$str .= " value = '" . $fieldsDef[$i]['value'] . "'";

							}
							if ($fieldsDef[$i]['pattern'] <> '') {
								$str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
							}
							if ($fieldsDef[$i]['validation'] <> '') {
								$str .= " " . $fieldsDef[$i]['validation'];
							}

							if (is_bool($required)) {
								if (!$required) {
									$str .= ' ';
								} else {
									$str .= ' required ';
								}
							} else {
								if (isset($required[$field])) {
									if (!$required[$field]) {
										$str .= ' ';
									} else {
										$str -= ' required ';
									}
								}
							}

							if (is_bool($noedit)) {
								if ($noedit) {
									$str .= ' readonly ';
								}
							} else {
								if (isset($noedit[$field])) {
									if ($noedit[$field]) {
										$str .= ' readonly ';
									}
								}
							}
							$str .= " ><br>\n";
							echo $str;
							break;;
						case 'select':
							$str = "\t" . $strings[$fieldsDef[$i]['name']] . ": <select name='" . $fieldsDef[$i]['name'] . "'";
							if ($noedit || $noedit[$field]) {
								$str .= ' readonly ';
							}
							if ($fieldsDef[$i]['multiple'] == 'true') {
								$str = $str . " multiple ";
							}
							$str = $str . " >";
							foreach ($fieldsDef[$i]['options'] as $value) {
								$str1 = "<option value = '" . $value . "'";
								if (isset($values[$fieldsDef[$i]['name']])) {
									if ($values[$fieldsDef[$i]['name']] == $value) {
										$str1 .= " selected ";
									}
								}
								$str1 .= ">" . $value . "</option>";
								$str = $str . $str1;
							}
							$str = $str . "</select><br>\n";
							echo $str;
							break;
						case 'textarea':
							break;
						default:

					} //search, url, tel, email, password, date pickers, number, checkbox, radio y file
				}
			}
		}


}


	/*
    function IsAuthenticated()
    jrodeito
    15/10/2016
    Esta función valida si existe la variable de session login
    Si no existe redirige a la pagina de login
    Si existe comprueba si el usuario tiene permisos para ejecutar la accion de ese controlador
    */
	function IsAuthenticated()
	{

		session_start(); //solicito trabajar con la session
		if (!isset($_SESSION['login'])) {
			//header('Location:EMPLEADOS_Controller.php?accion=Login');
			return false;
		} else {
			/*if (!HavePermissions($controller, $_REQUEST['accion']))
                new Mensaje('No tiene permisos para ejecutar esta acción','index.php');
            */
			//header('Location:EMPLEADOS_Controller.php');
			return true;
		}

	} //end of function IsAuthenticated()

function eliminarDir($carpeta)
{
	foreach(glob($carpeta . "/*") as $archivos_carpeta)
	{


		if (is_dir($archivos_carpeta))
		{
			eliminarDir($archivos_carpeta);
		}
		else
		{
			unlink($archivos_carpeta);
		}
	}

	rmdir($carpeta);
}



?>
