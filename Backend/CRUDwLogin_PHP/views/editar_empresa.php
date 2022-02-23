<?php
//si se desea controlar los permisos del usuario, usar la variable session

$empresa_controlador = new EmpresaControlador();

if (($_POST['r'] == 'empresa-edit') && !isset($_POST['crud']) ){
    
    $empresa = $empresa_controlador->get($_POST['id']);

    if (empty($empresa)) {
        $template = '
        <div align="center">
            <p>No existe una empresa con el id <b>%s</b>.</p>
        </div>
        <script>
            window.onload = function(){
                reloadPage("empresa")
            }
        </script>
        ';

    }else{

        $template_empresa = '
        
        <h2 align="center"> Editar Empresa</h2>

        <form method="POST">
            <div align="center">
                <input type="text" placeholder="ID" name="id" value="%s" readonly>
            </div>

            <div align="center">
                <input type="text" name="nombre" placeholder="Empresa" value="%s" required>
            </div>

            <div align="center">
                <input type="submit" value="Editar">
                <input type="hidden" name="r" value="empresa-edit">
                <input type="hidden" name="crud" value="set">
            </div>
        </form>  
        ';

        printf(
        $template_empresa,
        $empresa[0]['id'],
        $empresa[0]['nombre']
        );
    }



}else if(($_POST['r'] == 'empresa-edit') && $_POST['crud'] == 'set'){

    $save_empresa =array(
        'id' => $_POST['id'], //le paso el id del registro
        'nombre' => $_POST['nombre']
    );

    //llamamos el metodo set y le asignamos el nuevo valor
    $empresa = $empresa_controlador->set($save_empresa);

    $template = '
    <div align="center">
        <p>Empresa <b>%s</b> editada.</p>
    </div>
    <script>
    window.onload = function(){
        reloadPage("empresa")
    }
    </script>
    ';

    printf($template,$_POST['nombre']);
}

?>