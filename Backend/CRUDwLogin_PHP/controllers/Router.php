<?php
//enrutador para manejar el flujo de la aplicacion
class Router{
    public $route;

    //recibe la ruta que venga de index.php
    public function __construct($route){
        //compruebo si existe una variable de tipo sesion
        if (!isset($_SESSION)){
            session_start([
                'use_only_cookies' => 1,
                'auto_start' => 1,
                'read_and_close' => true //cierra nuestra sesion cuando no la usemos 
            ]);
            
        }
        //si la variable sesion de tipo ok no está definida
        if(!isset($_SESSION['ok'])){
            //pongo en falso para que este en ok cuando el usuario se identifique
            $_SESSION['ok'] = false;
        }
        
        //si existe la variable de tipo sesion ok entonces
        if ($_SESSION['ok']){
            //aca va toda la programacion de nuestra webapp (si el usuario está validado)
           
           //obtemenos la ruta y asignamos como home en caso de de que no esté definida
            if(isset($_GET['r'])){
               $this->route = $_GET['r'];
            
            }else{
                $this->route = 'home';
            }

            $controller = new VistaControlador();
            
            switch ($this->route) {
                case 'home':
                    $controller->load_view('home');
                break;
                
                case 'empresa':
                    //si no recibo nada de un form de empresa, genero la vista
                    if ( !isset($_POST['r'])){
                        $controller->load_view('empresa');
                    }else if ( $_POST['r'] == "empresa-add"){
                        //si recibo add, cargo la vista para agregar
                        $controller->load_view('agregar_empresa');
                    }else if ($_POST['r'] == 'empresa-edit'){
                        //si recibo editar, cargo la vista para editar
                        $controller->load_view('editar_empresa');
                    }else if ($_POST['r'] == 'empresa-delete'){
                        //si recibo delete, cargo la vista para eliminar
                        $controller->load_view('eliminar_empresa');
                    }
                    break;
                
                case 'personas':
                    if ( !isset($_POST['r'])){
                        $controller->load_view('personas');
                    }else if ( $_POST['r'] == "persona-add"){
                        //si recibo add, cargo la vista para agregar
                        $controller->load_view('agregar_persona');
                    }else if ($_POST['r'] == 'persona-edit'){
                        //si recibo editar, cargo la vista para editar
                        $controller->load_view('editar_persona');
                    }else if ($_POST['r'] == 'persona-delete'){
                        //si recibo delete, cargo la vista para eliminar
                        $controller->load_view('eliminar_persona');
                    }
                break;

                case 'empleados':
                    if ( !isset($_POST['r'])){
                        $controller->load_view('empleados');
                    }else if ( $_POST['r'] == "empleado-add"){
                        //si recibo add, cargo la vista para agregar
                        $controller->load_view('agregar_empleado');
                    }else if ($_POST['r'] == 'empleado-edit'){
                        //si recibo editar, cargo la vista para editar
                        $controller->load_view('editar_empleado');
                    }else if ($_POST['r'] == 'empleado-delete'){
                        //si recibo delete, cargo la vista para eliminar
                        $controller->load_view('eliminar_empleado');
                    }
                break;

                case 'contactos':
                    if ( !isset($_POST['r'])){
                        $controller->load_view('contactos');
                    }else if ( $_POST['r'] == "contacto-add"){
                        //si recibo add, cargo la vista para agregar
                        $controller->load_view('agregar_contacto');
                    }else if ($_POST['r'] == 'contacto-edit'){
                        //si recibo editar, cargo la vista para editar
                        $controller->load_view('editar_contacto');
                    }else if ($_POST['r'] == 'contacto-delete'){
                        //si recibo delete, cargo la vista para eliminar
                        $controller->load_view('eliminar_contacto');
                    }
                break;

                case 'usuarios':
                    if ( !isset($_POST['r'])){
                        $controller->load_view('usuarios');
                    }else if ( $_POST['r'] == "usuario-add"){
                        //si recibo add, cargo la vista para agregar
                        $controller->load_view('agregar_usuario');
                    }else if ($_POST['r'] == 'usuario-edit'){
                        //si recibo editar, cargo la vista para editar
                        $controller->load_view('editar_usuario');
                    }else if ($_POST['r'] == 'usuario-delete'){
                        //si recibo delete, cargo la vista para eliminar
                        $controller->load_view('eliminar_usuario');
                    }
                break;

                case 'permisos':
                    if ( !isset($_POST['r'])){
                        $controller->load_view('permisos');
                    }else if ( $_POST['r'] == "permiso-add"){
                        //si recibo add, cargo la vista para agregar
                        $controller->load_view('agregar_permiso');
                    }else if ($_POST['r'] == 'permiso-edit'){
                        //si recibo editar, cargo la vista para editar
                        $controller->load_view('editar_permiso');
                    }else if ($_POST['r'] == 'permiso-delete'){
                        //si recibo delete, cargo la vista para eliminar
                        $controller->load_view('eliminar_permiso');
                    }
                break;

                case 'logout':
                    $controller = new SesionControlador();
                    $controller->logout();
                break;

                default:
                    echo 'ERROR 404';
                    echo "$route";
                break;
            }


        }else{
            //si es falso entonces pregunto si no hay una variable definida en usuario y contraseña...
            if (!isset($_POST['usuario']) && !isset($_POST['contraseña'])) {
                //mostrar un formulario de autenticacion
                $login_form = new VistaControlador();
                $login_form->load_view('login');

            }else {
                //utilizo un controlador para la sesion
                $user_session = new SesionControlador();
                //llamo el metodo login del controlador de sesion que a su vez llama al metodo del modelo de usuario, enviandoles los datos obtenidos del form a traves de post
                $session = $user_session->login($_POST['usuario'],$_POST['contraseña']);

                //si no obtengo nada quiere decir que no existe un usuario y contraseña en la bd con esos valores ingresados
                if(empty($session)){
                    //utilizo un js para dar una alerta y vuelvo a cargara el form
                    echo "<script> alert ('Usuario o clave incorrectos');</script>";
                    $login_form = new VistaControlador();
                    $login_form->load_view('login');

                }else{
                    $_SESSION['ok'] = true;
                    //aca podria almacenar los datos del usuario en una variable _session[]
                    header('Location: ./');

                }
            }

        }
    }

    public function __destruct(){
        unset($this);
    }
}

?>