<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__).'/../../Clases/ConectorBD.php';
require_once dirname(__FILE__).'/../../Clases/Contactos.php';
foreach ($_POST as $Variable => $Valor) ${$Variable}=$Valor;
foreach ($_GET as $Variable => $Valor) ${$Variable}=$Valor;

switch ($accion){
    case 'Adicionar':
    $servis=new Contactos(null, null);
        $servis->setNombres($nombres);
        $servis->setTelefono($telefono);
        $servis->setCorreo($correo);
        $servis->setAsunto($asunto);
        $servis->setNumpersonas($numpersonas);
        $servis->setIdservicio($idservicio);
        $servis->setMensaje($mensaje);
        $servis->setEstado('P');
        $servis->setFecha('now()');
        $servis->grabar();
        break;
}


?>
<script>
    //location = 'index.php';
</script>
