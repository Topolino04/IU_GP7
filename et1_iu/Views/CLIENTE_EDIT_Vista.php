<?php

class CLIENTE_Modificar{

	private $valores;
	private $volver;
//VISTA PARA LA MODIFICACIÓN DE EMPLEADOS
	function __construct($valores,$volver){
		$this->valores = $valores;
		$this->volver = $volver;
		$this->render();
	}

	function render(){

		include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
		include '../Functions/CLIENTEAddDefForm.php';
		//include '../Functions/LibraryFunctions.php';

		$lista1 = array('CLIENTE_DNI','CLIENTE_NOMBRE', 'CLIENTE_APELLIDOS', 'CLIENTE_FECH_NAC',  'CLIENTE_TELEFONO1','CLIENTE_TELEFONO2','CLIENTE_TELEFONO3',  'CLIENTE_CORREO', 'CLIENTE_PROFESION',  'CLIENTE_DIRECCION', 'CLIENTE_ESTADO','CLIENTE_COMENTARIOS',  'CLIENTE_DOM','CLIENTE_LOPD');
		$lista2=array('CLIENTE_DNI','CLIENTE_NOMBRE', 'CLIENTE_APELLIDOS',  'CLIENTE_TELEFONO1',  'CLIENTE_CORREO',   'CLIENTE_DIRECCION');
		?>
		<html>
		<head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
			<script type="text/javascript" src="../js/<?php echo $_SESSION['IDIOMA']?>_validate.js"></script>
			<meta charset="UTF-8">
		</head>
		<body>
<span class="form-title">
	<?php echo $strings['Modificar Cliente']?>
	<div>
<p>
<h2>
<form id="form" name="form"  action = 'CLIENTE_Controller.php'  method = 'post' enctype="multipart/form-data"><br>
	<ul class="form-style-1">
	<?php

	if($this->valores['CLIENTE_TIPO']==='1'){
	createForm($lista1,$DefForm,$strings,$this->valores,array('CLIENTE_COMENTARIOS'=>false,'CLIENTE_LOPD'=>false,'CLIENTE_DOM'=>false),array('CLIENTE_DNI'=>true));}
	if($this->valores['CLIENTE_TIPO']==='0'){

		createForm($lista2,$DefForm,$strings,$this->valores,array('CLIENTE_APELLIDOS'=>false,'CLIENTE_TELEFONO1'=>false,'CLIENTE_CORREO'=>false),array('CLIENTE_DNI'=>true));
	}
	?>

		<input type = 'submit' name = 'accion' value = '<?php echo $strings['Modificar'] ?>'  onclick="return valida_envia_CLIENTE()" >
</form>


<a class="form-link" href='<?php echo $this->volver; ?> '><?php echo $strings['Volver']; ?> </a>
		</p>

</div>
		</body>
		</html>
		<?php
	} // fin del metodo render
} // fin de la clase
?>
