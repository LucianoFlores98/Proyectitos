<?php
//si se desea controlar los permisos del persona, usar la variable session
if (($_POST['r'] == 'empleado-add') && !isset($_POST['crud']) ){
    
    //llamo al controlador de persona para poder traer la info que necesito
    $persona_controlador = new PersonaControlador();
    $persona = $persona_controlador->get();
    $persona_select = '';

    for ($i=0; $i < count($persona); $i++) { 
        //creo las opciones dinamicamente, asignandoles el valor del id de persona y mostrando su respectivo nombre
        $persona_select .= '<option value="' .$persona[$i]['id'] . '">' . $persona[$i]["cuil"] .'</option>';
    }

    printf ('
       
    <h2 align="center"> Agregar empleado</h2>

    <form method="POST">
        <div align="center">
            <input type="text" name="nroLegajo" placeholder="Legajo" required>
        </div>

        <div align="center">
            <input type="text" name="dependencia" placeholder="Dependencia" required>
        </div>

        <div align="center">
            <input id="date" type="date" name="fechaIngreso">
        </div>

        <div align="center">
            <select name="persona_id" placeholder="persona" required>
            <option value="">persona</option>
            %s
        </div>

        <div align="center">
            <input type="submit" value="Agregar">
            <input type="hidden" name="r" value="empleado-add">
            <input type="hidden" name="crud" value="set">
        </div>
    </form>   
    
    ',$persona_select);
//al usar printf puedo usar el valor %s para poner las options dinamicamente


}else if(($_POST['r'] == 'empleado-add') && $_POST['crud'] == 'set'){
    $empleado_controlador = new empleadoControlador();

    $nuevo_empleado =array(
        'id' => 0,  //le asigno 0 porque el valor en la bd es autoincremental
        'nroLegajo' => $_POST['nroLegajo'],
        'dependencia' => $_POST['dependencia'],
        'fechaIngreso' => $_POST['fechaIngreso'],
        'persona_id' =>$_POST['persona_id']
    );

    //llamamos el metodo set y le asignamos el nuevo valor
    $empleado = $empleado_controlador->set($nuevo_empleado);

    $template = '
    <div align="center">
        <p>empleado <b>%s</b> agregada.</p>
    </div>
    <script>
    window.onload = function(){
        reloadPage("empleados")
    }
    </script>
    ';

    printf($template,$_POST['nroLegajo']);
    var_dump($nuevo_empleado);
}

?>
