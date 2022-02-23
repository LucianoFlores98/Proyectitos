<?php

class PersonaModelo extends Modelo{

    public function set( $persona_data = array() ) {
		foreach ($persona_data as $key => $value) {
            //variable de variable
            $$key = $value;
		}
        //replace en el caso de que no se encuentre el id, crea un registro. Si lo encuentra actualiza(todos los campos)
        $this->query = "REPLACE INTO persona (id, cuil, apellido,nombres,empresa_id) VALUES ($id, '$cuil','$apellido','$nombres',$empresa_id)";
         //llamo a set query para ejecutar el query. Esta definida en el modelo
		$this->set_query();
	}

	public function get( $persona_id = '' ) {
		$this->query = ($persona_id != '')
			?"SELECT * FROM persona WHERE id = $persona_id"
			:"SELECT * FROM persona";
		
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

	public function del( $persona_id = '' ) {
		$this->query = "DELETE FROM persona WHERE id = $persona_id";
		$this->set_query();
    }

    public function __destruct() {
		unset($this);
	}
}

?>