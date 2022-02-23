<?php
//si se desea controlar los permisos del usuario, usar la variable session
if (($_POST['r'] == 'usuario-add') && !isset($_POST['crud']) ){
    
    //llamo al controlador de empresa para poder traer la info que necesito
    $empresa_controlador = new EmpresaControlador();
    $empresa = $empresa_controlador->get();
    $empresa_select = '';

    //para obtener el nombre de la persona
    $persona_usuario = new PersonaControlador();
    $persona = $persona_usuario->get();
    $persona_select = '';

    //para obtener el nombre del permiso
    $permiso_usuario = new PermisoControlador();
    $permiso = $permiso_usuario->get();
    $permiso_select = '';

    for ($i=0; $i < count($empresa); $i++) { 
        //creo las opciones dinamicamente, asignandoles el valor del id de empresa y mostrando su respectivo nombre
        $empresa_select .= '<option value="' .$empresa[$i]['id'] . '">' . $empresa[$i]["nombre"] .'</option>';
    }

        for ($i=0; $i < count($persona); $i++) { 
        //creo las opciones dinamicamente, asignandoles el valor del id de empresa y mostrando su respectivo nombre
        $persona_select .= '<option value="' .$persona[$i]['id'] . '">' . $persona[$i]["cuil"] .'</option>';
    }

    for ($i=0; $i < count($permiso); $i++) { 
        //creo las opciones dinamicamente, asignandoles el valor del id de empresa y mostrando su respectivo nombre
        $permiso_select .= '<option value="' .$permiso[$i]['id'] . '">' . $permiso[$i]["descripcion"] .'</option>';
    }

    printf ('
       
    <h2 align="center"> Agregar usuario</h2>

    <form method="POST">


        <div>
        <div align="center">
            <select id="persona" name="persona_id" placeholder="Persona" required>
            <option value="">Persona</option>
            %s
        </div>
        
        <div align="center">
            <input id= "usuario" type="text" name="usuario" placeholder="Usuario" required>
        </div>

        <div align="center">
            <select  id ="permiso" name="permiso_id" placeholder="Permiso" required>
            <option value="">Permiso</option>
            %s
        </div>
        
        <div align="center">
            <input  id ="contra "type="text" name="contraseña" placeholder=Contraseña required>
        </div>

        <div align="center">
            <select id="empresa" name="empresa_id" placeholder="Empresa" required>
            <option value="">Empresa</option>
            %s
        </div>

        <div align="center">
            <input type="submit" value="Agregar">
            <input type="hidden" name="r" value="usuario-add">
            <input type="hidden" name="crud" value="set">
        </div>
    </div>
    </form>   
    
    ',$persona_select,$permiso_select,$empresa_select);
//al usar printf puedo usar el valor %s para poner las options dinamicamente


}else if(($_POST['r'] == 'usuario-add') && $_POST['crud'] == 'set'){
    $usuario_controlador = new usuarioControlador();

    $nueva_usuario =array(
        'id' => 0,  //le asigno 0 porque el valor en la bd es autoincremental
        'usuario' => $_POST['usuario'],
        'contraseña' => $_POST['contraseña'],
        'persona_id' =>$_POST['persona_id'],
        'permiso_id' =>$_POST['permiso_id'],
        'empresa_id' =>$_POST['empresa_id']
    );

    //llamamos el metodo set y le asignamos el nuevo valor
    $usuario = $usuario_controlador->set($nueva_usuario);

    $template = '
    <div align="center">
        <p>Usuario <b>%s</b> agregado.</p>
    </div>
    <script>
    window.onload = function(){
        reloadPage("usuarios")
    }
    </script>
    ';

    printf($template,$_POST['usuario']);
}

?>
