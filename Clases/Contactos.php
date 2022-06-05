<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contactos
 *
 * @author edwin
 */
class Contactos {
  private $id;
  private $nombres;
    private $telefono;
    private $correo;
    private $asunto;
    private $numpersonas;
    private $idservicio;
    private $mensaje;
    private $estado;
    private $fecha;
    
    function __construct($campo, $valor) {
        if ($campo != null) {
            if (is_array($campo))
                $this->cargarobjetoDeVector($campo);
            else {
                $cadenaSQL = "select *from contactos where $campo=$valor";
                $resultados = ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultados) > 0)
                    $this->cargarobjetoDeVector($resultados[0]);
                
            }
        }
    }
    private function cargarobjetoDeVector($vector){
        $this->id= $vector['id'];
        $this->nombres= $vector['nombres'];
        $this->telefono= $vector['telefono'];
        $this->correo= $vector['correo'];
        $this->asunto= $vector['asunto'];
        $this->numpersonas= $vector['numpersonas'];
        $this->idservicio= $vector['idservicio'];
        $this->mensaje= $vector['mensaje'];
        $this->estado= $vector['estado'];
        $this->fecha= $vector['fecha'];
    }
    function getServicioFin() {
        return new Servicio('id', $this->idservicio);
    }
    function getId() {
        return $this->id;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getAsunto() {
        return $this->asunto;
    }

    function getNumpersonas() {
        return $this->numpersonas;
    }

    function getIdservicio() {
        return $this->idservicio;
    }

    function getMensaje() {
        return $this->mensaje;
    }

    function getEstado() {
        return $this->estado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setAsunto($asunto) {
        $this->asunto = $asunto;
    }

    function setNumpersonas($numpersonas) {
        $this->numpersonas = $numpersonas;
    }

    function setIdservicio($idservicio) {
        $this->idservicio = $idservicio;
    }

    function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }
    function getFecha() {
        return $this->fecha;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

        public function grabar() {
		$cadenaSQL = "insert into contactos (nombres,telefono,correo,asunto,numpersonas,idservicio,mensaje,estado,fecha)  values ('$this->nombres','$this->telefono','$this->correo','$this->asunto','$this->numpersonas','$this->idservicio','$this->mensaje','$this->estado',$this->fecha)";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
                
                
	}
	
	public function modificar() {
		$cadenaSQL = "update contactos set nombres= '$this->nombres',telefono='$this->telefono',correo='$this->correo',asunto='$this->asunto',numpersonas='$this->numpersonas',idservicio='$this->idservicio','mensaje=$this->mensaje',estado='$this->estado',fecha=$this->fecha where id= $this->id";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
	}
	
	public function eliminar() {
		$cadenaSQL = "delete from contactos where id= $this->id";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
	}
	
	public static function getDatos($filtro) {
		if($filtro!=null) $filtro = " where $filtro";
		$cadenaSQL = "select * from contactos $filtro";
		return ConectorBD::ejecutarQuery($cadenaSQL, null);
	}
	
	public static function getDatosEnObjetos($filtro) {
		$datos = Contactos::getDatos($filtro);
		$contac= array();
		for ($i = 0; $i < count($datos); $i++) {
			$contac[$i] = new Contactos($datos[$i], null);
		} return $contac;
	}
	
}