<?php 
$contacto_controlador = new contactoControlador();

if( $_POST['r'] == 'contacto-delete'  && !isset($_POST['crud']) ) {

	$contacto = $contacto_controlador->get($_POST['id']);

	if( empty($contacto) ) {
		$template = '
			<div class="container">
				<p class="item  error">No existe el contacto_id <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("contacto")
				}
			</script>
		';

		printf($template, $_POST['id']);
	} else {
		$template_contacto = '
			<h2 align="center">Eliminar contacto</h2>
			<form method="POST">
				<div align="center">
					¿Estas seguro de eliminar el contacto: 
					<mark> %s</mark>? (El contacto no se eliminará si está asociada a alguna entidad)
				</div>
				<div align="center">
					<input type="submit" value="SI">
					<input type="button" value="NO" onclick="history.back()">
					<input type="hidden" name="id" value="%s">
					<input type="hidden" name="r" value="contacto-delete">
					<input type="hidden" name="crud" value="del">
				</div>
			</form>
		';

		printf(
			$template_contacto,
			$contacto[0]['nombres'],
			$contacto[0]['id']
		);	
	}

} else if( $_POST['r'] == 'contacto-delete' && $_POST['crud'] == 'del' ) {	

	$contacto = $contacto_controlador->del($_POST['id']);

	$template = '
		<div>
			<p>Contacto eliminado</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("contactos")
			}
		</script>
	';

	printf($template);
} 