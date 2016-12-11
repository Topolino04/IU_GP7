<?php
//Formulario para la gestión de categorias
$DefForm = array(
	0 => array(
	'type' => 'text',
	'name' => 'CATEGORIA_ID',
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
	'name' => 'CATEGORIA_NOMBRE',
	'value' => '',
	'size' => 20,
	'required' => true,
	'pattern' => '{a-z}{A-Z}{0-9}{1,20}',
	'validation' => '',
	'readonly' => false
	)
);



?>
