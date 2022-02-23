<?php

$persona_controlador = new PersonaControlador();

if (($_POST['r'] == 'persona-edit') && !isset($_POST['crud']) ){
    
    $persona = $persona_controlador->get($_POST['id']);

    //llamo al controlador de empresa para poder traer la info que necesito
    $empresa_controlador = new EmpresaControlador();
    $empresa = $empresa_controlador->get();
    $empresa_select = '';

    for ($i=0; $i < count($empresa); $i++) { 
        //recorro y cuando es la empresa del usuario que la marque como seleccionada
        if($persona[0]['empresa_id'] == $empresa[$i]['id']){
            $selected = 'selected';

        }else{
            $selected = '';
        }
        //creo las opciones dinamicamente, asignandoles el valor del id de empresa y mostrando su respectivo nombre
        $empresa_select .= '<option value="' .$empresa[$i]['id'] . '"'. $selected .'>' . $empresa[$i]["nombre"] .'</option>';
    }

    if (empty($persona)) {
        $template = '
        <div align="center">
            <p>No existe una persona con el id <b>%s</b>.</p>
        </div>
        <script>
            window.onload = function(){
                reloadPage("persona")
            }
        </script>
        ';

    }else{

        $template_persona = '
        
        <h2 align="center"> Editar persona</h2>

        <form method="POST">

            <div align="center">
                <input type="text" placeholder="ID" name="id" value="%s" readonly>
            </div>

            <div align="center">
                <input type="text" name="cuil" placeholder="CUIL" value="%s" required>
            </div>

            <div align="center">
                <input type="text" name="apellido" placeholder="Apellido" value="%s" required>
            </div>

            <div align="center">
                <input type="text" name="nombres" placeholder="Nombres" value="%s" required>
            </div>

            <div align="center">
                <select name="empresa_id" placeholder="Empresa" required>
                <option value="">Empresa</option>
                %s
            </div>

            <div align="center">
                <input type="submit" value="Editar">
                <input type="hidden" name="r" value="persona-edit">
                <input type="hidden" name="crud" value="set">
            </div>
        </form>  
        ';

        printf(
        $template_persona,
        $persona[0]['id'],
        $persona[0]['cuil'],
        $persona[0]['apellido'],
        $persona[0]['nombres'],
        $empresa_select
        );
    }



}else if(($_POST['r'] == 'persona-edit') && $_POST['crud'] == 'set'){

    $save_persona =array(
        'id' => $_POST['id'], //le paso el id del registro
        'cuil' => $_POST['cuil'],
        'apellido' => $_POST['apellido'],
        'nombres' => $_POST['nombres'],
        'empresa_id' =>$_POST['empresa_id']
    );

    //llamamos el metodo set y le asignamos el nuevo valor
    $persona = $persona_controlador->set($save_persona);

    $template = '
    <div align="center">
        <p>Persona <b>%s %s</b> editada.</p>
    </div>
    <script>
    window.onload = function(){
        reloadPage("personas")
    }
    </script>
    ';

    printf($template,$_POST['apellido'],$_POST['nombres']);
}

?>