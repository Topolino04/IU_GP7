<?php

//Formulario para listar los roles
$DefForm = array(
	0 => array(
	'type' => 'text',
	'name' => 'CLIENTE_NOMBRE',
	'value' => '',
	'size' => 25,
	'required' => true,
	'pattern' => '',
	'validation' => '',
	'readonly' => false
	),
	1 => array(
		'type' => 'text',
		'name' => 'CLIENTE_APELLIDOS',
		'value' => '',
		'size' => 50,
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	2 => array(
		'type' => 'text',
		'name' => 'CLIENTE_DNI',
		'value' => '',
		'size' => 9,
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	3 => array(
		'type' => 'date',
		'name' => 'CLIENTE_FECH_NAC',
		'value' => '2000-01-01',
		'min' => '1900-01-01',
		'max' => '2000-01-01',
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	4 => array(
		'type' => 'text',
		'name' => 'CLIENTE_DIRECCION',
		'value' => '',
		'size' => 80,
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	5 => array(
		'type' => 'email',
		'name' => 'CLIENTE_CORREO',
		'value' => '',
		'size' => 50,
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	6 => array(
		'type' => 'text',
		'name' => 'CLIENTE_TELEFONO1',
		'value' => '',
		'size' => 9,
		'required' => true,
		'pattern' => '{0-9}',
		'validation' => '',
		'readonly' => false
	),

	7 => array(
		'type' => 'text',
		'name' => 'CLIENTE_TELEFONO2',
		'value' => '',
		'size' => 9,
		'required' => true,
		'pattern' => '{0-9}',
		'validation' => '',
		'readonly' => false
	),
	8 => array(
		'type' => 'file',
		'name' => 'CLIENTE_DOM',
		'value' => '',

		'required' => false,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),



	9=> array(
		'type' => 'text',
		'name' => 'CLIENTE_COMENTARIOS',
		'value' => '',
		'size' => 155,
		'required' => false,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	10 => array(
		'type' => 'text',
		'name' => 'CLIENTE_TELEFONO3',
		'value' => '',
		'size' => 9,
		'required' => true,
		'pattern' => '{0-9}',
		'validation' => '',
		'readonly' => false
	),
	11 => array(
		'type' => 'text',
		'name' => 'CLIENTE_PROFESION',
		'value' => '',
		'size' => 25,
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	12 => array(
		'type' => 'file',
		'name' => 'CLIENTE_LOPD',

		'value' => '',
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	)
	,
	13 => array(
		'type' => 'select',
		'name' => 'CLIENTE_ESTADO',
		'multiple' => 'false',
		'value' => '',
		'options' => array('Activo','Inactivo'),
		'required' => 'true',
		'readonly' => false
	)


);



?>
