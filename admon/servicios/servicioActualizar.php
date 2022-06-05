<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__).'/../../Clases/ConectorBD.php';
require_once dirname(__FILE__).'/../../Clases/Servicio.php';
foreach ($_POST as $Variable => $Valor) ${$Variable}=$Valor;
foreach ($_GET as $Variable => $Valor) ${$Variable}=$Valor;

foreach ($_POST as $Variable => $Valor)
    ${$Variable}=$Valor;
foreach ($_GET as $Variable=> $Valor)
    ${$Variable}=$Valor;
   $foto= '';
if ($_FILES['foto']['name']!=null) {
    $extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $foto= 'IMG_'.date('Ymd_His').'.'.$extension;  
    move_uploaded_file($_FILES['foto']['tmp_name'], 'foto/'.$foto);
}
switch ($accion){
    case 'Adicionar':
    $servis=new Servicio(null, null);
        $servis->setNombre($nombre);
        $servis->setDescripcion($descripcion);
        $servis->setFoto($foto);
        if($estado_r== 'on') $estado_r= 'X';
        $servis->setEstado($estado_r);
        $servis->grabar();
		print_r($servis);
        break;

    case 'Modificar':
    $servis=new Servicio(null, null);
        $servis->setId($id);
        $servis->setNombre($nombre);
        $servis->setDescripcion($descripcion);
        $fotoNombre = $foto;
        if($foto == "") $fotoNombre = $fotoUpdate;
        $servis->setFoto($fotoNombre);
        if($estado_r== 'on') $estado_r= 'X';
        $servis->setEstado($estado_r);
        $servis->modificar();
        print_r($servis);
        break;
    
    case 'Eliminar':
        $servis=new Servicio(null, null);
        $servis->setId($id);
        $servis->eliminar();
        break;
        
}

header ("Location:principal2.php?CONTENIDO=admon/servicios/servicios.php&menu1={$menu1}");
?>
