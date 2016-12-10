<?php

class CLIENTE_Borrar{

	private $valores;
	private $volver;
//VISTA PARA EL BORRADO DE EMPLEADOS
	function __construct($valores,$volver){
		$this->valores = $valores;
		$this->volver = $volver;
		$this->render();
	}

	function render(){

		include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
		include '../Functions/CLIENTEDeleteDefForm.php';

		//include '../Functions/LibraryFunctions.php';

		$lista1 = array('CLIENTE_DNI','CLIENTE_NOMBRE', 'CLIENTE_APELLIDOS', 'CLIENTE_FECH_NAC',  'CLIENTE_TELEFONO1','CLIENTE_TELEFONO2','CLIENTE_TELEFONO3',  'CLIENTE_CORREO', 'CLIENTE_PROFESION',  'CLIENTE_DIRECCION','CLIENTE_COMENTARIOS');
		$lista2=array('CLIENTE_DNI','CLIENTE_NOMBRE', 'CLIENTE_APELLIDOS',  'CLIENTE_TELEFONO1',  'CLIENTE_CORREO',   'CLIENTE_DIRECCION');

		if ($this->valores['CLIENTE_DOM']!==''){
			array_push($lista1,'CLIENTE_DOM');
		}
		if ($this->valores['CLIENTE_LOPD']!==''){
			array_push($lista1,'CLIENTE_LOPD');
		}
		?>
		<html>
		<head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
			<meta charset="UTF-8">
		</head>

		<div>



			<form action = 'CLIENTE_Controller.php' method = 'get'><br>
				<span class="form-title">
			<?php echo $strings['Borrar Cliente']?><br>
				<ul class="form-style-1">
				<?php
				if($this->valores['CLIENTE_TIPO']==='1'){

				createForm($lista1,$DefForm,$strings,$this->valores,false,array('CLIENTE_COMENTARIOS'=>false));}
				if($this->valores['CLIENTE_TIPO']==='0'){
					createForm($lista2,$DefForm,$strings,$this->valores,false,true);
				}

				?>
					<input type = 'submit' name = 'accion' value =<?php echo $strings['Borrar'] ?> ></form> <a class="form-link" href='<?php echo $this->volver; ?> '><?php echo $strings['Volver']; ?> </a>
			</p>

		</div>

		</html>
		<?php
	} // fin del metodo render
} // fin de la clase
?>
