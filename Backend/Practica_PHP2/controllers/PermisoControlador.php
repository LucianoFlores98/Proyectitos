<?php

class PermisoControlador {
    private $modelo;

    public function __construct(){
        $this->modelo = new PermisoModelo();
    }

    public function set($permisos_data = array()){
        return $this->modelo->set($permisos_data);
    }

    public function get ($permisos_id = '' ){
        return $this->modelo->get($permisos_id);
    }


    public function del($permisos_id = '' ){
        return $this->modelo->del($permisos_id);
    }

    public function __destruct(){
        unset($this);
    }
    
}

?>