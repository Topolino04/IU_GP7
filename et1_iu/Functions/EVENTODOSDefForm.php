<?php
//Formulario para la gestión de eventos
$DefForm = array(
	0 => array(
	'type' => 'number',
	'name' => 'IDENTIFICADOR',
	'value' => '',
	'min' => 1,
	'max' => 9999999999,
	'size' => 10,
	'required' => true,
	'pattern' => '{0-9}{1,10}',
	'validation' => '',
	'readonly' => false
	),
	1 => array(
	'type' => 'text',
	'name' => 'EVENTO_NOMBRE',
	'value' => '',
	'size' => 20,
	'required' => true,
	'pattern' => '{a-z}{A-Z}{0-9}{1,20}',
	'validation' => 'maxlength="50"',
	'readonly' => false
),
	2 => array(
	'type' => 'number',
	'name' => 'CLIENTE_DNI',
	'value' => '',
	'min' => 1,
	'max' => 9999999999,
	'size' => 10,
	'required' => true,
	'pattern' => '{0-9}{1,20}',
	'validation' => '',
	'readonly' => false
),
	3 => array(
	'type' => 'number',
	'name' => 'PAGO_IMPORTE',
	'value' => '',
	'min' => 1,
	'max' => 9999999999,
	'size' => 10,
	'required' => true,
	'pattern' => '{0-9}{1,1000}',
	'validation' => '',
	'readonly' => false
),	
	4 => array(
	'type' => 'text',
	'name' => 'PAGO_ESTADO',
	'value' => '',
	'size' => 20,
	'required' => true,
	'pattern' => '{a-z}{A-Z}{0-9}{1,1000}',
	'validation' => '',
	'readonly' => false
	));