<?php

$contacto_controlador = new ContactoControlador();

if (($_POST['r'] == 'contacto-edit') && !isset($_POST['crud']) ){
    
    $contacto = $contacto_controlador->get($_POST['id']);

    //llamo al controlador de persona para poder traer la info que necesito
    $persona_controlador = new PersonaControlador();
    $persona = $persona_controlador->get();
    $persona_select = '';

    for ($i=0; $i < count($persona); $i++) { 
        //recorro y cuando es la persona del usuario que la marque como seleccionada
        if($contacto[0]['persona_id'] == $persona[$i]['id']){
            $selected = 'selected';

        }else{
            $selected = '';
        }
        //creo las opciones dinamicamente, asignandoles el valor del id de persona y mostrando su respectivo nombre
        $persona_select .= '<option value="' .$persona[$i]['id'] . '"'. $selected .'>' . $persona[$i]["cuil"] .'</option>';
    }

    if (empty($contacto)) {
        $template = '
        <div align="center">
            <p>No existe un contacto con el id <b>%s</b>.</p>
        </div>
        <script>
            window.onload = function(){
                reloadPage("contacto")
            }
        </script>
        ';

    }else{

        $template_contacto = '
        
        <h2 align="center"> Editar contacto</h2>

        <form method="POST">

            <div align="center">
                <input type="text" placeholder="ID" name="id" value="%s" readonly>
            </div>

            <div align="center">
                <input type="email" name="email" placeholder="E-mail" value="%s" required>
            </div>

            <div align="center">
                <select name="persona_id" placeholder="persona" required>
                <option value="">persona</option>
                %s
            </div>

            <div align="center">
                <input type="submit" value="Editar">
                <input type="hidden" name="r" value="contacto-edit">
                <input type="hidden" name="crud" value="set">
            </div>
        </form>  
        ';

        printf(
        $template_contacto,
        $contacto[0]['id'],
        $contacto[0]['email'],
        $persona_select
        );
    }



}else if(($_POST['r'] == 'contacto-edit') && $_POST['crud'] == 'set'){

    $save_contacto =array(
        'id' => $_POST['id'], //le paso el id del registro
        'email' => $_POST['email'],
        'persona_id' =>$_POST['persona_id']
    );

    //llamamos el metodo set y le asignamos el nuevo valor
    $contacto = $contacto_controlador->set($save_contacto);

    $template = '
    <div align="center">
        <p>Contacto editado.</p>
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