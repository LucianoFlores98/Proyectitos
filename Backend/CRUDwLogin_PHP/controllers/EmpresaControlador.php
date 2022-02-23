<?php

class EmpresaControlador {
    private $modelo;

    public function __construct(){
        $this->modelo = new EmpresaModelo();
    }

    public function set($empresa_data = array()){
        return $this->modelo->set($empresa_data);
    }

    public function get ($empresa_id = '' ){
        return $this->modelo->get($empresa_id);
    }


    public function del($empresa_id = '' ){
        return $this->modelo->del($empresa_id);
    }

    public function __destruct(){
        unset($this);
    }
    
}

?>