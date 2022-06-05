<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dependencia
 *
 * @author edwin
 */
class Dependencia {
    private $numeropresupuestal;
	private $nombre;
	private $descripcion;
	
	public function __construct($campo, $valor) {
		if($campo!=null) {
			if(is_array($campo)) {
				foreach ($campo as $key => $value) $this->$key = $value;
			} else {
				$cadenaSQL = "select numeropresupuestal, nombre,descripcion from dependencia where $campo = '$valor'";
				$resultado = ConectorBD::ejecutarQuery($cadenaSQL, null);
				if(count($resultado)>0) {
					foreach ($resultado[0] as $key => $value) $this->$key = $value;
				}
			}
		}
	}
	
	function getNumeropresupuestal() {
            return $this->numeropresupuestal;
        }

        function getNombre() {
            return $this->nombre;
        }

        function getDescripcion() {
            return $this->descripcion;
        }

        function setNumeropresupuestal($numeropresupuestal) {
            $this->numeropresupuestal = $numeropresupuestal;
        }

        function setNombre($nombre) {
            $this->nombre = $nombre;
        }

        function setDescripcion($descripcion) {
            $this->descripcion = $descripcion;
        }

                       	
	public function grabar() {
                $cadenaSQL = "insert into dependencia(numeropresupuestal, nombre, descripcion) values ('{$this->numeropresupuestal}','{$this->nombre}','{$this->descripcion}')";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
	}
	
	public function modificar($numeroA) {
                $cadenaSQL = "update dependencia set numeropresupuestal = '{$this->numeropresupuestal}',nombre='{$this->nombre}',descripcion='{$this->descripcion}' where numeropresupuestal = $numeroA";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
                print_r($cadenaSQL);
	}
	
	public function eliminar() {
		$cadenaSQL = "delete from dependencia where numeropresupuestal = $this->numeropresupuestal";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
                print_r($cadenaSQL);
	}
	
	public static function getDatos($filtro) {
		if($filtro!=null) $filtro = " where $filtro";
		$cadenaSQL = "select numeropresupuestal, nombre,descripcion  from dependencia $filtro";
		return ConectorBD::ejecutarQuery($cadenaSQL, null);
	}
	
	public static function getDatosEnObjetos($filtro) {
		$datos = Dependencia::getDatos($filtro);
		$dependencias = array();
		for ($J = 0; $J < count($datos); $J++) {
			$dependencias[$J] = new Dependencia($datos[$J], null);
		} return $dependencias;
	}
	
	public static function getDatosEnOptions($predeterminado, $filtro){
		$lista = '';
		$datos = Dependencia::getDatosEnObjetos($filtro);
		for ($i = 0; $i < count($datos); $i++) {
			$seleccionado = '';
			if($datos[$i]->getNumeropresupuestal()==$predeterminado) $seleccionado = ' selected';
			$lista .= '<option value="'.$datos[$i]->getNumeropresupuestal().'"'.$seleccionado.'>'.utf8_decode($datos[$i]->getNombre()).'</option>';
		} return $lista;
	}
	public static function getDatosEnOptions2($predeterminado, $filtro){
		$lista = '';
		$datos = Dependencia::getDatosEnObjetos($filtro);
		for ($i = 0; $i < count($datos); $i++) {
			$seleccionado = '';
			if($datos[$i]->getNombre()==$predeterminado) $seleccionado = ' selected';
			$lista .= '<option value="'.$datos[$i]->getNombre().'"'.$seleccionado.'>'.utf8_decode($datos[$i]->getNombre()).'</option>';
		} return $lista;
	}
}


