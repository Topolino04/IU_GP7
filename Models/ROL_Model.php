<?php

class ROL_MODEL
{
	var $rol_id;  // Usuario en git
	var $rol_descripcion; // Password del Usuario git
	var $mysqli;

//Constructor de la clase
//parametros: el dni, el nombre y los apellidos
function __construct($rol_id, $rol_descripcion)
{
    $this->rol_id = $rol_id;  // Usuario en git
    $this->rol_descripcion = $rol_descripcion; // Password del Usuario git

}

//Metodo (invocable estático) que conecta contra la BD y la tabla USUARIOS
function ConectarBD()
{
    $this->mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
	
	if ($this->mysqli->connect_errno) {
		echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
	}
}

//Metodo Insertar
//Inserta en la tabla USUARIOS de la bd IU2016 los valores
// de los atributos del objeto. Comprueba si usergit esta vacio y si 
//existe ya el usergit en la tabla
function Insertar()
{
    $this->ConectarBD();
    if ($this->rol_id <> '' ){
		
        $sql = "select * from ROL where rol_id = '".$this->rol_id."'";

		if (!$result = $this->mysqli->query($sql)){
			return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd
			//echo "error en la consulta";		
		}
		else {
	
			if ($result->num_rows == 0){
				
				$sql = "INSERT INTO ROL(rol_id, rol_descripcion) VALUES ('";
				$sql = $sql . "$this->rol_id', '$this->rol_descripcion')";
				
//echo $sql;

				$this->mysqli->query($sql);
				return 'Inserción realizada con éxito'; //operacion de insertado correcta
			}
			else
				return 'El usuario ya existe en la base de datos'; //el usuario ya existe
				//echo "<br>O Usuario Git xa existe<br>";
		}
    }
    else{
        //echo "Introduzca un valor para el usuario git<br>";
	return 'Introduzca un valor para el dni del usuario'; // introduzca un valor para el usuario
}
}

//funcion de destrucción del objeto: se ejecuta automaticamente
//al finalizar el script
function __destruct()
{

}

//funcion Consultar: hace una búsqueda en la tabla jugador con
//los datos de dni y nombre. Si van vacios devuelve todos
function Consultar()
{
    $this->ConectarBD();
    $sql = "select * from ROL where (rol_id LIKE '%".$this->rol_id."%') AND (rol_descripcion LIKE '%".$this->rol_descripcion."%');";
    if (!($resultado = $this->mysqli->query($sql))){
	return 'Error en la consulta sobre la base de datos';
	}
    else{
	return $resultado;
	}
}

function Borrar()
{
    $this->ConectarBD();
    $sql = "select * from ROL where rol_id = '".$this->rol_id."'";
    $result = $this->mysqli->query($sql);
    if ($result->num_rows == 1)
    {
        $sql = "delete from ROL where rol_id = '".$this->rol_id."'";
        $this->mysqli->query($sql);
    	return "El usuario ha sido borrado correctamente";
    }
    else
        return "El usuario no existe";
}

function RellenaDatos()
{
    $this->ConectarBD();
    $sql = "select * from ROL where rol_id = '".$this->rol_id."'";
    if (!($resultado = $this->mysqli->query($sql))){
	return 'Error en la consulta sobre la base de datos'; // sustituir por un try
	}
    else{
	$result = $resultado->fetch_array();
	var_dump($result);
	return $result;
	}
}

function Modificar()
{
    $this->ConectarBD();
    $sql = "select * from ROL where rol_id = '".$this->rol_id."'";
    $result = $this->mysqli->query($sql);
    if ($result->num_rows == 1)
    {
	$sql = "UPDATE ROL SET rol_id ='".$this->rol_id."',rol_descripcion = '".$this->rol_descripcion."' WHERE rol_id = '".$this->rol_id."'";
        if (!($resultado = $this->mysqli->query($sql))){
		return "Se ha producido un error en la modificación del usuario"; // sustituir por un try
	}
	else{
		return "El usuario se ha modificado con éxito";
	}
    }
    else
    return "El usuario no existe";
}

}//fin de clase














?>
