<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__).'/../../Clases/Dependencia.php';
require_once dirname(__FILE__).'/../../Clases/ConectorBD.php';

foreach ($_POST as $Variable => $Valor)
    ${$Variable}=$Valor;
foreach ($_GET as $Variable=> $Valor)
    ${$Variable}=$Valor;
    
switch ($accion){
    case 'Adicionar':
    $disponibilidad =new Dependencia(null, null);
         $disponibilidad->setNumeropresupuestal($numeropresupuestal);
        $disponibilidad->setNombre($nombre);
        $disponibilidad->setDescripcion($descripcion);
        $disponibilidad->grabar();
        break;
        

    case 'Modificar':
    $disponibilidad =new Dependencia(null, null);
        $disponibilidad->setNumeropresupuestal($numeropresupuestal);
        $disponibilidad->setNombre($nombre);
        $disponibilidad->setDescripcion($descripcion);
        $disponibilidad->modificar($numeroA);
        break;
    
    case 'Eliminar':
        $disponibilidad =new Dependencia(null, null);
        $disponibilidad->setNumeropresupuestal($numeropresupuestal);
        $disponibilidad->eliminar();
        break;
}
 header ("Location: principal2.php?CONTENIDO=admon/Dependencia/dependencia.php&menu1={$menu1}");
?>


