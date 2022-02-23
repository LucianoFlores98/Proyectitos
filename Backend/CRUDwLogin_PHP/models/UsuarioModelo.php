<?php

class UsuarioModelo extends PersonaModelo{

    public function set( $usuario_data = array() ) {
		foreach ($usuario_data as $key => $value) {
            //variable de variable
            $$key = $value;
		}
        //replace en el caso de que no se encuentre el id, crea un registro. Si lo encuentra actualiza(todos los campos)
        $this->query = "REPLACE INTO usuario (id, usuario, contraseña,persona_id,permiso_id,empresa_id) VALUES ($id, '$usuario','$contraseña',$persona_id,$permiso_id,$empresa_id)";
         //llamo a set query para ejecutar el query. Esta definida en el modelo
		$this->set_query();
	}

	public function get( $usuario_id = '' ) {
		$this->query = ($usuario_id != '')
			?"SELECT * FROM usuario WHERE id = $usuario_id"
			:"SELECT * FROM usuario";
		
		$this->get_query();

		$num_rows = count($this->rows);
        //declaro un array para los datos de la consulta
        $data = array();
        
        //lleno el array con los datos
		foreach ($this->rows as $key => $value) {
			array_push($data, $value);
		}
        //devuelvo los datos
		return $data;
	}

	public function del( $usuario_id = '' ) {
		$this->query = "DELETE FROM usuario WHERE id = $usuario_id";
		$this->set_query();
    }
    
    public function validate_user($usuario,$contraseña){
        $this->query = "SELECT * FROM usuario WHERE usuario = '$usuario' AND contraseña = '$contraseña'";
        $this->get_query();

        //creamos un array para contener los datos
        $data = array();

        //recorro y cargo el array evitando asi el ultimo elemento nulo
        foreach ($this->rows as $key => $value) {
            array_push($data,$value);
        }

        //retorna nulo si no hay ningun usuario que coincida
        return $data;
    }

	public function __destruct() {
		unset($this);
	}
}

?>