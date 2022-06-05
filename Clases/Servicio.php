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
class Servicio{
    private $id;
	private $nombre;
	private $descripcion;
	private $foto;
	private $estado;
	
	public function __construct($campo, $valor) {
		if($campo!=null) {
			if(is_array($campo)) {
				foreach ($campo as $key => $value) $this->$key = $value;
			} else {
				$cadenaSQL = "select * from servicio where $campo = '$valor'";
				$resultado = ConectorBD::ejecutarQuery($cadenaSQL, null);
				if(count($resultado)>0) {
					foreach ($resultado[0] as $key => $value) $this->$key = $value;
				}
			}
		}
	}
	
	function getId() {
            return $this->id;
        }

        function getNombre() {
            return $this->nombre;
        }

        function getDescripcion() {
            return $this->descripcion;
        }

        function getFoto() {
            return $this->foto;
        }

        function getEstado() {
            return $this->estado;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setNombre($nombre) {
            $this->nombre = $nombre;
        }

        function setDescripcion($descripcion) {
            $this->descripcion = $descripcion;
        }

        function setFoto($foto) {
            $this->foto = $foto;
        }

        function setEstado($estado) {
            $this->estado = $estado;
        }

        
	public function grabar() {
                $cadenaSQL = "insert into servicio(nombre, descripcion,foto, estado) values ('{$this->nombre}','{$this->descripcion}','{$this->foto}','$this->estado')";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
	}
	
	public function modificar() {
                $cadenaSQL = "update servicio set nombre='{$this->nombre}',descripcion='{$this->descripcion}', foto='{$this->foto}',estado='{$this->estado}' where id = $this->id";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
                print_r($cadenaSQL);
	}
	
	public function eliminar() {
		$cadenaSQL = "delete from servicio where id = $this->id";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
                print_r($cadenaSQL);
	}
	
	public static function getDatos($filtro) {
		if($filtro!=null) $filtro = " where $filtro";
		$cadenaSQL = "select * from servicio $filtro";
		return ConectorBD::ejecutarQuery($cadenaSQL, null);
	}
	
	public static function getDatosEnObjetos($filtro) {
		$datos = Servicio::getDatos($filtro);
		$servicio = array();
		for ($J = 0; $J < count($datos); $J++) {
			$servicio[$J] = new Servicio($datos[$J], null);
		} return $servicio;
	}
	
	public static function getDatosEnOptions($predeterminado, $filtro){
		$lista = '';
		$datos = Servicio::getDatosEnObjetos($filtro);
		for ($i = 0; $i < count($datos); $i++) {
			$seleccionado = '';
			if($datos[$i]->getId()==$predeterminado) $seleccionado = ' selected';
			$lista .= '<option value="'.$datos[$i]->getId().'"'.$seleccionado.'>'.utf8_decode($datos[$i]->getNombre()).'</option>';
		} return $lista;
	}
	
}


