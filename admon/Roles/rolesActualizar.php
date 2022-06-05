<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__).'/../../Clases/ConectorBD.php';
require_once dirname(__FILE__).'/../../Clases/Rol.php';
foreach ($_POST as $Variable => $Valor) ${$Variable}=$Valor;
foreach ($_GET as $Variable => $Valor) ${$Variable}=$Valor;

foreach ($_POST as $Variable => $Valor)
    ${$Variable}=$Valor;
foreach ($_GET as $Variable=> $Valor)
    ${$Variable}=$Valor;
    
switch ($accion){
    case 'Adicionar':
    $rolesA=new Rol(null, null);
        $rolesA->setIdrol($idrol);
        $rolesA->setRol($rol);
        $rolesA->setDescripcion($descripcion);
        if($estado_r== 'on') $estado_r= 'X';
        $rolesA->setEstado_r($estado_r);
        $rolesA->grabar();
        print_r($rolesA);
        break;

    case 'Modificar':
    $rolesA=new Rol(null, null);
        $rolesA->setIdrol($idrol);
        $rolesA->setRol($rol);
        $rolesA->setDescripcion($descripcion);
        if($estado_r== 'on') $estado_r= 'X';
        $rolesA->setEstado_r($estado_r);
        $rolesA->modificar();
        
        break;
    
    case 'Eliminar':
        $rolesA=new Rol(null, null);
        $rolesA->setIdrol($idrol);
        $rolesA->eliminar();
        break;
        
}

header ("Location:principal2.php?CONTENIDO=admon/Roles/roles.php&menu1={$menu1}");
?>
