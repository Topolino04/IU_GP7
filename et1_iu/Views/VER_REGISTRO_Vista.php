<?php
class VER_REGISTRO_VISTA {

    private $registro;
    private $EMP_USER;
    private $CLIENTE_ID;
    
    public function __construct($registro, $EMP_USER, $CLIENTE_ID) {
        $this->registro=$registro;
        $this->EMP_USER = $EMP_USER;
        $this->CLIENTE_ID = $CLIENTE_ID;
        $this->render();
    }
    
    function render() {
        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
        leerFichero($this->registro);
        echo "<br><br>";
        if( $this->CLIENTE_ID == ''){
            echo '<a  class="form-link" href=\'LESION_Controller.php?accion=Registro&EMP_USER='.$this->EMP_USER. '\'>' . $strings['Volver'] . '</a>';
        } else{
            echo '<a  class="form-link" href=\'LESION_Controller.php?accion=Registro&CLIENTE_ID='.$this->CLIENTE_ID. '\'>' . $strings['Volver'] . '</a>';
        }
        
    }

}
?>