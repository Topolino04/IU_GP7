<?php
//Formulario para la gestión de páginas
$Form = array(
    0 => array(
        'type' => 'text',
        'name' => 'FISIO_ID',
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
        'name' => 'FISIO_NOMBRE',
        'value' => '',
        'size' => 20,
        'required' => true,
        'pattern' => '{a-z}{A-Z}{0-9}{1,20}',
        'validation' => '',
        'readonly' => false
    ),

    2 => array(
        'type' => 'text',
        'name' => 'FISIO_DESCRIPCION',
        'value' => '',
        'size' => 100,
        'required' => true,
        'pattern' => '{a-z}{A-Z}{0-9}{1,200}',
        'validation' => '',
        'readonly' => false
    ),
    3=>array(
        'type' => 'select',
        'name' => 'FISIO_LUGAR',
        'multiple' => 'false',
        'value' => '',
        'options' => $list =  AñadirLugaresTitulos(array()),
        'required' => 'true',
        'readonly' => false
    ),
);

$Form2=AñadirHorarios4($Form);
$Form3=AñadirCategorias($Form2);
$DefForm=AñadirProf($Form3);


?>
