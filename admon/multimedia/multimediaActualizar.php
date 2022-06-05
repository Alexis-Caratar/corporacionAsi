<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__).'/../../Clases/ConectorBD.php';
require_once dirname(__FILE__).'/../../Clases/Multimedia.php';
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
    $multimedia=new Multimedia(null, null);
        $multimedia->setFoto($foto);
        $multimedia->setIdservicio($idservicio);
        $multimedia->setIduser($iduser);
        if($estado== 'on') $estado= 'X';
        $multimedia->setEstado($estado);
        $multimedia->grabar();
		print_r($multimedia);
        break;

    case 'Modificar':
    $multimedia=new Multimedia(null, null);
        $multimedia->setId($id);
        $fotoNombre = $foto;
        if($foto == "") $fotoNombre = $fotoUpdate;
        $multimedia->setFoto($fotoNombre);
        $multimedia->setIdservicio($idservicio);
        if($estado== 'on') $estado= 'X';
        $multimedia->setEstado($estado);
        $multimedia->modificar();
        print_r($multimedia);
        break;
    
    case 'Eliminar':
        $multimedia=new Multimedia(null, null);
        $multimedia->setId($id);
        $multimedia->eliminar();
        break;
        
}

header ("Location:principal2.php?CONTENIDO=admon/multimedia/multimedia.php&menu1={$menu1}");
?>
