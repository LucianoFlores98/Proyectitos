<?php
//si se desea controlar los permisos del usuario, usar la variable session
if (($_POST['r'] == 'persona-add') && !isset($_POST['crud']) ){
    
    //llamo al controlador de empresa para poder traer la info que necesito
    $empresa_controlador = new EmpresaControlador();
    $empresa = $empresa_controlador->get();
    $empresa_select = '';

    for ($i=0; $i < count($empresa); $i++) { 
        //creo las opciones dinamicamente, asignandoles el valor del id de empresa y mostrando su respectivo nombre
        $empresa_select .= '<option value="' .$empresa[$i]['id'] . '">' . $empresa[$i]["nombre"] .'</option>';
    }

    printf ('
       
    <h2 align="center"> Agregar persona</h2>

    <form method="POST">
        <div align="center">
            <input type="text" name="cuil" placeholder="CUIL" required>
        </div>

        <div align="center">
            <input type="text" name="apellido" placeholder="Apellido" required>
        </div>

        <div align="center">
            <input type="text" name="nombres" placeholder="Nombres" required>
        </div>

        <div align="center">
            <select name="empresa_id" placeholder="Empresa" required>
            <option value="">Empresa</option>
            %s
        </div>

        <div align="center">
            <input type="submit" value="Agregar">
            <input type="hidden" name="r" value="persona-add">
            <input type="hidden" name="crud" value="set">
        </div>
    </form>   
    
    ',$empresa_select);
//al usar printf puedo usar el valor %s para poner las options dinamicamente


}else if(($_POST['r'] == 'persona-add') && $_POST['crud'] == 'set'){
    $persona_controlador = new personaControlador();

    $nueva_persona =array(
        'id' => 0,  //le asigno 0 porque el valor en la bd es autoincremental
        'cuil' => $_POST['cuil'],
        'apellido' => $_POST['apellido'],
        'nombres' => $_POST['nombres'],
        'empresa_id' =>$_POST['empresa_id']
    );

    //llamamos el metodo set y le asignamos el nuevo valor
    $persona = $persona_controlador->set($nueva_persona);

    $template = '
    <div align="center">
        <p>Persona <b>%s</b> agregada.</p>
    </div>
    <script>
    window.onload = function(){
        reloadPage("personas")
    }
    </script>
    ';

    printf($template,$_POST['persona']);
}

?>
