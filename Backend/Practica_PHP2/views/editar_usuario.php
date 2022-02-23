<?php

$usuario_controlador = new UsuarioControlador();

if (($_POST['r'] == 'usuario-edit') && !isset($_POST['crud'])) {

    $usuario = $usuario_controlador->get($_POST['id']);

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

    for ($i = 0; $i < count($empresa); $i++) {

        if ($usuario[0]['empresa_id'] == $empresa[$i]['id']) {
            $selected = 'selected';
        } else {
            $selected = '';
        }
        //creo las opciones dinamicamente, asignandoles el valor del id de empresa y mostrando su respectivo nombre
        $empresa_select .= '<option value="' .$empresa[$i]['id'] . '"'. $selected .'>' . $empresa[$i]["nombre"] .'</option>';
    }

    for ($i = 0; $i < count($persona); $i++) {
        if ($usuario[0]['persona_id'] == $persona[$i]['id']) {
            $selected = 'selected';
        } else {
            $selected = '';
        }
        //creo las opciones dinamicamente, asignandoles el valor del id de empresa y mostrando su respectivo nombre
        $persona_select .= '<option value="' . $persona[$i]['id'] . '"'.$selected .'>' . $persona[$i]["cuil"] . '</option>';
    }

    for ($i = 0; $i < count($permiso); $i++) {

        if ($usuario[0]['permiso_id'] == $permiso[$i]['id']) {
            $selected = 'selected';
        } else {
            $selected = '';
        }

        //creo las opciones dinamicamente, asignandoles el valor del id de empresa y mostrando su respectivo nombre
        $permiso_select .= '<option value="' . $permiso[$i]['id'] . '"'.$selected.'>' . $permiso[$i]["descripcion"] . '</option>';
    }


    if (empty($usuario)) {
        $template = '
        <div align="center">
            <p>No existe una usuario con el id <b>%s</b>.</p>
        </div>
        <script>
            window.onload = function(){
                reloadPage("usuario")
            }
        </script>
        ';
    } else {

        $template_usuario = '
        
        <h2 align="center"> Editar usuario</h2>

        <form method="POST">

            <div align="center">
                <input type="text" placeholder="ID" name="id" value="%s" readonly>
            </div>


            <div align="center">
                <label for="persona">Persona</label>
                <select id="persona" name="persona_id" placeholder="Persona" required>
                <option value="">Persona</option>
                %s
                </div>

                <div align="center">
                <input id= "usuario" type="text" name="usuario" placeholder="Usuario" value="%s" required>
            </div>

            <div align="center">
                <label for="permiso">Permiso</label>
                <select  id ="permiso" name="permiso_id" placeholder="Permiso" required>
                <option value="">Permiso</option>
                %s
            </div>
        
            <div align="center">
                <input  id ="contra "type="text" name="contraseña" placeholder=Contraseña value="%s" required>
            </div>

            <div align="center">
                <label for="empresa">Empresa</label>
                <select id="empresa" name="empresa_id" placeholder="Empresa" required>
                <option value="">Empresa</option>
                %s
            </div>

            <div align="center">
                <input type="submit" value="Editar">
                <input type="hidden" name="r" value="usuario-edit">
                <input type="hidden" name="crud" value="set">
            </div>
        </form>  
        ';

        printf(
            $template_usuario,
            $usuario[0]['id'],
            $persona_select,
            $usuario[0]['usuario'],
            $permiso_select,
            $usuario[0]['contraseña'],
            $empresa_select
        );
    }
} else if (($_POST['r'] == 'usuario-edit') && $_POST['crud'] == 'set') {

    $save_usuario = array(
        'id' => $_POST['id'], //le paso el id del registro
        'usuario' => $_POST['usuario'],
        'contraseña' => $_POST['contraseña'],
        'persona_id' => $_POST['persona_id'],
        'permiso_id' => $_POST['permiso_id'],
        'empresa_id' => $_POST['empresa_id']
    );

    //llamamos el metodo set y le asignamos el nuevo valor
    $usuario = $usuario_controlador->set($save_usuario);

    $template = '
    <div align="center">
        <p>Usuario <b>%s</b> editado.</p>
    </div>
    <script>
    window.onload = function(){
        reloadPage("usuarios")
    }
    </script>
    ';

    printf($template, $_POST['usuario']);
}
?>