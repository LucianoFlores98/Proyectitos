<?php 
$empleado_controlador = new EmpleadoControlador();

if( $_POST['r'] == 'empleado-delete'  && !isset($_POST['crud']) ) {

	$empleado = $empleado_controlador->get($_POST['id']);

	if( empty($empleado) ) {
		$template = '
			<div class="container">
				<p class="item  error">No existe el empleado_id <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("empleado")
				}
			</script>
		';

		printf($template, $_POST['id']);
	} else {
		$template_empleado = '
			<h2 align="center">Eliminar empleado</h2>
			<form method="POST">
				<div align="center">
					¿Estas seguro de eliminar la empleado: 
					<mark> %s</mark>? (La empleado no se eliminará si está asociada a alguna entidad)
				</div>
				<div align="center">
					<input type="submit" value="SI">
					<input type="button" value="NO" onclick="history.back()">
					<input type="hidden" name="id" value="%s">
					<input type="hidden" name="r" value="empleado-delete">
					<input type="hidden" name="crud" value="del">
				</div>
			</form>
		';

		printf(
			$template_empleado,
			$empleado[0]['nroLegajo'],
			$empleado[0]['id']
		);	
	}

} else if( $_POST['r'] == 'empleado-delete' && $_POST['crud'] == 'del' ) {	

	$empleado = $empleado_controlador->del($_POST['id']);

	$template = '
		<div>
			<p>Empleado <b>%s</b> eliminado</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("empleados")
			}
		</script>
	';

	printf($template, $_POST['nroLegajo']);
} 