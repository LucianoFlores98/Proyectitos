<?php
//si se desea controlar los permisos del usuario, usar la variable session
if (($_POST['r'] == 'empresa-add') && !isset($_POST['crud']) ){
    print ('
       
    <h2 align="center"> Agregar Empresa</h2>

    <form method="POST">
        <div align="center">
            <input type="text" name="empresa" placeholder="Empresa" required>
        </div>
        <br>
        <div align="center">
            <input type="submit" value="Agregar">
            <input type="hidden" name="r" value="empresa-add">
            <input type="hidden" name="crud" value="set">
        </div>
    </form>   
    
    ');

}else if(($_POST['r'] == 'empresa-add') && $_POST['crud'] == 'set'){
    $empresa_controlador = new EmpresaControlador();

    $nueva_empresa =array(
        'id' => 0,  //le asigno 0 porque el valor en la bd es autoincremental
        'nombre' => $_POST['empresa']
    );

    //llamamos el metodo set y le asignamos el nuevo valor
    $empresa = $empresa_controlador->set($nueva_empresa);

    $template = '
    <div align="center">
        <p>Empresa <b>%s</b> agregada.</p>
    </div>
    <script>
    window.onload = function(){
        reloadPage("empresa")
    }
    </script>
    ';

    printf($template,$_POST['empresa']);
}

?>
