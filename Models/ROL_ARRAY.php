<?php
$arrayDefForm = array (
		'action' => 'ROL_Controller.php',
		'method' => 'post',
		'input' => array (
				'0' => array (
						'type' => 'text',
						'name' => 'rol_id',
						'len' => '60',
						'textointro' => 'Nombre del Rol' 
				),
				'1' => array (
						'type' => 'text',
						'name' => 'rol_descripcion',
						'len' => '150',
						'textointro' => 'Descripción del Rol' 
				) 
		),
		'submit' => array (
				'0' => array (
						'type' => 'submit',
						'name' => 'accion',
						'textointro' => 'Insertar' 
				),
				'1' => array (
						'type' => 'submit',
						'name' => 'accion',
						'textointro' => 'Consultar' 
				) 
		),
		'reset' => array (
				'type' => 'reset',
				'name' => 'reset',
				'textointro' => 'Resetear' 
		) 
)
;
?>