<?php 
$usuario_controlador = new UsuarioControlador();

if( $_POST['r'] == 'usuario-delete'  && !isset($_POST['crud']) ) {

	$usuario = $usuario_controlador->get($_POST['id']);

	if( empty($usuario) ) {
		$template = '
			<div class="container">
				<p class="item  error">No existe la usuario_id <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("usuario")
				}
			</script>
		';

		printf($template, $_POST['id']);
	} else {
		$template_usuario = '
			<h2 align="center">Eliminar usuario</h2>
			<form method="POST">
				<div align="center">
					¿Estas seguro de eliminar la usuario: 
					<mark> %s</mark>? (La usuario no se eliminará si está asociada a alguna entidad)
				</div>
				<div align="center">
					<input type="submit" value="SI">
					<input type="button" value="NO" onclick="history.back()">
					<input type="hidden" name="id" value="%s">
					<input type="hidden" name="r" value="usuario-delete">
					<input type="hidden" name="crud" value="del">
				</div>
			</form>
		';

		printf(
			$template_usuario,
			$usuario[0]['usuario'],
			$usuario[0]['id']
		);	
	}

} else if( $_POST['r'] == 'usuario-delete' && $_POST['crud'] == 'del' ) {	

	$usuario = $usuario_controlador->del($_POST['id']);

	$template = '
		<div>
			<p>Usuario <b>%s</b> eliminado</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("usuarios")
			}
		</script>
	';

	printf($template, $_POST['usuario']);
} 