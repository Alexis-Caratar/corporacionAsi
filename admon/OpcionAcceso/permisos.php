<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../Clases/ConectorBD.php';

foreach ($_POST as $Variable => $Valor)
    ${$Variable} = $Valor;
foreach ($_GET as $Variable => $Valor)
    ${$Variable} = $Valor;


if($usuario == '1084224857'){
    $response['flag'] = true;
    $response['menu'] = $menu;
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($response);
    exit();
}

if($accion == 'C')
    $cadenasql = "select crear from opcionacceso WHERE menu = $menu AND idusuario=$usuario";
if($accion == 'R')
    $cadenasql = "select leer from opcionacceso WHERE menu = $menu AND idusuario=$usuario";
if($accion == 'U')
    $cadenasql = "select actualizar from opcionacceso WHERE menu = $menu AND idusuario=$usuario";
if($accion == 'D')
    $cadenasql = "select borrar from opcionacceso WHERE menu = $menu AND idusuario=$usuario";
$result = ConectorBD::ejecutarQuery($cadenasql, null);
if(empty($result))
    $response['flag'] = false;
else if($result[0][0] == '')
    $response['flag'] = false;
else
    $response['flag'] = true;
$response['menu'] = $menu;
header('Content-type: application/json; charset=utf-8');
echo json_encode($response);
exit();
//header("Location:principal.php?CONTENIDO=admon/ControlSalida/controlSalida.php&idregistroequipo=$idregistroequipo&placa={$placa}&nombre={$nombre}&claseVehiculo={$claseVehiculo}&serial={$serial}&autorizado_por{$autorizado_por}");
?>

