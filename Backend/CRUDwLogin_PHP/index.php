<?php

//llamo a un autoloader para que me va a cargar todos los archivos en cada parte de la applicacion
require_once('./controllers/Autoload.php');
$autoload = new Autoload();

//si la variable que vamos a pasar para la url esta definida entonces...
if(isset($_GET['r'])){
    $route = $_GET['r'];

}else{ //si no esta definida le asignamos home
    $route = 'home';
}

//recibe una ruta
$practico2 = new Router($route);

?>