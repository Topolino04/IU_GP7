<?php
//Formulario para la consulta de funcionalidades
$form2 = array(
	0 => array(
	'type' => 'text',
	'name' => 'FUNCIONALIDAD_NOM',
	'value' => '',
	'size' => 50,
	'required' => true,
	'pattern' => '',
	'validation' => '',
	'readonly' => false
	),
	1 => array(
	'type' => 'text',
	'name' => 'FUNCIONALIDAD_ID',
	'value' => '',
	'size' => 50,
	'required' => true,
	'pattern' => '',
	'validation' => '',
	'readonly' => false
),
	2 => array(
		'type' => 'text',
		'name' => 'EMP_USER',
		'value' => '',
		'size' => 25,
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	)
);
$DefForm2=añadirPaginas($form2);



?>
