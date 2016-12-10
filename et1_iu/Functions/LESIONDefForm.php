<?php

//Definición del formulario para insertar y consultar lesiones
$form = array(
    0 => array(
        'type' => 'text',
        'name' => 'LESION_ID',
        'value' => '',
        'size' => 10,
        'required' => true,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    ),
    1 => array(
        'type' => 'text',
        'name' => 'LESION_NOM',
        'value' => '',
        'size' => 35,
        'required' => true,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    ),
    2 => array(
        'type' => 'text',
        'name' => 'LESION_DESC',
        'value' => '',
        'size' => 75,
        'required' => false,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    ),
    3 => array(
        'type' => 'select',
        'name' => 'LESION_ESTADO',
        'multiple' => 'false',
        'value' => '',
        'options' => array('Superada', 'Pendiente', 'Cronica'),
        'readonly' => false
    )
);
?>
