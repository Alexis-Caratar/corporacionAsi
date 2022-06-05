<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../Clases/OpcionAcceso.php';
require_once dirname(__FILE__) . '/../../Clases/MenuSis.php';
require_once dirname(__FILE__) . '/../../Clases/Rol.php';
require_once dirname(__FILE__) . '/../../Clases/ConectorBD.php';;
foreach ($_GET as $Variable => $Valor)
    ${$Variable} = $Valor;
foreach ($_POST as $Variable => $Valor)
    ${$Variable} = $Valor;
print_r($Variable);
switch ($accion) {
    case 'Adicionar':
        $herramientas = new OpcionAcceso(null, null);
        $herramientas->setIdperfil($idperfil);
        $herramientas->setIdusuario($idusuario);
        $herramientas->setMenu($menu);
        if($crear== 'on') $crear= 'X';
        $herramientas->setCrear($crear);
        if($leer== 'on') $leer= 'X';
        $herramientas->setLeer($leer);
        if($actualizar== 'on') $actualizar= 'X';
        $herramientas->setActualizar($actualizar);
        if($borrar== 'on') $borrar= 'X';
        $herramientas->setBorrar($borrar);
        if($estado== 'X') $estado= 'X';
        $herramientas->setEstado($estado);
        $herramientas->grabar();
        print_r($herramientas);
        break;

    case 'Modificar':
        $herramientas = new OpcionAcceso('idperfil', $idperfil);
        $herramientas->setIdperfil($idperfil);
        $herramientas->setIdusuario($idusuario);
        $herramientas->setMenu($menu);
        if($crear== 'on') $crear= 'X';
        $herramientas->setCrear($crear);
        if($leer== 'on') $leer= 'X';
        $herramientas->setLeer($leer);
        if($actualizar== 'on') $actualizar= 'X';
        $herramientas->setActualizar($actualizar);
        if($borrar== 'on') $borrar= 'X';
        $herramientas->setBorrar($borrar);
        
        
        $herramientas->modificar();
        break;

    case 'Eliminar':
        $herramientas = new OpcionAcceso(null, null);
        $herramientas->setIdperfil($idperfil);
        $herramientas->eliminar();
        print_r($herramientas);
        break;
}

header ("Location:principal2.php?CONTENIDO=admon/OpcionAcceso/opcionacceso.php&identificacion={$idusuario}&n_user={$n_user}&menu1={$menu1}");
?>
    
