<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Genero
 *
 * @author edwin
 */
class Genero {
    //put your code here
    private $idgenero;
	private $genero;
	
	public function __construct($campo, $valor) {
		if($campo!=null) {
			if(is_array($campo)) {
				foreach ($campo as $key => $value) $this->$key = $value;
			} else {
				$cadenaSQL = "select idgenero, genero from genero where $campo= '$valor'";
				$resultado = ConectorBD::ejecutarQuery($cadenaSQL, null);
				if(count($resultado)>0) {
					foreach ($resultado[0] as $key => $value) $this->$key = $value;
				}
			}
		}
	}
	
	function getIdgenero() {
            return $this->idgenero;
        }

        function getGenero() {
            return $this->genero;
        }

        function setIdgenero($idgenero) {
            $this->idgenero = $idgenero;
        }

        function setGenero($genero) {
            $this->genero = $genero;
        }

        	
	public function grabar() {
		$cadenaSQL = "insert into genero(genero)  values ('$this->genero')";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
	}
	
	public function modificar() {
		$cadenaSQL = "update genero set genero = '$this->genero' where idgenero = $this->idgenero";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
	}
	
	public function eliminar() {
		$cadenaSQL = "delete from genero where idgenero = $this->idgenero";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
	}
	
	public static function getDatos($filtro) {
		if($filtro!=null) $filtro = " where $filtro";
		$cadenaSQL = "select idgenero, genero from genero $filtro";
		return ConectorBD::ejecutarQuery($cadenaSQL, null);
	}
	
	public static function getDatosEnObjetos($filtro) {
		$datos = Genero::getDatos($filtro);
		$generos = array();
		for ($i = 0; $i < count($datos); $i++) {
			$generos[$i] = new Genero($datos[$i], null);
		} return $generos;
	}
	
	public static function getDatosEnOptions($predeterminado, $filtro){
		$lista = '';
		$datos = Genero::getDatosEnObjetos($filtro);
		for ($i = 0; $i < count($datos); $i++) {
			$seleccionado = '';
			if($datos[$i]->getIdgenero()==$predeterminado) $seleccionado = ' selected';
			$lista .= '<option value="'.$datos[$i]->getIdgenero().'"'.$seleccionado.'>'.$datos[$i]->getGenero().'</option>';
		} return $lista;
	}
}

