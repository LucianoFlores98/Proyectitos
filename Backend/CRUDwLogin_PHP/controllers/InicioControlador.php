<?php

class InicioControlador
{
    #llamada a la plantilla
    #--------------------------------------------------------
    public function plantilla(){
        #include() se utiliza para invocar el archivo que contiene el codigo html
        include "views/Inicio.php";
    }

    #interaccion con el usuario
    #--------------------------------------------------------
    public function enlacesPaginasControlador(){
        
        require_once "models/InicioModelo.php";

        if (isset($_GET["action"])) {

            #enlaces va a tomar la url que se llame con get a la variable "action"
            $enlaces = $_GET["action"];
        } else {

            $enlaces = "views/Modulos/Inicio";
        }
        #quiero tomar de modelo la clase EnlacesPaginas y se conecte con la funcion enlacesPaginasModelo(con los ::)
        $respuesta = EnlacesPaginas::enlacesPaginasModelo($enlaces);

        #que me muestre el archivo que trajo respuesta a traves del modelo
        include $respuesta;
    }
}