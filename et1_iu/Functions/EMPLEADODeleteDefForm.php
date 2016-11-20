<?php
//Formulario para el borrado de empleados
$DefForm3 = array(
	0 => array(
	'type' => 'text',
	'name' => 'EMP_NOMBRE',
	'value' => '',
	'size' => 25,
	'required' => true,
	'pattern' => '',
	'validation' => '',
	'readonly' => false
	),
	1 => array(
		'type' => 'text',
		'name' => 'EMP_APELLIDO',
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
		'value' => '',
		'size' => 9,
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	3 => array(
		'type' => 'date',
		'name' => 'EMP_FECH_NAC',
		'value' => '',
		'min' => '2015/01/01',
		'max' => '2017/01/01',
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	4 => array(
		'type' => 'text',
		'name' => 'EMP_DIRECCION',
		'value' => '',
		'size' => 80,
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	5 => array(
		'type' => 'email',
		'name' => 'EMP_EMAIL',
		'value' => '',
		'size' => 50,
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	6 => array(
		'type' => 'text',
		'name' => 'EMP_TELEFONO',
		'value' => '',
		'size' => 15,
		'required' => true,
		'pattern' => '{0-9}',
		'validation' => '',
		'readonly' => false
	),
	7 => array(
		'type' => 'text',
		'name' => 'EMP_CUENTA',
		'value' => '',
		'size' => 24,
		'required' => false,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	8 => array(
		'type' => 'url',
		'name' => 'EMP_NOMINA',
		'value' => '',

		'required' => false,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),



	9=> array(
		'type' => 'text',
		'name' => 'EMP_COMENTARIOS',
		'value' => '',
		'size' => 155,
		'required' => false,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	10 => array(
		'type' => 'text',
		'name' => 'EMP_USER',
		'value' => '',
		'size' => 25,
		'required' => 'true',
		'pattern' => '{a-z}{A-Z}{0-9}',
		'validation' => 'onblur=\'funcion(xxxx)\'',
		'readonly' => false
	),
	11=> array(
		'type' => 'password',
		'name' => 'EMP_PASSWORD',
		'value' => '',
		'size' => 40,
		'required' => 'true',
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	), 12 => array(
		'type' => 'url',
		'name' => 'EMP_FOTO',
		'value' => '',

		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	)
	,
	13 => array(
		'type' => 'select',
		'name' => 'EMP_ESTADO',
		'multiple' => 'false',
		'value' => '',
		'options' => array('Activo','Inactivo'),
		'required' => 'true',
		'readonly' => false
	)

);


?>
