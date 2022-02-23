<?php

class EmpleadoModelo extends PersonaModelo{

    public function set( $empleado_data = array() ) {
		foreach ($empleado_data as $key => $value) {
            //variable de variable
            $$key = $value;
		}
        //replace en el caso de que no se encuentre el id, crea un registro. Si lo encuentra actualiza(todos los campos)
        $this->query = "REPLACE INTO empleado (id, nroLegajo, dependencia,fechaIngreso,persona_id) VALUES ($id, '$nroLegajo','$dependencia','$fechaIngreso',$persona_id)";
         //llamo a set query para ejecutar el query. Esta definida en el modelo
		$this->set_query();
	}

	public function get( $empleado_id = '' ) {
		$this->query = ($empleado_id != '')
			?"SELECT * FROM empleado WHERE id = $empleado_id"
			:"SELECT * FROM empleado";
		
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

	public function del( $empleado_id = '' ) {
		$this->query = "DELETE FROM empleado WHERE id = $empleado_id";
		$this->set_query();
    }

    public function __destruct() {
		unset($this);
	}
}

?>