<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__).'/../../Clases/Usuario.php';
require_once dirname(__FILE__).'/../../Clases/Genero.php';
require_once dirname(__FILE__).'/../../Clases/ConectorBD.php';
foreach ($_POST as $Variable => $Valor) ${$Variable}=$Valor;
foreach ($_GET as $Variable => $Valor) ${$Variable}=$Valor;

$foto = '';
if ($_FILES['foto']['name']!=null) {
    $extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $foto = 'IMG_'.date('Ymd_His').'.'.$extension;  
    move_uploaded_file($_FILES['foto']['tmp_name'], 'foto/'.$foto);
}
switch ($accion){
    case 'Adicionar':
        $usuario1=new Usuario(null, null);
        $usuario1->setIdentificacion($identificacion);
        $usuario1->setNombres($nombres);
        $usuario1->setApellidos($apellidos);
        $usuario1->setGenero($genero);
        $usuario1->setDireccion($direccion);
        $usuario1->setTelefono($telefono);
        $usuario1->setUsuario($usuario);
        $usuario1->setClave($clave);
        $usuario1->setFoto($foto);
        $usuario1->setTipo('A');
        $usuario1->setRol($rol);
        $usuario1->grabar();
        
        break;
        
     case 'Modificar':
        $usuario1=new Usuario('identificacion',$identificacion);
         if($foto==null) $foto = $usuario1->getFoto();
        $usuario1->setIdentificacion($identificacion);
        $usuario1->setNombres($nombres);
        $usuario1->setApellidos($apellidos);
        $usuario1->setGenero($genero);
        $usuario1->setDireccion($direccion);
        $usuario1->setTelefono($telefono);
        $usuario1->setUsuario($usuario);
        $usuario1->setClave($clave);
        $usuario1->setFoto($foto);
        if($foto == "") $fotoNombre = $fotoUpdate;
        $servis->setFoto($fotoNombre);
        $usuario1->setTipo('A');
        $usuario1->setRol($rol);
        $usuario1->modificar($Aidentificacion);
        break;
        
    case 'Eliminar':
         $usuario1=new Usuario('identificacion',$identificacion);
        $usuario1->setIdentificacion($identificacion);
        $usuario1->eliminar();
        break;
    case 'Cambiar contraseña':
        $cadenaSQL="update usuario set clave=md5('{$clave}') where identificacion='{$valor}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
        print_r($cadenaSQL);
        break;
        
}
header ("Location: principal2.php?CONTENIDO=admon/usuario/usuarioFinal.php&menu1={$menu1}");
?>
