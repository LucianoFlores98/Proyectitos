<?php
print('<h2 align="center">Gestion de Personas</h2>');

$persona_controlador = new PersonaControlador();
$persona = $persona_controlador->get();

//para obtener el nombre de la empresa
$empresa_persona = new EmpresaControlador();
$empresa = $empresa_persona->get();

if (empty($persona)){
    print ('
        <div>
            <p>No hay persona</p>
        </div>
    ');
}else{

    //creo el encabezado
    $template_persona = '
    <div align="center">
    <table>
        <tr>
            <th>ID</th>
            <th>CUIL</th>
            <th>Apellido</th>
            <th>Nombre</th>
            <th>Empresa</th>
            <th colspan="2">

            <!--se usa un input hidden para poder trabajar con la url que se almacena en r-->

                <form method="POST">
                    <input type="hidden" name="r" value="persona-add">
                    <input type="submit" value="Agregar">
                </form>

            </th>
        </tr>
    ';
    //genero el resto con ayuda de un for (mientras i sea menor al num de elementos de status, i++)
    for ($i=0; $i < count($persona); $i++) { 
        //concateno utilizando el template como auxiliar
        $template_persona .= '

        <tr>
            <td>' . $persona[$i]['id'] . '</td>
            <td>' . $persona[$i]['cuil'] . '</td>
            <td>' . $persona[$i]['apellido'] . '</td>
            <td>' . $persona[$i]['nombres'] . '</td>
            <td>' . $empresa[$persona[$i]['empresa_id']-1]['nombre'] . '</td>

            <!--creo un formulario en la col para poder EDITAR los valores-->
            <td>
                <form method="POST">
                <input type="hidden" name="r" value="persona-edit">
                <input type="hidden" name="id" value="' . $persona[$i]['id'] . '">
                <input type="submit" value="Editar">
                </form>
            </td>

            <!--creo un formulario en la col para poder ELIMINAR los valores-->
            
            <td>
                <form method="POST">
                    <input type="hidden" name="r" value="persona-delete">
                    <input type="hidden" name="id" value="' . $persona[$i]['id'] . '">
                    <input type="submit" value="Eliminar">
                </form>
            </td>

        </tr> 
        ';
    }

    $template_persona .= '
    </table>
    </div>
    ';

    print($template_persona);
    
}

?>



