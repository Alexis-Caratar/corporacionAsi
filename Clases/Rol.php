<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Clasevehiculo
 *
 * @author edwin
 */
class Rol{
    //put your code here
    private $idrol;
    private $rol;
    private $descripcion;
    private $estado_r;
    function __construct($campo, $valor) {
        if ($campo != null) {
            if (is_array($campo))
                $this->cargarobjetoDeVector($campo);
            else {
                $cadenaSQL = "select *from rol where $campo='$valor'";
                $resultados = ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultados) > 0)
                    $this->cargarobjetoDeVector($resultados[0]);
                
            }
        }
    }
    private function cargarobjetoDeVector($vector){
        $this->idrol= $vector['idrol'];
        $this->rol= $vector['rol'];
        $this->descripcion= $vector['descripcion'];
        $this->estado_r= $vector['estado_r'];
}
function getIdrol() {
    return $this->idrol;
}

function getRol() {
    return $this->rol;
}

function getDescripcion() {
    return $this->descripcion;
}

function getEstado_r() {
    return $this->estado_r;
}

function setIdrol($idrol) {
    $this->idrol = $idrol;
}

function setRol($rol) {
    $this->rol = $rol;
}

function setDescripcion($descripcion) {
    $this->descripcion = $descripcion;
}

function setEstado_r($estado_r) {
    $this->estado_r = $estado_r;
}


public function grabar() {
		$cadenaSQL = "insert into rol(rol,descripcion,estado_r)  values ('$this->rol','$this->descripcion','$this->estado_r')";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
                print_r($cadenaSQL);
	}
	
	public function modificar() {
		$cadenaSQL = "update rol set rol ='$this->rol',descripcion='$this->descripcion',estado_r='$this->estado_r' where idrol = $this->idrol";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
        
                
	}
	
	public function eliminar() {
		$cadenaSQL = "delete from rol where idrol=$this->idrol";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
                
	}
	
	public static function getDatos($filtro) {
		if($filtro!=null) $filtro = " where $filtro";
		$cadenaSQL = "select * from rol $filtro";
		return ConectorBD::ejecutarQuery($cadenaSQL, null);
	}
	
	public static function getDatosEnObjetos($filtro) {
		$datos = Rol::getDatos($filtro);
		$impuestos = array();
		for ($i = 0; $i < count($datos); $i++) {
			$impuestos[$i] = new Rol($datos[$i], null);
		} return $impuestos;
	}
	
	public static function getDatosEnOptions($predeterminado, $filtro){
		$lista = '';
		$datos = Rol::getDatosEnObjetos($filtro);
		for ($i = 0; $i < count($datos); $i++) {
			$seleccionado = '';
			if($datos[$i]->getIdrol()==$predeterminado) $seleccionado = ' selected';
			$lista .= '<option value="'.$datos[$i]->getIdrol().'"'.$seleccionado.'>'.$datos[$i]->getRol().'</option>';
		
                        
                } return $lista;
	}
}


