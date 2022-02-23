<?php
//si se desea controlar los permisos del usuario, usar la variable session
if (($_POST['r'] == 'permiso-add') && !isset($_POST['crud']) ){
    
    //llamo al controlador de empresa para poder traer la info que necesito
    $empresa_controlador = new EmpresaControlador();
    $empresa = $empresa_controlador->get();
    $empresa_select = '';

    for ($i=0; $i < count($empresa); $i++) { 
        //creo las opciones dinamicamente, asignandoles el valor del id de empresa y mostrando su respectivo nombre
        $empresa_select .= '<option value="' .$empresa[$i]['id'] . '">' . $empresa[$i]["nombre"] .'</option>';
    }

    printf ('
       
    <h2 align="center"> Agregar permiso</h2>

    <form method="POST">
        <div align="center">
            <input type="text" name="codigo" placeholder="Codigo" required>
        </div>

        <div align="center">
            <input type="text" name="descripcion" placeholder="Descripcion" required>
        </div>

        <div align="center">
            <select name="empresa_id" placeholder="Empresa" required>
            <option value="">Empresa</option>
            %s
        </div>

        <div align="center">
            <input type="submit" value="Agregar">
            <input type="hidden" name="r" value="permiso-add">
            <input type="hidden" name="crud" value="set">
        </div>
    </form>   
    
    ',$empresa_select);
//al usar printf puedo usar el valor %s para poner las options dinamicamente


}else if(($_POST['r'] == 'permiso-add') && $_POST['crud'] == 'set'){
    $permiso_controlador = new permisoControlador();

    $nuevo_permiso =array(
        'id' => 0,  //le asigno 0 porque el valor en la bd es autoincremental
        'codigo' => $_POST['codigo'],
        'descripcion' => $_POST['descripcion'],
        'empresa_id' =>$_POST['empresa_id']
    );

    //llamamos el metodo set y le asignamos el nuevo valor
    $permiso = $permiso_controlador->set($nuevo_permiso);

    $template = '
    <div align="center">
        <p>Permiso <b>%s</b> agregado.</p>
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
