<?php
//Formulario para la gestión de páginas
$DefForm = array(
	0 => array(
	'type' => 'number',
	'name' => 'PAGINA_ID',
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
	'name' => 'PAGINA_LINK',
	'value' => '',
	'size' => 50,
	'required' => true,
	'pattern' => '{a-z}{A-Z}{0-9}{1,50}',
	'validation' => 'maxlength="50"',
	'readonly' => false
),
	2 => array(
	'type' => 'text',
	'name' => 'PAGINA_NOM',
	'value' => '',
	'size' => 20,
	'required' => true,
	'pattern' => '{a-z}{A-Z}{0-9}{1,20}',
	'validation' => '',
	'readonly' => false
)
)



?>
