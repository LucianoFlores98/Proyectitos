<?php
print('<h2 align="center">Gestion de Usuarios</h2>');

$usuario_controlador = new UsuarioControlador();
$usuario = $usuario_controlador->get();

//para obtener el nombre de la empresa
$empresa_usuario = new EmpresaControlador();
$empresa = $empresa_usuario->get();

//para obtener el nombre de la persona
$persona_usuario = new PersonaControlador();
$persona = $persona_usuario->get();

//para obtener el nombre del permiso
$permiso_usuario = new PermisoControlador();
$permiso = $permiso_usuario->get();

if (empty($usuario)){
    print ('
        <div>
            <p>No hay usuario</p>
        </div>
    ');
}else{

    //creo el encabezado
    $template_usuario = '
    <div align="center">
    <table>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Contraseña</th>
            <th>Empresa</th>
            <th>CUIL</th>
            <th>Apellido</th>
            <th>Nombre</th>
            <th>Permiso</th>

            <th colspan="2">

            <!--se usa un input hidden para poder trabajar con la url que se almacena en r-->

                <form method="POST">
                    <input type="hidden" name="r" value="usuario-add">
                    <input type="submit" value="Agregar">
                </form>

            </th>
        </tr>
    ';
    //genero el resto con ayuda de un for (mientras i sea menor al num de elementos de status, i++)
    for ($i=0; $i < count($usuario); $i++) { 
        //concateno utilizando el template como auxiliar
        $template_usuario .= '

        <tr>
            <td>' . $usuario[$i]['id'] . '</td>
            <td>' . $usuario[$i]['usuario'] . '</td>
            <td>' . $usuario[$i]['contraseña'] . '</td>
            <td>' . $empresa[$usuario[$i]['empresa_id']-1]['nombre'] . '</td>
            <td>' . $persona[$usuario[$i]['persona_id']-1]['cuil'] . '</td>
            <td>' . $persona[$usuario[$i]['persona_id']-1]['apellido'] . '</td>
            <td>' . $persona[$usuario[$i]['persona_id']-1]['nombres'] . '</td>
            <td>' . $permiso[$usuario[$i]['permiso_id']-1]['descripcion'] . '</td>

            <!--creo un formulario en la col para poder EDITAR los valores-->
            <td>
                <form method="POST">
                <input type="hidden" name="r" value="usuario-edit">
                <input type="hidden" name="id" value="' . $usuario[$i]['id'] . '">
                <input type="submit" value="Editar">
                </form>
            </td>

            <!--creo un formulario en la col para poder ELIMINAR los valores-->
            
            <td>
                <form method="POST">
                    <input type="hidden" name="r" value="usuario-delete">
                    <input type="hidden" name="id" value="' . $usuario[$i]['id'] . '">
                    <input type="submit" value="Eliminar">
                </form>
            </td>

        </tr> 
        ';
    }

    $template_usuario .= '
    </table>
    </div>
    ';

    print($template_usuario);
    
}

?>



