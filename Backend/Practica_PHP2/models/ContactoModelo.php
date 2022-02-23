<?php

class ContactoModelo extends PersonaModelo{

    public function set( $contacto_data = array() ) {
		foreach ($contacto_data as $key => $value) {
            //variable de variable
            $$key = $value;
		}
        //replace en el caso de que no se encuentre el id, crea un registro. Si lo encuentra actualiza(todos los campos)
        $this->query = "REPLACE INTO contacto (id, email, persona_id) VALUES ($id, '$email',$persona_id)";
         //llamo a set query para ejecutar el query. Esta definida en el modelo
		$this->set_query();
	}

	public function get( $contacto_id = '' ) {
		$this->query = ($contacto_id != '')
			?"SELECT * FROM contacto WHERE id = $contacto_id"
			:"SELECT * FROM contacto";
		
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

	public function del( $contacto_id = '' ) {
		$this->query = "DELETE FROM contacto WHERE id = $contacto_id";
		$this->set_query();
    }

    public function __destruct() {
		unset($this);
	}
}

?>