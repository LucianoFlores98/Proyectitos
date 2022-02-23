<?php

class UsuarioControlador {
    private $modelo;

    public function __construct(){
        $this->modelo = new UsuarioModelo();
    }

    public function set($usuarios_data = array()){
        return $this->modelo->set($usuarios_data);
    }

    public function get ($usuarios_id = '' ){
        return $this->modelo->get($usuarios_id);
    }


    public function del($usuarios_id = '' ){
        return $this->modelo->del($usuarios_id);
    }

    public function __destruct(){
        unset($this);
    }
    
}

?>