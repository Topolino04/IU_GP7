<?php
//Formulario para la gestión de páginas
$Form = array(
	0 => array(
	'type' => 'text',
	'name' => 'ACTIVIDAD_ID',
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
	'name' => 'ACTIVIDAD_NOMBRE',
	'value' => '',
	'size' => 20,
	'required' => true,
	'pattern' => '{a-z}{A-Z}{0-9}{1,20}',
	'validation' => '',
	'readonly' => false
	),
	2 => array(
        'type' => 'text',
        'name' => 'ACTIVIDAD_PRECIO',
        'value' => '',
        'size' => 10,
        'required' => true,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
	),
	3 => array(
	'type' => 'text',
	'name' => 'ACTIVIDAD_DESCRIPCION',
	'value' => '',
	'size' => 100,
	'required' => true,
	'pattern' => '{a-z}{A-Z}{0-9}{1,200}',
	'validation' => '',
	'readonly' => false
	),
	4 => array(
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
	5 => array(
	'type' => 'select',
	'name' => 'ACTIVO',
	'multiple' => 'false',
	'value' => '',
	'options' => array('Activo','Inactivo'),
	'required' => 'true',
	'readonly' => false
	),
	6=>array(
		'type' => 'select',
		'name' => 'ACTIVIDAD_DIA',
		'multiple' => 'false',
		'value' => '',
		'options' => array($strings['Lunes'],$strings['Martes'],$strings['Miercoles'],$strings['Jueves'],$strings['Viernes'], $strings['Sabado'],$strings['Domingo']),
		'required' => 'true',
		'readonly' => false
	)
);
$Form2=AñadirLug($Form);
$Form3=AñadirHorarios2($Form2);
$Form4=AñadirCategorias($Form3);

$DefForm=AñadirProf($Form4);


?>
