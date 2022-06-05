<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menusis
 *
 * @author edwin
 */
class Menusis {
    private $idmenusis;
    private $menusis;
    private $link_menusis;
    private $idpadre;
    private $orden;
    private $icon;
    private $idhref;
    function __construct($campo, $valor) {
        if ($campo != null) {
            if (is_array($campo))
                $this->cargarobjetoDeVector($campo);
            else {
                $cadenaSQL = "select *from menusis where $campo=$valor";
                $resultados = ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultados) > 0)
                    $this->cargarobjetoDeVector($resultados[0]);
                
            }
        }
    }
    private function cargarobjetoDeVector($vector){
        $this->idmenusis= $vector['idmenusis'];
        $this->menusis= $vector['menusis'];
        $this->link_menusis= $vector['link_menusis'];
        $this->idpadre= $vector['idpadre'];
        $this->orden= $vector['orden'];
        $this->icon= $vector['icon'];
        $this->idhref= $vector['idhref'];
    }
    function getIdmenusis() {
        return $this->idmenusis;
    }

    function getMenusis() {
        return $this->menusis;
    }

    function getLink_menusis() {
        return $this->link_menusis;
    }

    function getIdpadre() {
        return $this->idpadre;
    }

    function getOrden() {
        return $this->orden;
    }

    function getIcon() {
        return $this->icon;
    }

    function setIdmenusis($idmenusis) {
        $this->idmenusis = $idmenusis;
    }

    function setMenusis($menusis) {
        $this->menusis = $menusis;
    }

    function setLink_menusis($link_menusis) {
        $this->link_menusis = $link_menusis;
    }

    function setIdpadre($idpadre) {
        $this->idpadre = $idpadre;
    }

    function setOrden($orden) {
        $this->orden = $orden;
    }

    function setIcon($icon) {
        $this->icon = $icon;
    }
    function getIdhref() {
        return $this->idhref;
    }

    function setIdhref($idhref) {
        $this->idhref = $idhref;
    }

        public function grabar() {
		$cadenaSQL = "insert into menusis(menusis, link_menusis, idpadre,orden, icon)  values ('$this->menusis','$this->link_menusis','$this->idpadre','$this->orden','$this->icon')";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
	}
	
	public function modificar() {
                $cadenaSQL = "update menusis set menusis ='{$this->menusis}',link_menusis='$this->link_menusis',idpadre='$this->idpadre',orden='$this->orden',icon='$this->icon' where idmenusis = $this->idmenusis";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
                print_r($cadenaSQL);
                
	}
	
	public function eliminar() {
		$cadenaSQL = "delete from menusis where idmenusis = $this->idmenusis";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
	}
	
	public static function getDatos($filtro) {
		if($filtro!=null) $filtro = " where $filtro";
		$cadenaSQL = "select * from menusis $filtro";
		return ConectorBD::ejecutarQuery($cadenaSQL, null);
	}
	
	public static function getDatosEnObjetos($filtro) {
		$datos = Menusis::getDatos($filtro);
		$menusiss = array();
		for ($i = 0; $i < count($datos); $i++) {
			$menusiss[$i] = new Menusis($datos[$i], null);
		} return $menusiss;
	}
	
	public static function getDatosEnOptions($predeterminado, $filtro){
		$lista = '';
		$datos = Menusis::getDatosEnObjetos($filtro);
		for ($i = 0; $i < count($datos); $i++) {
			$seleccionado = '';
			if($datos[$i]->getIdmenusis()==$predeterminado) $seleccionado = ' selected';
			$lista .= '<option value="'.$datos[$i]->getIdmenusis().'"'.$seleccionado.'>'.$datos[$i]->getMenusis().'</option>';
		} return $lista;
	}
}


