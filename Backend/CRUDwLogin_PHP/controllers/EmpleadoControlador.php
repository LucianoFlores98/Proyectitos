<?php

class EmpleadoControlador {
    private $modelo;

    public function __construct(){
        $this->modelo = new EmpleadoModelo();
    }

    public function set($empleados_data = array()){
        return $this->modelo->set($empleados_data);
    }

    public function get ($empleados_id = '' ){
        return $this->modelo->get($empleados_id);
    }


    public function del($empleados_id = '' ){
        return $this->modelo->del($empleados_id);
    }

    public function __destruct(){
        unset($this);
    }
    
}

?>