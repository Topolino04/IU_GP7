<?php
//Formulario para la gestión de roles
$form2 = array(
	0 => array(
		'type' => 'time',
		'name' => 'BLOQUE_HORAF',
		'value' => '00:00',
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	1=>array(
		'type' => 'text',
		'name' => 'BLOQUE_DIA',
		'value' => '',
		'size' => 50,
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	2 => array(
		'type' => 'date',
		'name' => 'BLOQUE_FECHA',
		'value' => '2016-12-1',
		'min' => '2016-12-1',
		'max' => '2020-01-01',
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	3 => array(
		'type' => 'time',
		'name' => 'BLOQUE_HORAI',
		'value' => '00:00',
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
		4 => array(
	'type' => 'text',
	'name' => 'BLOQUE_LUGAR',
	'value' => '',
	'size' => 50,
	'required' => true,
	'pattern' => '',
	'validation' => '',
	'readonly' => false
),
	5=>array(
		'type' => 'text',
		'name' => 'BLOQUE_ID',
		'value' => '',
		'size' => 50,
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	)

);




?>
