<?php
class Multimedia {
    private $id;
    private $foto;
    private $idservicio;
    private $iduser;
    private $estado;
    
    function __construct($campo, $valor) {
        if ($campo != null) {
            if (is_array($campo))
                $this->cargarobjetoDeVector($campo);
            else {
                $cadenaSQL = "select *from multimedia where $campo=$valor";
                $resultados = ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultados) > 0)
                    $this->cargarobjetoDeVector($resultados[0]);
                
            }
        }
    }
    private function cargarobjetoDeVector($vector){
        $this->id= $vector['id'];
        $this->foto = $vector['foto'];
        $this->idservicio = $vector['idservicio'];
        $this->iduser = $vector['iduser'];
        $this->estado = $vector['estado'];
}
function getServicioFin() {
        return new Servicio('id', $this->idservicio);
    }
function getId() {
    return $this->id;
}

function getFoto() {
    return $this->foto;
}

function getIdservicio() {
    return $this->idservicio;
}

function getIduser() {
    return $this->iduser;
}

function getEstado() {
    return $this->estado;
}

function setId($id) {
    $this->id = $id;
}

function setFoto($foto) {
    $this->foto = $foto;
}

function setIdservicio($idservicio) {
    $this->idservicio = $idservicio;
}

function setIduser($iduser) {
    $this->iduser = $iduser;
}

function setEstado($estado) {
    $this->estado = $estado;
}

public function grabar() {
        $cadenaSQL = "insert into multimedia(foto, idservicio, iduser, estado)  values ('$this->foto','$this->idservicio','$this->iduser','$this->estado')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
        print_r($cadenaSQL);
    }

    public function modificar() {
        $cadenaSQL = "update multimedia set foto ='{$this->foto}',idservicio='$this->idservicio',iduser='$this->iduser',estado='$this->estado' where id = $this->id";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
        print_r($cadenaSQL);
    }

    public function eliminar() {
        $cadenaSQL = "delete from multimedia where id = $this->id";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    public static function getDatos($filtro) {
        if ($filtro != null)
            $filtro = " where $filtro ";
        $cadenaSQL = "select * from multimedia $filtro ";
        return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
     public static function getDatosEnObjetos($filtro) {
        $datos = Multimedia::getDatos($filtro);
        $multi= array();
        for ($i = 0; $i < count($datos); $i++) {
            $multi[$i] = new Multimedia($datos[$i], null);
        } return $multi;
    }
}