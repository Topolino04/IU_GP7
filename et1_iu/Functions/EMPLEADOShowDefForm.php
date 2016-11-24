<?php
//Formulario para mostrar la consulta de roles
$DefForm2 = array(
	0 => array(
		'type' => 'text',
		'name' => 'EMP_NOMBRE',
		'value' => '',
		'texto'=>'EMP_NOMBRE2',
		'size' => 25,
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	1 => array(
		'type' => 'text',
		'name' => 'EMP_APELLIDO',
		'texto'=>'EMP_APELLIDO2',

		'value' => '',
		'size' => 50,
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	2 => array(
		'type' => 'text',
		'name' => 'EMP_DNI',
		'texto'=>'EMP_DNI2',
		'value' => '',
		'size' => 9,
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	3=> array(
		'type' => 'text',
		'name' => 'EMP_USER',
		'texto'=>'EMP_USER2',
		'value' => '',
		'size' => 25,
		'required' => 'true',
		'pattern' => '{a-z}{A-Z}{0-9}',
		'validation' => 'onblur=\'funcion(xxxx)\'',
		'readonly' => false
	)
)


?>
