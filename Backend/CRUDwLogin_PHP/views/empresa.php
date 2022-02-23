<?php
print('<h2 align="center">Gestion de Empresas</h2>');

$empresa_controlador = new EmpresaControlador();
$empresa = $empresa_controlador->get();

if (empty($empresa)){
    print ('
        <div>
            <p>No hay Empresa</p>
        </div>
    ');
}else{

    //creo el encabezado
    $template_empresa = '
    <div align="center">
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th colspan="2">

            <!--se usa un imput hidden para poder trabajar con la url que se almacena en r-->

                <form method="POST">
                    <input type="hidden" name="r" value="empresa-add">
                    <input type="submit" value="Agregar">
                </form>

            </th>
        </tr>
    ';
    //genero el resto con ayuda de un for (mientras i sea menor al num de elementos de status, i++)
    for ($i=0; $i < count($empresa); $i++) { 
        //concateno utilizando el template como auxiliar
        $template_empresa .= '

        <tr>
            <td>' . $empresa[$i]['id'] . '</td>
            <td>' . $empresa[$i]['nombre'] . '</td>

            <!--creo un formulario en la col para poder EDITAR los valores-->
            <td>
                <form method="POST">
                <input type="hidden" name="r" value="empresa-edit">
                <input type="hidden" name="id" value="' . $empresa[$i]['id'] . '">
                <input type="submit" value="Editar">
                </form>
            </td>

            <!--creo un formulario en la col para poder ELIMINAR los valores-->
            
            <td>
                <form method="POST">
                    <input type="hidden" name="r" value="empresa-delete">
                    <input type="hidden" name="id" value="' . $empresa[$i]['id'] . '">
                    <input type="submit" value="Eliminar">
                </form>
            </td>

        </tr> 
        ';
    }

    $template_empresa .= '
    </table>
    </div>
    ';

    print($template_empresa);
    
}

?>



