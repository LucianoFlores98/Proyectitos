<?php
print('<h2 align="center">Gestion de Empleados</h2>');

$empleado_controlador = new EmpleadoControlador();
$empleado = $empleado_controlador->get();

//para obtener el nombre de la persona
$persona_empleado = new PersonaControlador();
$persona = $persona_empleado->get();

if (empty($empleado)){
    print ('
        <div>
            <p>No hay empleado</p>
        </div>
    ');
}else{

    //creo el encabezado
    $template_empleado = '
    <div align="center">
    <table>
        <tr>
            <th>ID</th>
            <th>Legajo</th>
            <th>Dependencia</th>
            <th>Fecha de ingreso</th>
            <th>CUIL</th>
            <th>Apellido</th>
            <th>Nombres</th>
            <th colspan="2">

            <!--se usa un input hidden para poder trabajar con la url que se almacena en r-->

                <form method="POST">
                    <input type="hidden" name="r" value="empleado-add">
                    <input type="submit" value="Agregar">
                </form>

            </th>
        </tr>
    ';
    //genero el resto con ayuda de un for (mientras i sea menor al num de elementos de status, i++)
    for ($i=0; $i < count($empleado); $i++) { 
        //concateno utilizando el template como auxiliar
        $template_empleado .= '

        <tr>
            <td>' . $empleado[$i]['id'] . '</td>
            <td>' . $empleado[$i]['nroLegajo'] . '</td>
            <td>' . $empleado[$i]['dependencia'] . '</td>
            <td>' . $empleado[$i]['fechaIngreso'] . '</td>
            <td>' . $persona[$empleado[$i]['persona_id']-1]['cuil'] . '</td>
            <td>' . $persona[$empleado[$i]['persona_id']-1]['apellido'] . '</td>
            <td>' . $persona[$empleado[$i]['persona_id']-1]['nombres'] . '</td>

            <!--creo un formulario en la col para poder EDITAR los valores-->
            <td>
                <form method="POST">
                <input type="hidden" name="r" value="empleado-edit">
                <input type="hidden" name="id" value="' . $empleado[$i]['id'] . '">
                <input type="submit" value="Editar">
                </form>
            </td>

            <!--creo un formulario en la col para poder ELIMINAR los valores-->
            
            <td>
                <form method="POST">
                    <input type="hidden" name="r" value="empleado-delete">
                    <input type="hidden" name="id" value="' . $empleado[$i]['id'] . '">
                    <input type="submit" value="Eliminar">
                </form>
            </td>

        </tr> 
        ';
    }

    $template_empleado .= '
    </table>
    </div>
    ';

    print($template_empleado);
    
}

?>
