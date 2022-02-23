<?php

$permiso_controlador = new PermisoControlador();

if (($_POST['r'] == 'permiso-edit') && !isset($_POST['crud']) ){
    
    $permiso = $permiso_controlador->get($_POST['id']);

    //llamo al controlador de empresa para poder traer la info que necesito
    $empresa_controlador = new EmpresaControlador();
    $empresa = $empresa_controlador->get();
    $empresa_select = '';

    for ($i=0; $i < count($empresa); $i++) { 
        //recorro y cuando es la empresa del usuario que la marque como seleccionada
        if($permiso[0]['empresa_id'] == $empresa[$i]['id']){
            $selected = 'selected';

        }else{
            $selected = '';
        }
        //creo las opciones dinamicamente, asignandoles el valor del id de empresa y mostrando su respectivo nombre
        $empresa_select .= '<option value="' .$empresa[$i]['id'] . '"'. $selected .'>' . $empresa[$i]["nombre"] .'</option>';
    }

    if (empty($permiso)) {
        $template = '
        <div align="center">
            <p>No existe una permiso con el id <b>%s</b>.</p>
        </div>
        <script>
            window.onload = function(){
                reloadPage("permiso")
            }
        </script>
        ';

    }else{

        $template_permiso = '
        
        <h2 align="center"> Editar permiso</h2>

        <form method="POST">

            <div align="center">
                <input type="text" placeholder="ID" name="id" value="%s" readonly>
            </div>

            <div align="center">
                <input type="text" name="codigo" placeholder="Codigo" value="%s" required>
            </div>

            <div align="center">
                <input type="text" name="descripcion" placeholder="Descripcion" value="%s" required>
            </div>

            <div align="center">
                <select name="empresa_id" placeholder="Empresa" required>
                <option value="">Empresa</option>
                %s
            </div>

            <div align="center">
                <input type="submit" value="Editar">
                <input type="hidden" name="r" value="permiso-edit">
                <input type="hidden" name="crud" value="set">
            </div>
        </form>  
        ';

        printf(
        $template_permiso,
        $permiso[0]['id'],
        $permiso[0]['codigo'],
        $permiso[0]['descripcion'],
        $empresa_select
        );
    }



}else if(($_POST['r'] == 'permiso-edit') && $_POST['crud'] == 'set'){

    $save_permiso =array(
        'id' => $_POST['id'], //le paso el id del registro
        'codigo' => $_POST['codigo'],
        'descripcion' => $_POST['descripcion'],
        'empresa_id' =>$_POST['empresa_id']
    );

    //llamamos el metodo set y le asignamos el nuevo valor
    $permiso = $permiso_controlador->set($save_permiso);

    $template = '
    <div align="center">
        <p>Permiso <b>%s</b> editado.</p>
    </div>
    <script>
    window.onload = function(){
        reloadPage("permisos")
    }
    </script>
    ';

    printf($template,$_POST['descripcion']);
}

?>