<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OpcionAcceso
 *
 * @author edwin
 */
class OpcionAcceso {

    private $idperfil;
    private $idusuario;
    private $menu;
    private $crear;
    private $leer;
    private $actualizar;
    private $borrar;
    private $estado;

    function __construct($campo, $valor) {
        if ($campo != null) {
            if (is_array($campo))
                $this->cargarobjetoDeVector($campo);
            else {
                $cadenaSQL = "select * from opcionacceso where $campo='$valor'";
                $resultados = ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultados) > 0)
                    $this->cargarobjetoDeVector($resultados[0]);
            }
        }
    }

    private function cargarobjetoDeVector($vector) {
        $this->idperfil = $vector['idperfil'];
        $this->idusuario = $vector['idusuario'];
        $this->menu = $vector['menu'];
        $this->crear = $vector['crear'];
        $this->leer = $vector['leer'];
        $this->actualizar = $vector['actualizar'];
        $this->borrar = $vector['borrar'];
        $this->estado = $vector['estado'];
    }

    function getRolFin() {
        return new Rol('idrol', $this->idusuario);
    }

    function getMenuFin() {
        return new Menusis('idmenusis', $this->menu);
    }
    
    

    function getIdperfil() {
        return $this->idperfil;
    }

    function getIdusuario() {
        return $this->idusuario;
    }
    function getIdusuarioFin() {
        return new Usuario('identificacion', $this->idusuario);
    }

    function getMenu() {
        return $this->menu;
    }

    function getCrear() {
        return $this->crear;
    }

    function getLeer() {
        return $this->leer;
    }

    function getActualizar() {
        return $this->actualizar;
    }

    function getBorrar() {
        return $this->borrar;
    }

    function getEstado() {
        return $this->estado;
    }

    function setIdperfil($idperfil) {
        $this->idperfil = $idperfil;
    }

    function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    function setMenu($menu) {
        $this->menu = $menu;
    }

    function setCrear($crear) {
        $this->crear = $crear;
    }

    function setLeer($leer) {
        $this->leer = $leer;
    }

    function setActualizar($actualizar) {
        $this->actualizar = $actualizar;
    }

    function setBorrar($borrar) {
        $this->borrar = $borrar;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

        public static function getLista($filtro) {
        if ($filtro != null)
            $filtro = " and $filtro";
        $cadenaSQL = "select identificacion from usuario where  $filtro" ;
        return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public function grabar() {
        $cadenaSQL = "insert into opcionacceso (idusuario, menu, crear, leer, actualizar,borrar,estado)  values ('$this->idusuario','$this->menu','$this->crear','$this->leer','$this->actualizar','$this->borrar','$this->estado')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
        print_r($cadenaSQL);
    }

    public function modificar() {
        $cadenaSQL = "update opcionacceso set idusuario ='{$this->idusuario}',menu='$this->menu',crear='$this->crear',leer='$this->leer',actualizar='$this->actualizar',borrar='$this->borrar',estado='$this->estado' where idperfil = $this->idperfil";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
        print_r($cadenaSQL);
    }

    public function eliminar() {
        $cadenaSQL = "delete from opcionacceso  where idperfil = $this->idperfil";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    public static function getDatos($filtro) {
        if ($filtro != null)
            $filtro = " where $filtro ";
        $cadenaSQL = "select * from opcionacceso $filtro ";
        return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    public static function getDatosEnObjetos($filtro) {
        $datos = OpcionAcceso::getDatos($filtro);
        $idusuarios = array();
        for ($i = 0; $i < count($datos); $i++) {
            $idusuarios[$i] = new OpcionAcceso($datos[$i], null);
        } return $idusuarios;
    }

    public static function getDatosEnOptions($predeterminado, $filtro) {
        $lista = '';
        $datos = OpcionAcceso::getDatosEnObjetos($filtro);
        for ($i = 0; $i < count($datos); $i++) {
            $seleccionado = '';
            if ($datos[$i]->getIdperfil() == $predeterminado)
                $seleccionado = ' selected';
            $lista .= '<option value="' . $datos[$i]->getIdperfil() . '"' . $seleccionado . '>' . $datos[$i]->getMenu() . '</option>';
        } return $lista;
    }

}
