<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../Clases/Multimedia.php';
require_once dirname(__FILE__) . '/../../Clases/Servicio.php';
require_once dirname(__FILE__) . '/../../Clases/ConectorBD.php';
foreach ($_GET as $Variable => $Valor) {
    ${$Variable} = $Valor;
}
foreach ($_POST as $Variable => $Valor) {
    ${$Variable} = $Valor;
}
$lista = '';
$serial = 1;
$datos = Multimedia::getDatosEnObjetos(null, 'id');
if (count($datos) > 0) {
    for ($i = 0; $i < count($datos); $i++) {
        $multimedia= $datos[$i];
        if(trim($multimedia->getFoto())!=null) 
        $foto2 = $multimedia->getFoto();
        //$lista .= '<tr class="gradeC">';
        //$lista .= "<td class='text-center'>{$serial}</td>";
$lista.="<div class='col-lg-4'>";
$lista.="<div class='client card'>";

$lista.="<div class='title'><br><strong class='text-violet'>#{$serial}</strong></div>";

$lista.="<div class='card-close'>";
$lista.="<div class='dropdown'>";
$lista.="<button type='button' id='closeCard2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' class='dropdown-toggle'><i class='fa fa-ellipsis-v'></i></button>";
$lista.="<div aria-labelledby='closeCard2' class='dropdown-menu dropdown-menu-right has-shadow'>";
$lista.= "<a href='#' onClick='permisosCU(" . $menu1 . ",{$user->getIdentificacion()}," . '"' . "principal2.php?CONTENIDO=admon/multimedia/multimediaFormulario.php&accion=Modificar&id={$multimedia->getId()}" . '"' . "," . '"' . "U" . '"' . ")' class='dropdown-item edit' data-toggle='tooltip' data-placement='bottom' title='Modificar'><img src='assets/icon/modificar.png' width='15px' alt=''  /></a>";
$lista.= "<a href='#' onClick='eliminar({$multimedia->getId()}," . $menu1 . ",{$user->getIdentificacion()}," . '"' . "D" . '"' . ")' class='dropdown-item' data-toggle='tooltip' data-placement='bottom' title='Eliminar'> <img src='assets/icon/eliminar.png' width='20px' alt=''  /></a>";
$lista.="</div>";
$lista.="</div>";
$lista.="</div>";
$lista.="<div class='card-body text-center'>";
$lista.="<div class=''><img src='foto/{$foto2}' alt='...'  class='img-fluid '>";
$lista.="<div class='status bg-green'></div>";
$lista.="</div>";
$lista.="<div class='client-title'>";
$lista.="<h3>{$multimedia->getServicioFin()->getNombre()}</h3>";
$lista.="</div>";
$lista.="</div>";
$lista.="</div>";
$lista.="</div>";
$serial += 1;
    }
}
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="assets/dataTables/jquery-3.6.0.min.js" ></script>
</head>

<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-13 lead">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" >Registro de Galeria</li>
                    <li class="breadcrumb-item"><a href="#" data-toggle='tooltip' data-placement='bottom' title='Adicionar' onclick="permisosCU(<?= $menu1 ?>, <?= $user->getIdentificacion() ?>, 'principal2.php?CONTENIDO=admon/multimedia/multimediaFormulario.php&accion=Adicionar', 'C')">Nuevo registro</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
<br>
<div class="container-fluid">
    <div class="row">
    <?=$lista?>    
    </div>
</div>

<script type="text/javascript">
 
    function eliminar(id, idmenu, idusuario, accion) {
        var request = $.ajax({
            type: "POST",
            url: "admon/OpcionAcceso/permisos.php",
            data: {
                menu: idmenu,
                usuario: idusuario,
                accion: accion,
            }
        });
        request.done(function (transporte) {
            var transport = JSON.parse(JSON.stringify(transporte));
            if (transport['flag'] === false) {
                alert("el usuario no tiene permiso para la opcion seleccionada");
                console.log(transport);
                //location = "principal.php?CONTENIDO=inicio.php";
            } else {
                console.log(transport);
                if (confirm('Realemente desea eliminar este registro?'))
                    location = 'principal2.php?CONTENIDO=admon/multimedia/multimediaActualizar.php&accion=Eliminar&id=' + id + "&menu1=<?= $menu1 ?>";
            }
        });
        request.fail(function (transporte) {
            var transport = JSON.parse(JSON.stringify(transporte));
            alert("el usuario no tiene permiso para la opcion seleccionada");
            console.log(transport);
            //location = "principal.php?CONTENIDO=inicio.php";
        });
    }

    function permisosCU(idmenu, idusuario, ruta, accion) {
        var request = $.ajax({
            type: "POST",
            url: "admon/OpcionAcceso/permisos.php",
            data: {
                menu: idmenu,
                usuario: idusuario,
                accion: accion,
            }
        });
        request.done(function (transporte) {
            var transport = JSON.parse(JSON.stringify(transporte));
            if (transport['flag'] === false) {
                alert("el usuario no tiene permiso para la opcion seleccionada");
                console.log(transport);
                //location = "principal.php?CONTENIDO=inicio.php";
            } else {
                console.log(transport);
                location = ruta + "&menu1=" + transport['menu'];
            }
        });
        request.fail(function (transporte) {
            var transport = JSON.parse(JSON.stringify(transporte));
            alert("el usuario no tiene permiso para la opcion seleccionada");
            console.log(transport);
            //location = "principal.php?CONTENIDO=inicio.php";
        });
    }

</script>

<br>
