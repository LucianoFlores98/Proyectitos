<?php

class ContactoControlador {
    private $modelo;

    public function __construct(){
        $this->modelo = new ContactoModelo();
    }

    public function set($contactos_data = array()){
        return $this->modelo->set($contactos_data);
    }

    public function get ($contactos_id = '' ){
        return $this->modelo->get($contactos_id);
    }


    public function del($contactos_id = '' ){
        return $this->modelo->del($contactos_id);
    }

    public function __destruct(){
        unset($this);
    }
    
}

?>