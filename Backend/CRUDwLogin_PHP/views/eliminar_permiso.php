<?php 
$permiso_controlador = new permisoControlador();

if( $_POST['r'] == 'permiso-delete'  && !isset($_POST['crud']) ) {

	$permiso = $permiso_controlador->get($_POST['id']);

	if( empty($permiso) ) {
		$template = '
			<div class="container">
				<p class="item  error">No existe la permiso_id <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("permiso")
				}
			</script>
		';

		printf($template, $_POST['id']);
	} else {
		$template_permiso = '
			<h2 align="center">Eliminar permiso</h2>
			<form method="POST">
				<div align="center">
					¿Estas seguro de eliminar el permiso: 
					<mark> %s</mark>? (El permiso no se eliminará si está asociada a alguna entidad)
				</div>
				<div align="center">
					<input type="submit" value="SI">
					<input type="button" value="NO" onclick="history.back()">
					<input type="hidden" name="id" value="%s">
					<input type="hidden" name="r" value="permiso-delete">
					<input type="hidden" name="crud" value="del">
				</div>
			</form>
		';

		printf(
			$template_permiso,
			$permiso[0]['descripcion'],
			$permiso[0]['id']
		);	
	}

} else if( $_POST['r'] == 'permiso-delete' && $_POST['crud'] == 'del' ) {	

	$permiso = $permiso_controlador->del($_POST['id']);

	$template = '
		<div>
			<p>Permiso <b>%s</b> eliminado</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("permisos")
			}
		</script>
	';

	printf($template, $_POST['descripcion']);
} 