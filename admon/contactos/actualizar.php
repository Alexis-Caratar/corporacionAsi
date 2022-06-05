<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../Clases/conectorBD.php';

foreach ($_POST as $Variable => $Valor)
    ${$Variable} = $Valor;
foreach ($_GET as $Variable => $Valor)
    ${$Variable} = $Valor;

if ($accion == '0') {
    $cadenasql = "update contactos set estado='P' where id={$id}";
    ConectorBD::ejecutarQuery($cadenasql, null);
}
if ($accion == '1') {
    $cadenasql = "update contactos set estado='R' where id={$id}";
    ConectorBD::ejecutarQuery($cadenasql, null);
}
$response = true;
header('Content-type: application/json; charset=utf-8');
echo $response;
exit();
//header("Location:principal.php?CONTENIDO=admon/ControlSalida/controlSalida.php&idregistroequipo=$idregistroequipo&placa={$placa}&nombre={$nombre}&claseVehiculo={$claseVehiculo}&serial={$serial}&autorizado_por{$autorizado_por}");
?>
