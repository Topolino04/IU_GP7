
<?php

//Formulario para listar los roles
$form = array(
	0 => array(
	'type' => 'text',
	'name' => 'REGISTRO_CONSULTA_LESION_ID',
	'value' => '',
	'size' => 10,
	'required' => true,
	'pattern' => '',
	'validation' => '',
	'readonly' => false
	),
	1 => array(
		'type' => 'date',
		'name' => 'REGISTRO_CONSULTA_LESION_FECHAHORA1',
		'value' => '',
		'min' => '1900-01-01',
		'max' => '2018-01-01',
		'required' => false,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	2 => array(
		'type' => 'date',
		'name' => 'REGISTRO_CONSULTA_LESION_FECHAHORA2',
		'value' => '',
		'min' => '1900-01-01',
		'max' => '2018-01-01',
		'required' => false,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	)
);