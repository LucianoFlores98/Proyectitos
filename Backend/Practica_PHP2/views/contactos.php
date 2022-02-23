<?php
print('<h2 align="center">Gestion de Contactos</h2>');

$contacto_controlador = new ContactoControlador();
$contacto = $contacto_controlador->get();

//para obtener el nombre de la persona
$persona_contacto = new PersonaControlador();
$persona = $persona_contacto->get();

if (empty($contacto)){
    print ('
        <div>
            <p>No hay contacto</p>
        </div>
    ');
}else{

    //creo el encabezado
    $template_contacto = '
    <div align="center">
    <table>
        <tr>
            <th>ID</th>
            <th>E-mail</th>
            <th>CUIL</th>
            <th>Apellido</th>
            <th>Nombres</th>
            <th colspan="2">

            <!--se usa un input hidden para poder trabajar con la url que se almacena en r-->

                <form method="POST">
                    <input type="hidden" name="r" value="contacto-add">
                    <input type="submit" value="Agregar">
                </form>

            </th>
        </tr>
    ';
    //genero el resto con ayuda de un for (mientras i sea menor al num de elementos de status, i++)
    for ($i=0; $i < count($contacto); $i++) { 
        //concateno utilizando el template como auxiliar
        $template_contacto .= '

        <tr>
            <td>' . $contacto[$i]['id'] . '</td>
            <td>' . $contacto[$i]['email'] . '</td>
            <td>' . $persona[$contacto[$i]['persona_id']-1]['cuil'] . '</td>
            <td>' . $persona[$contacto[$i]['persona_id']-1]['apellido'] . '</td>
            <td>' . $persona[$contacto[$i]['persona_id']-1]['nombres'] . '</td>

            <!--creo un formulario en la col para poder EDITAR los valores-->
            <td>
                <form method="POST">
                <input type="hidden" name="r" value="contacto-edit">
                <input type="hidden" name="id" value="' . $contacto[$i]['id'] . '">
                <input type="submit" value="Editar">
                </form>
            </td>

            <!--creo un formulario en la col para poder ELIMINAR los valores-->
            
            <td>
                <form method="POST">
                    <input type="hidden" name="r" value="contacto-delete">
                    <input type="hidden" name="id" value="' . $contacto[$i]['id'] . '">
                    <input type="submit" value="Eliminar">
                </form>
            </td>

        </tr> 
        ';
    }

    $template_contacto .= '
    </table>
    </div>
    ';

    print($template_contacto);
    
}

?>



