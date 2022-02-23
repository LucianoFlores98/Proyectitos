<?php

class EmpresaModelo extends Modelo{

    //recibe un array
	public function set( $empresa_data = array() ) {
		foreach ($empresa_data as $key => $value) {
            //variable de variable
            $$key = $value;
		}
        //replace en el caso de que no se encuentre el id, crea un registro. Si lo encuentra actualiza(todos los campos)
        $this->query = "REPLACE INTO empresa (id, nombre) VALUES ($id, '$nombre')";
         //llamo a set query para ejecutar el query. Esta definida en el modelo
		$this->set_query();
	}

	public function get( $empresa_id = '' ) {
		$this->query = ($empresa_id != '')
			?"SELECT * FROM empresa WHERE id = $empresa_id"
			:"SELECT * FROM empresa";
		
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

	public function del( $empresa_id = '' ) {
		$this->query = "DELETE FROM empresa WHERE id = $empresa_id";
		$this->set_query();
	}

	public function __destruct() {
		unset($this);
	}
}
?>