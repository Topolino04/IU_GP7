<?php

//Definición del formulario para insertar y consultar lesiones
$form = array(
    0 => array(
        'type' => 'text',
        'name' => 'NOTIFICACION_REMITENTE',
        'value' => '',
        'size' => 35,
        'required' => true,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    ),
    1 => array(
        'type' => 'password',
        'name' => 'NOTIFICACION_PASSWORD',
        'value' => '',
        'size' => 15,
        'required' => true,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    ),
    2 => array(
        'type' => 'text',
        'name' => 'NOTIFICACION_NOMBRE_REMITENTE',
        'value' => 'MOOVETT',
        'size' => 35,
        'required' => false,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    ),
    3 => array(
        'type' => 'text',
        'name' => 'NOTIFICACION_ASUNTO',
        'value' => '',
        'size' => 35,
        'required' => false,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    )
);
