<?php

$empleado_controlador = new EmpleadoControlador();

if (($_POST['r'] == 'empleado-edit') && !isset($_POST['crud']) ){
    
    $empleado = $empleado_controlador->get($_POST['id']);

    //llamo al controlador de persona para poder traer la info que necesito
    $persona_controlador = new PersonaControlador();
    $persona = $persona_controlador->get();
    $persona_select = '';

    for ($i=0; $i < count($persona); $i++) { 
        //recorro y cuando es la persona del usuario que la marque como seleccionada
        if($empleado[0]['persona_id'] == $persona[$i]['id']){
            $selected = 'selected';

        }else{
            $selected = '';
        }
        //creo las opciones dinamicamente, asignandoles el valor del id de persona y mostrando su respectivo nombre
        $persona_select .= '<option value="' .$persona[$i]['id'] . '"'. $selected .'>' . $persona[$i]["cuil"] .'</option>';
    }

    if (empty($empleado)) {
        $template = '
        <div align="center">
            <p>No existe un empleado con el id <b>%s</b>.</p>
        </div>
        <script>
            window.onload = function(){
                reloadPage("empleados")
            }
        </script>
        ';

    }else{

        $template_empleado = '
        
        <h2 align="center"> Editar empleado</h2>

        <form method="POST">

            <div align="center">
                <input type="text" placeholder="ID" name="id" value="%s" readonly>
            </div>

            <div align="center">
                <input type="text" name="nroLegajo" placeholder="Legajo" value="%s" required>
            </div>

            <div align="center">
                <input type="text" name="dependencia" placeholder="Dependencia" value="%s" required>
            </div>

            <div align="center">
                <input id="date" type="date" name="fechaIngreso" value="%s">
            </div>

            <div align="center">
                <select name="persona_id" placeholder="persona" required>
                <option value="">persona</option>
                %s
            </div>

            <div align="center">
                <input type="submit" value="Editar">
                <input type="hidden" name="r" value="empleado-edit">
                <input type="hidden" name="crud" value="set">
            </div>
        </form>  
        ';

        printf(
        $template_empleado,
        $empleado[0]['id'],
        $empleado[0]['nroLegajo'],
        $empleado[0]['dependencia'],
        $empleado[0]['fechaIngreso'],
        $persona_select
        );
    }



}else if(($_POST['r'] == 'empleado-edit') && $_POST['crud'] == 'set'){

    $save_empleado =array(
        'id' => $_POST['id'], //le paso el id del registro
        'cuil' => $_POST['cuil'],
        'apellido' => $_POST['apellido'],
        'nombres' => $_POST['nombres'],
        'persona_id' =>$_POST['persona_id']
    );

    //llamamos el metodo set y le asignamos el nuevo valor
    $empleado = $empleado_controlador->set($save_empleado);

    $template = '
    <div align="center">
        <p>empleado <b>%s %s</b> editada.</p>
    </div>
    <script>
    window.onload = function(){
        reloadPage("empleados")
    }
    </script>
    ';

    printf($template,$_POST['apellido'],$_POST['nombres']);
}

?>