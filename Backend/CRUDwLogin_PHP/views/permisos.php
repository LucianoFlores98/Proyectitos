<?php
print('<h2 align="center">Gestion de Permisos</h2>');

$permiso_controlador = new PermisoControlador();
$permiso = $permiso_controlador->get();

//para obtener el nombre de la empresa
$empresa_permiso = new EmpresaControlador();
$empresa = $empresa_permiso->get();

if (empty($permiso)){
    print ('
        <div>
            <p>No hay permiso</p>
        </div>
    ');
}else{

    //creo el encabezado
    $template_permiso = '
    <div align="center">
    <table>
        <tr>
            <th>ID</th>
            <th>Codigo</th>
            <th>Descripcion</th>
            <th>Empresa</th>
            <th colspan="2">

            <!--se usa un input hidden para poder trabajar con la url que se almacena en r-->

                <form method="POST">
                    <input type="hidden" name="r" value="permiso-add">
                    <input type="submit" value="Agregar">
                </form>

            </th>
        </tr>
    ';
    //genero el resto con ayuda de un for (mientras i sea menor al num de elementos de status, i++)
    for ($i=0; $i < count($permiso); $i++) { 
        //concateno utilizando el template como auxiliar
        $template_permiso .= '

        <tr>
            <td>' . $permiso[$i]['id'] . '</td>
            <td>' . $permiso[$i]['codigo'] . '</td>
            <td>' . $permiso[$i]['descripcion'] . '</td>
            <td>' . $empresa[$permiso[$i]['empresa_id']-1]['nombre'] . '</td>

            <!--creo un formulario en la col para poder EDITAR los valores-->
            <td>
                <form method="POST">
                <input type="hidden" name="r" value="permiso-edit">
                <input type="hidden" name="id" value="' . $permiso[$i]['id'] . '">
                <input type="submit" value="Editar">
                </form>
            </td>

            <!--creo un formulario en la col para poder ELIMINAR los valores-->
            
            <td>
                <form method="POST">
                    <input type="hidden" name="r" value="permiso-delete">
                    <input type="hidden" name="id" value="' . $permiso[$i]['id'] . '">
                    <input type="submit" value="Eliminar">
                </form>
            </td>

        </tr> 
        ';
    }

    $template_permiso .= '
    </table>
    </div>
    ';

    print($template_permiso);
    
}

?>



