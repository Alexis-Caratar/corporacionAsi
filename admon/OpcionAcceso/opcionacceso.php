<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once dirname(__FILE__) . '/../../Clases/OpcionAcceso.php';
require_once dirname(__FILE__) . '/../../Clases/Menusis.php';

require_once dirname(__FILE__) . '/../../Clases/Rol.php';
require_once dirname(__FILE__) . '/../../Clases/Usuario.php';
require_once dirname(__FILE__) . '/../../Clases/ConectorBD.php';
foreach ($_GET as $variable => $valor)
    ${$variable} = $valor;
foreach ($_POST as $variable => $valor)
    ${$variable} = $valor;

$lista = '';
$serial = 1;
$datos = OpcionAcceso::getDatosEnObjetos("idusuario=$identificacion", null);

if (count($datos) > 0) {
    for ($i = 0; $i < count($datos); $i++) {
        $usuario = $datos[$i];
        $lista .= '<tr class="gradeC">';
        $lista .= "<td class='text-center'>{$serial}</td>";
        $lista .= '<td class="text-center">' . $usuario->getMenuFin()->getMenusis() . '</td>';
        $boton = "";
        if ($usuario->getCrear() == 'X')
            $boton = "<h4 class='btn btn-success' data-toggle='tooltip' data-placement='bottom' title='Permiso Activo'>X</h4>";
        else
            $boton = "<h4 class='btn btn-danger' data-toggle='tooltip' data-placement='bottom' title='Permiso Desactivado'>-</h4>";
        $boton2 = "";
        if ($usuario->getLeer() == 'X')
            $boton2 = "<h4 class='btn btn-success' data-toggle='tooltip' data-placement='bottom' title='Permiso Activo'>X</h4>";
        else
            $boton2 = "<h4 class='btn btn-danger' data-toggle='tooltip' data-placement='bottom' title='Permiso Desactivado'>-</h4>";
        $boton3 = "";
        if ($usuario->getActualizar() == 'X')
            $boton3 = "<h4 class='btn btn-success' data-toggle='tooltip' data-placement='bottom' title='Permiso Activo'>X</h4>";
        else
            $boton3 = "<h4 class='btn btn-danger' data-toggle='tooltip' data-placement='bottom' title='Permiso Desactivado'>-</h4>";
        $boton4 = "";
        if ($usuario->getBorrar() == 'X')
            $boton4 = "<h4 class='btn btn-success' data-toggle='tooltip' data-placement='bottom' title='Permiso Activo'>X</h4>";
        else
            $boton4 = "<h4 class='btn btn-danger' data-toggle='tooltip' data-placement='bottom' title='Permiso Desactivado'>-</h4>";
        $boton5 = "";
//        if ($usuario->getEstado() == 'X')
//            $boton5 = "<h4 class='glyphicon glyphicon-check ' data-toggle='tooltip' data-placement='bottom' title='Permiso Activo'></h4>";
//        else
//            $boton5 = "<h4 class='glyphicon glyphicon-minus ' data-toggle='tooltip' data-placement='bottom' title='Permiso Desactivado'></h4>";
        $lista .= '<td class="text-center">' . $boton . '</td>';
        $lista .= '<td class="text-center">' . $boton2 . '</td>';
        $lista .= '<td class="text-center">' . $boton3 . '</td>';
        $lista .= '<td class="text-center">' . $boton4 . '</td>';
//        $lista .= '<td class="text-center">' . $boton5 . '</td>';
        
        $lista .= '<td class="text-center">';
        $lista .= "<div class='card'>";
        $lista .= "<div class='card-close'>";
        $lista .= "<div class='dropdown'>";
        $lista .= "<button type='button' id='closeCard1' data-toggle='dropdown'  class='dropdown-toggle'><i class='fa fa-cog'></i></button>";
        $lista .= "<div aria-labelledby='closeCard1' class='dropdown-menu dropdown-menu-right has-shadow'>";
        $lista .= "<a href='#' onClick='permisosCU(" . $menu1 . ",{$user->getIdentificacion()}," . '"' . "principal2.php?CONTENIDO=admon/OpcionAcceso/opcionFormulario.php&accion=Modificar&idperfil={$usuario->getIdperfil()}&idusuario={$identificacion}&n_user={$n_user}" . '"' . "," . '"' . "U" . '"' . ")' class='dropdown-item edit' data-toggle='tooltip' data-placement='bottom' title='Modificar'><img src='assets/icon/modificar.png' width='15px' alt=''  /></a>";
        $lista .= "<a href='#' onClick='eliminar({$usuario->getIdperfil()}," . $menu1 . ",{$user->getIdentificacion()}," . '"' . "D" . '"' . ")' class='dropdown-item' data-toggle='tooltip' data-placement='bottom' title='Eliminar'> <img src='assets/icon/eliminar.png' width='20px' alt=''  /></a>";
        $lista .= "</div>";
        $lista .= "</div>";
        $lista .= "</div>";
        //$lista .= "<a '  . '"' . "," . '"' . "U" . '"' . ")'>"
        //        . " <span class='glyphicon glyphicon-pencil' data-toggle='tooltip' data-placement='bottom' title='Modificar'></span></a></td>";
       // $lista .= '<td class="text-center">';
       // $lista .= "<a><span data-toggle='tooltip' data-placement='bottom' title='Eliminar' onClick='eliminar({$usuario->getIdperfil()}," . $menu1 . ",{$user->getIdentificacion()}," . '"' . "D" . '"' . ")' class='glyphicon glyphicon-trash'/></span></a>";
        $lista .= '</td>';
        $lista .= '</tr>';
        $serial += 1;
    }
    
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="assets/dataTables/jquery-3.6.0.min.js" ></script>
<!--    <script type="text/javascript" src="js/plugins/dataTables/jquery-3.3.1.js" ></script>
    <script type="text/javascript" src="js/elert/alertify.js" ></script>-->
</head>

<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-13 lead">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Listado de control de permisos</li>
                    <li class="breadcrumb-item"><a href="#" data-toggle='tooltip' data-placement='bottom' title='Adicionar' onclick="permisosCU(<?= $menu1 ?>, <?= $user->getIdentificacion() ?>, 'principal2.php?CONTENIDO=admon/OpcionAcceso/opcionFormulario.php&accion=Adicionar&idusuario=<?=$identificacion?>&n_user=<?=$n_user?>', 'C')">nuevo permiso</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
<br>
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="container-fluid">
                    <div class="page-header">
                        <!--inicio de tabla--> 
                        <br>
                        <div class="text-center">
                            <h1> Registro de permisos <?=$n_user?></h1>
                            
                        </div>
                        <br>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">

                                 <table class="table table-hover text-center" id="dataTables-opciones">
                                <thead>
                                    <tr class="badge-primary">
                                    <th class="text-center">#</th>
                                            <th class="text-center">Menús</th>
                                            <th class="text-center">Adicionar</th>
                                            <th class="text-center">Leer</th>
                                            <th class="text-center">Actualizar</th>
                                            <th class="text-center">Borrar</th>
                                            <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?= $lista ?>
                                </tbody>
                            </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                        <!--fin de tabla--> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script type="text/javascript">
        
       function eliminar(idperfil, idmenu, idusuario, accion) {
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
                        location = 'principal2.php?CONTENIDO=admon/OpcionAcceso/opcionActualizar.php&accion=Eliminar&idperfil='+idperfil +"&idusuario=<?=$identificacion?>&n_user=<?=$n_user?>&menu1=<?= $menu1 ?>";
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

    </script>