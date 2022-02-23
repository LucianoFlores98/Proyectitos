<?php

class SesionControlador{

    private $session;

    public function __construct(){
        $this->session = new UsuarioModelo();
    }

    public function login($usuario,$contraseña){
        return $this->session->validate_user($usuario,$contraseña);
    }

    public function logout(){
        session_start();
        session_destroy();
        header('Location: ./');
    }

    public function __destruct(){
        unset($this);
    }

}

?>