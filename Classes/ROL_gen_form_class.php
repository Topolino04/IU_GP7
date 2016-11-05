<?php

class gen_form{

private $form;

function __construct($form){
			$this->form = $form;

}
//
// metodo que crea el comienzo del formulario, define el action y el method
//

function crear_form(){
        
			$action = $this->form['action'];
			$method = $this->form['method'];
			       
			echo "<form action = '" . $action . "' method = '" . $method . "'><br>";
                        
}

function crear_campos(){
	
	//procesa los inputs
	$inputs = $this->form['input'];
	foreach ($inputs as $input){
		$str = $input['textointro'] . " : <input type = '" . $input['type'] . "' name = '" . $input['name'] . "' ><br>";
		echo $str;
		}	

//	// procesa los select
//	$selects = $this->form['select'];
//	foreach ($selects as $select){
//		$str = $select['textointro'] . ": <select name='" . $select['name'] . "'";
//		if ($select['multiple']=='true'){
//			$str = $str . "multiple ";
//		}
//		$str = $str . " ><br>";
//		foreach ($select['values'] as $value){
//			$str1 = "<option value = '" . $value . "'>" . $value . "</option><br>";
//			$str = $str . $str1;
//		}
//		$str = $str . "</select><br>";
//		echo $str;
//	}
			
	// procesa los submits
	$submits = $this->form['submit'];
	foreach ($submits as $submit){
		$str = "<input type = '" . $submit['type'] . "' name = '" . $submit['name'] . "' value = '" . $submit['textointro'] . "' >";
		echo $str;
	}	
	
	//procesa los resets
	$reset = $this->form['reset'];
	//foreach ($resets as $reset){
		$str = "<input type = '" . $reset['type'] . "' name = '" . $reset['name'] . "' value = '" . $reset['textointro'] . "' ><br>";
		echo $str;
	//}	
	
}

function cerrar_form(){
	echo '</form>';
}

function crear_formulario(){
	$this->crear_form();
	$this->crear_campos();
	$this->cerrar_form();
}

function get_Titulos(){
	$titulos = array('rol_id','rol_descripcion');
//	$titulos = array();
//	$inputs = $this->form['input'];
//	foreach($inputs as $input){
//		if (!($input['name']=='password')){
//		array_push($titulos,$input['name']);
//		}
//	}
	return $titulos;
}


} //end class

?>
