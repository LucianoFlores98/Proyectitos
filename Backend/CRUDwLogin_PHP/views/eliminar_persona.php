<?php 
$persona_controlador = new PersonaControlador();

if( $_POST['r'] == 'persona-delete'  && !isset($_POST['crud']) ) {

	$persona = $persona_controlador->get($_POST['id']);

	if( empty($persona) ) {
		$template = '
			<div class="container">
				<p class="item  error">No existe la persona_id <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("persona")
				}
			</script>
		';

		printf($template, $_POST['id']);
	} else {
		$template_persona = '
			<h2 align="center">Eliminar persona</h2>
			<form method="POST">
				<div align="center">
					¿Estas seguro de eliminar la persona: 
					<mark> %s</mark>? (La persona no se eliminará si está asociada a alguna entidad)
				</div>
				<div align="center">
					<input type="submit" value="SI">
					<input type="button" value="NO" onclick="history.back()">
					<input type="hidden" name="id" value="%s">
					<input type="hidden" name="r" value="persona-delete">
					<input type="hidden" name="crud" value="del">
				</div>
			</form>
		';

		printf(
			$template_persona,
			$persona[0]['nombres'],
			$persona[0]['id']
		);	
	}

} else if( $_POST['r'] == 'persona-delete' && $_POST['crud'] == 'del' ) {	

	$persona = $persona_controlador->del($_POST['id']);

	$template = '
		<div>
			<p>persona <b>%s</b> eliminada</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("personas")
			}
		</script>
	';

	printf($template, $_POST['id']);
} 