<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
  {* and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../Clases/Usuario.php';
require_once dirname(__FILE__) . '/../Clases/Rol.php';
//require_once dirname(__FILE__) . '/../Clases/MenuSis.php';
require_once dirname(__FILE__) . '/../Clases/ConectorBD.php';


$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$lista='';
$datos= Rol::getDatosEnObjetos('idrol', null);
for ($i = 0; $i < count($datos); $i++) {
    $roles= $datos[$i];
    
}
$cadena = "select * from usuario where usuario='$usuario' and clave=md5('$clave')";

$res = ConectorBD:: ejecutarQuery($cadena, null);

if ($res[0][9] == 'A') {
    if (count($res) > 0) {
        session_start();
        $usuario = new Usuario('usuario', $usuario);
        $_SESSION['usuario'] = serialize($usuario);
        header('Location:../principal2.php?CONTENIDO=inicio.php');
    } else {
        $mensaje = 'usuario y/o contraseña no valida ';
        header("Location: ../index.php?mensaje=$mensaje");
    }
    
} else {
    if ($res[0][9] == 'P') {
        session_start();
        $usuario = new Usuario('usuario', $usuario);
        $_SESSION['usuario'] = serialize($usuario);
		
        header('Location:../principal2.php?CONTENIDO=inicio.php');
    } else {
        $mensaje = 'usuario y/o contraseña no valida ';
        header("Location: ../index.php?mensaje=$mensaje");
    }
}
?>
