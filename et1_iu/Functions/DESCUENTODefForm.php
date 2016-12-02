<?php
//Formulario para mostrar la consulta de roles
$DefForm = array(
	0 => array(
		'type' => 'text',
		'name' => 'DESCUENTO_ID',
		'value' => '',
		'texto'=>'Clave',
		'size' => 25,
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => true
	),
	1 => array(
		'type' => 'text',
		'name' => 'DESCUENTO_VALOR',
		'texto'=> 'Descuento',
		'value' => '',
		'size' => 50,
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	2 => array(
		'type' => 'text',
		'name' => 'DESCUENTO_DESCRIPCION',
		'texto'=> 'Descripcion',
		'value' => '',
		'size' => 80,
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	)
)
?>
