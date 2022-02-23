<?php 
$empresa_controlador = new EmpresaControlador();

if( $_POST['r'] == 'empresa-delete'  && !isset($_POST['crud']) ) {

	$empresa = $empresa_controlador->get($_POST['id']);

	if( empty($empresa) ) {
		$template = '
			<div class="container">
				<p class="item  error">No existe la empresa_id <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("empresa")
				}
			</script>
		';

		printf($template, $_POST['id']);
	} else {
		$template_empresa = '
			<h2 align="center">Eliminar empresa</h2>
			<form method="POST">
				<div align="center">
					¿Estas seguro de eliminar la empresa: 
					<mark> %s</mark>? (La empresa no se eliminará si está asociada a alguna entidad)
				</div>
				<div align="center">
					<input type="submit" value="SI">
					<input type="button" value="NO" onclick="history.back()">
					<input type="hidden" name="id" value="%s">
					<input type="hidden" name="r" value="empresa-delete">
					<input type="hidden" name="crud" value="del">
				</div>
			</form>
		';

		printf(
			$template_empresa,
			$empresa[0]['nombre'],
			$empresa[0]['id']
		);	
	}

} else if( $_POST['r'] == 'empresa-delete' && $_POST['crud'] == 'del' ) {	

	$empresa = $empresa_controlador->del($_POST['id']);

	$template = '
		<div>
			<p>Empresa <b>%s</b> eliminada</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("empresa")
			}
		</script>
	';

	printf($template, $_POST['id']);
} 