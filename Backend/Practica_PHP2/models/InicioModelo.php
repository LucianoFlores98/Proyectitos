<?php

#Aca se realiza toda la logica

class EnlacesPaginas{

    public static function enlacesPaginasModelo($enlaces){

        if ($enlaces == "Nosotros" ||
            $enlaces == "Servicios" ||
            $enlaces == "Contacto"){

                #como el nombre de nuestro archivo nos pasan como variable $enlaces, concateno
                $modulo = "views/Modulos/" . $enlaces . ".php";

        }else if ($enlaces == "Inicio"){

            $modulo = "views/Modulos/Inicio.php";

        }
        

        #me devuelve el archivo de la pag php
        return $modulo;
    }
}
