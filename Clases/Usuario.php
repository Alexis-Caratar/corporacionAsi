<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author edwin
 */
require_once dirname(__FILE__) .'/ConectorBD.php' ;

    class Usuario {
    //put your code here
    
    private $identificacion;
    private $nombres;
    private $apellidos;
    private $genero;
    private $direccion;
    private $telefono;
    private $usuario;
    private $clave;
    private $foto;
    private $tipo;
    private $rol;
    
    
    function __construct($campo, $valor) {
        if ($campo != null) {
            if (is_array($campo))
                $this->cargarobjetoDeVector($campo);
            else {
                $cadenaSQL = "select identificacion, nombres, apellidos, genero, direccion, telefono, usuario, clave, foto, tipo, rol from usuario where $campo='$valor'";
                $resultados = ConectorBD::ejecutarQuery($cadenaSQL, null);
                
                if (count($resultados) > 0)
                    $this->cargarobjetoDeVector($resultados[0]);
            }
        }
    }
    private function cargarobjetoDeVector($vector){
        $this->identificacion = $vector['identificacion'];
        $this->nombres = $vector['nombres'];
        $this->apellidos = $vector['apellidos'];
        $this->genero=$vector['genero'];
        $this->direccion=$vector['direccion'];
        $this->telefono=$vector['telefono'];
        $this->usuario=$vector['usuario'];
        $this->clave=$vector['clave'];
        $this->foto=$vector['foto'];
        $this->tipo=$vector['tipo'];
        $this->rol=$vector['rol'];
        
    }
    

    function getIdentificacion() {
        return $this->identificacion;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getApellidos() {
        return $this->apellidos;
    }
//para enviar el idgenero
    function getGenero() {
        return new Genero('genero', $this->genero );
       
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getClave() {
        return $this->clave;
    }

    function getFoto() {
        return $this->foto;
    }

    function getTipo() {
        return $this->tipo;
    }

    
    function setIdentificacion($identificacion) {
        $this->identificacion = $identificacion;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setGenero($genero) {
        $this->genero = $genero;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

        function __toString() {
        return $this->nombres.' '.$this->apellidos;
    }
    function getNombresCompletos(){
        return  $this->nombres.' '.$this->apellidos;
    }
    function getRol() {
        return $this->rol;
    }
    function getRolFin() {
        return new Rol('idrol', $this->rol);
    }

    function setRol($rol) {
        $this->rol = $rol;
    }

    public function grabar(){
      $cadenaSQL="insert into usuario (identificacion,nombres,apellidos,genero,direccion,telefono,usuario,clave,foto,tipo, rol) values('{$this->identificacion}','{$this->nombres}','{$this->apellidos}','{$this->genero}','{$this->direccion}','{$this->telefono}','{$this->usuario}', md5('{$this->clave}'), '{$this->foto}','{$this->tipo}','$this->rol')";
      ConectorBD::ejecutarQuery($cadenaSQL, null);
     
     
    }
    public function modificar($Aidentificacion){
      $cadenaSQL="update usuario set identificacion='{$this->identificacion}',nombres='{$this->nombres}',apellidos='{$this->apellidos}',genero='{$this->genero}',direccion='{$this->direccion}',telefono='{$this->telefono}', usuario='$this->usuario',foto='{$this->foto}',tipo='{$this->tipo}',rol='$this->rol' where identificacion='{$Aidentificacion}'";
      ConectorBD::ejecutarQuery($cadenaSQL, null);
      
    }
    public function eliminar(){
      $cadenaSQL="delete from usuario where identificacion='{$this->identificacion}'";
      ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
     public static function getDatos($filtro){
       if($filtro!=null) $filtro = " where $filtro ";
		$cadenaSQL = "select identificacion, nombres, apellidos, genero, direccion, telefono, usuario, clave, foto, tipo, rol from usuario $filtro";
//                if($filtro=="tipo='A'"){
//            }
//                if($filtro=="tipo='U'"){
//            }
                return ConectorBD::ejecutarQuery($cadenaSQL, null);
     }
     
    public static function getDatosEnObjetos($filtro){
            $datos = Usuario::getDatos($filtro);
            $listaUsuario = array();
            for ($i = 0; $i < count($datos); $i++) {
                $usuario=new Usuario($datos[$i], null);
                $listaUsuario[$i]=$usuario;
            }
            return $listaUsuario;
        }
  public static function validar($usuario, $clave){
        $valido=false;
        $usuario=new Usuario('usuario', "'$usuario'");
        if ($usuario->getUsuario()!=null){
            if ($usuario->getClave()==$clave)
                $valido=true;
        }
        return $valido;
  }


   public static function getListaEnOptions($predeterminado, $filtro, $orden) {
        $datos = Usuario::getDatosEnObjetos($filtro, $orden);
        $auxiliar = '';
        $lista = '';
        for ($i = 0; $i < count($datos); $i++) {
            if ($datos[$i]->getIdentificacion() == $predeterminado)
                $auxiliar = ' selected';
            else
                $auxiliar = '';
            $lista .= '<option value="' . $datos[$i]->getIdentificacion() . '"' . $auxiliar . '>' . $datos[$i]->getNombresCompletos().'</option>';
        }
        return $lista;
    }
    }