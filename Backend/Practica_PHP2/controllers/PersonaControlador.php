<?php

class PersonaControlador {
    private $modelo;

    public function __construct(){
        $this->modelo = new PersonaModelo();
    }

    public function set($personas_data = array()){
        return $this->modelo->set($personas_data);
    }

    public function get ($personas_id = '' ){
        return $this->modelo->get($personas_id);
    }


    public function del($personas_id = '' ){
        return $this->modelo->del($personas_id);
    }

    public function __destruct(){
        unset($this);
    }
    
}

?>