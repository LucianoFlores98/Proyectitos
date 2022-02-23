<?php
//si se desea controlar los permisos del usuario, usar la variable session
if (($_POST['r'] == 'contacto-add') && !isset($_POST['crud']) ){
    
    //llamo al controlador de persona para poder traer la info que necesito
    $persona_controlador = new PersonaControlador();
    $persona = $persona_controlador->get();
    $persona_select = '';

    for ($i=0; $i < count($persona); $i++) { 
        //creo las opciones dinamicamente, asignandoles el valor del id de persona y mostrando su respectivo nombre
        $persona_select .= '<option value="' .$persona[$i]['id'] . '">' . $persona[$i]["cuil"] .'</option>';
    }

    printf ('
       
    <h2 align="center"> Agregar contacto</h2>

    <form method="POST">
        <div align="center">
            <input type="email" name="email" placeholder="email" required>
        </div>


        <div align="center">
            <select name="persona_id" placeholder="persona" required>
            <option value="">persona</option>
            %s
        </div>

        <div align="center">
            <input type="submit" value="Agregar">
            <input type="hidden" name="r" value="contacto-add">
            <input type="hidden" name="crud" value="set">
        </div>
    </form>   
    
    ',$persona_select);
//al usar printf puedo usar el valor %s para poner las options dinamicamente


}else if(($_POST['r'] == 'contacto-add') && $_POST['crud'] == 'set'){
    $contacto_controlador = new contactoControlador();

    $nueva_contacto =array(
        'id' => 0,  //le asigno 0 porque el valor en la bd es autoincremental
        'email' => $_POST['email'],
        'persona_id' =>$_POST['persona_id']
    );

    //llamamos el metodo set y le asignamos el nuevo valor
    $contacto = $contacto_controlador->set($nueva_contacto);

    $template = '
    <div align="center">
        <p>Contacto agregado.</p>
    </div>
    <script>
    window.onload = function(){
        reloadPage("contactos")
    }
    </script>
    ';

    printf($template);
}

?>
