<?php

//Formulario para las facturas
$DefForm = array(
	0 => array(
	'type' => 'number',
	'name' => 'FACTURA_ID',
	'value' => '',
	'min' => 1,
	'max' => 9999999999,
	'required' => true,
	'pattern' => '{0-9}{10}',
	'validation' => '',
	'readonly' => false
	),
	1 => array(
	'type' => 'number',
	'name' => 'CLIENTE_ID',
	'value' => '',
	'min' => 1,
	'max' => 9999999999,
	'required' => true,
	'pattern' => '{0-9}{10}',
	'validation' => '',
	'readonly' => false
	),
	2 => array(
	'type' => 'date',
	'name' => 'FACTURA_FECHA',
	'value' => '',
	'min' => '',
	'max' => '',
	'required' => true,
	'pattern' => '',
	'validation' => '',
	'readonly' => true
	),
	3 => array(
	'type' => 'text',
	'name' => 'CLIENTE_NIF',
	'value' => '',
	'size' => 9,
	'required' => true,
	'pattern' => '(([1-9]{8})([A-Z]{1}))|(([A-Z]{1})([1-9]{8}))',
	'validation' => 'maxlength="9"',
	'readonly' => false
	),
	4 => array(
	'type' => 'text',
	'name' => 'CLIENTE_NOMBRE',
	'value' => '',
	'size' => 30,
	'required' => true,
	'pattern' => '',
	'validation' => 'maxlength="30"',
	'readonly' => false
	),
	5 => array(
	'type' => 'text',
	'name' => 'CLIENTE_APELLIDOS',
	'value' => '',
	'size' => 50,
	'required' => false,
	'pattern' => '',
	'validation' => 'maxlength="50"',
	'readonly' => false
	)	
);


?>
