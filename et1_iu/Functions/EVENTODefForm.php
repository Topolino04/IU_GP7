<?php
//Formulario para la gestión de eventos
$DefForm = array(
	0 => array(
	'type' => 'number',
	'name' => 'EVENTO_ID',
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
	'type' => 'text',
	'name' => 'EVENTO_ORGANIZADOR',
	'value' => '',
	'size' => 20,
	'required' => true,
	'pattern' => '{a-z}{A-Z}{0-9}{1,20}',
	'validation' => '',
	'readonly' => false
),
	3 => array(
	'type' => 'text',
	'name' => 'EVENTO_DESCRIPCION',
	'value' => '',
	'size' => 1000,
	'required' => true,
	'pattern' => '{a-z}{A-Z}{0-9}{1,1000}',
	'validation' => '',
	'readonly' => false
),	
	4 => array(
	'type' => 'text',
	'name' => 'LUGAR_NOMBRE',
	'value' => '',
	'size' => 20,
	'required' => true,
	'pattern' => '{a-z}{A-Z}{0-9}{1,1000}',
	'validation' => '',
	'readonly' => false
	));



?>
