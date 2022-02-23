<?php

class PermisoModelo extends Modelo{

    public function set( $permiso_data = array() ) {
		foreach ($permiso_data as $key => $value) {
            //variable de variable
            $$key = $value;
		}
        //replace en el caso de que no se encuentre el id, crea un registro. Si lo encuentra actualiza(todos los campos)
        $this->query = "REPLACE INTO permiso (id, codigo, descripcion,empresa_id) VALUES ($id, '$codigo','$descripcion',$empresa_id)";
         //llamo a set query para ejecutar el query. Esta definida en el modelo
		$this->set_query();
	}

	public function get( $permiso_id = '' ) {
		$this->query = ($permiso_id != '')
			?"SELECT * FROM permiso WHERE id = $permiso_id"
			:"SELECT * FROM permiso";
		
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

	public function del( $permiso_id = '' ) {
		$this->query = "DELETE FROM permiso WHERE id = $permiso_id";
		$this->set_query();
    }

    public function __destruct() {
		unset($this);
	}
}

?>