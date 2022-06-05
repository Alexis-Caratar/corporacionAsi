<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
require_once dirname(__FILE__) . '/../../Clases/Contactos.php';
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
$datos= Contactos::getDatosEnObjetos(null, 'id');

if (count($datos) > 0) {
    for ($i = 0; $i < count($datos); $i++) {
        $contactos= $datos[$i];
        $lista .= '<tr class="gradeC">';
        $lista .= "<td class='text-center'>{$serial}</td>";
        $boton = "";
        $Nombreboton = "";
        if ($contactos->getEstado() == 'P') {
            $boton = "<h2 id='estado{$contactos->getId()}' onclick='ejemplo({$contactos->getId()},0)'><img src='assets/img/blank.png'  width='20px'/></h2>";
            $Nombreboton = "";
        } else {
            $boton = "<h2 id='estado{$contactos->getId()}' onclick='ejemplo({$contactos->getId()},1)'><img src='assets/img/check0.png' width='20px'/></h>";
            $Nombreboton = "";
        }
        //$lista .= "<td class='text-center'>$boton</td>";
        $lista .= "<td class='text-center'>{$contactos->getFecha()}</td>";
        $lista .= '<td class="text-center">' . $contactos->getNombres() . '</td>';
        $lista .= '<td class="text-center">' . $contactos->getTelefono() . '</td>';
        $lista .= '<td class="text-center">' . $contactos->getCorreo() . '</td>';
        $lista .= '<td class="text-center">' . $contactos->getAsunto() . '</td>';
        $lista .= '<td class="text-center">' . $contactos->getNumpersonas() . '</td>';
        
        $lista .= '<td class="text-center">' . $contactos->getServicioFin()->getNombre() . '</td>';
        $lista .= '<td class="text-center">' . $contactos->getMensaje() . '</td>';
//        $boton = "";
//        if ($contactos->getEstado() == 'X')
//            $boton = "<span  data-toggle='tooltip' data-placement='bottom' title='estado Activado' style='border-radius: 15px'>PENDIENTE</span>";
//        else
//            $boton = "<span class='label label-danger' data-toggle='tooltip' data-placement='bottom' title='estado Desactivado' style='border-radius: 25px'>REVISADA</span>";
//        $lista .= '<td class="text-center">' . $boton . '</td>';
        
        //$lista .= '<td class="text-center">';
//        $lista .= "<div class='card'>";
//        $lista .= "<div class='card-close'>";
//        $lista .= "<div class='dropdown'>";
//        $lista .= "<button type='button' id='closeCard1' data-toggle='dropdown'  class='dropdown-toggle'><i class='fa fa-cog'></i></button>";
//        $lista .= "<div aria-labelledby='closeCard1' class='dropdown-menu dropdown-menu-right has-shadow'>";
//        $lista .= "<a href='#' onClick='permisosCU(" . $menu1 . ",{$user->getIdentificacion()}," . '"' . "principal2.php?CONTENIDO=admon/contactos/contactosFormulario.php&accion=Modificar&id={$contactos->getId()}" . '"' . "," . '"' . "U" . '"' . ")' class='dropdown-item edit' data-toggle='tooltip' data-placement='bottom' title='Modificar'><img src='assets/icon/modificar.png' width='15px' alt=''  /></a>";
//        $lista .= "<a href='#' onClick='eliminar({$contactos->getId()}," . $menu1 . ",{$user->getIdentificacion()}," . '"' . "D" . '"' . ")' class='dropdown-item' data-toggle='tooltip' data-placement='bottom' title='Eliminar'> <img src='assets/icon/eliminar.png' width='20px' alt=''  /></a>";
//        $lista .= "</div>";
//        $lista .= "</div>";
//        $lista .= "</div>";
        //$lista .= '</td>';
        $lista .= '</tr>';
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
                    <li class="breadcrumb-item active" >Registro de contactos</li>
                    <li class="breadcrumb-item"><a href="#" >Nuevo registro</a></li>
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
                            <h1> Registro de contactos</h1>
                            <i class="bi bi-check"></i>
                        </div>
                        <br>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">

                                 <table class="table table-hover text-center" id="dataTables-dependencia">
                                <thead>
                                    <tr class="badge-primary">
                                        <th class="text-center">#</th>
                                        
                                        <th class="text-center">Fecha Registro</th>
                                        <th class="text-center">Nombres</th>
                                        <th class="text-center">Telefono</th>
                                        <th class="text-center">Correo</th>
                                        <th class="text-center">Asusto</th>
                                        <th class="text-center"># Personas</th>
                                        <th class="text-center">Servicio</th>
                                        <th class="text-center">mensaje</th>
                                        
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

<!-- Dashboard Header Section    -->
<script type="text/javascript">
 $(document).ready(function () {
            var a = "Reportes de contactos";
            $('#dataTables-dependencia').append();
            $('#dataTables-dependencia').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-primary glyphicon glyphicon glyphicon-save',
                        title: 'Reportes de contactos',
                        
                        
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'btn btn-primary glyphicon glyphicon glyphicon-save',
                        messageTop: a,
                        title: 'REPORTE DE CONTACTOS ',
                    }


                ],
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }

            });
        });
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
                    location = 'principal2.php?CONTENIDO=admon/contactoss/contactosActualizar.php&accion=Eliminar&id=' + id + "&menu1=<?= $menu1 ?>";
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

function ejemplo(id, estado) {
                var request = $.ajax({
                    type: "POST",
                    url: "admon/contactos/actualizar.php",
                    data: {
                        accion: estado,
                        id: id,
                    }
                });
                request.done(function (transport) {
                    if (transport == 1) {
                        if (estado == 1) {
                            alert(estado);
                            $('#estado' + id)[0].outerHTML = '<h2  id="estado' + id + '" onclick="ejemplo(' + id + ',0)" value="INHABILITAR"><img src="assets/img/blank.png"  width="20px"/></h2>';
                        } else {
                            $('#estado' + id)[0].outerHTML = '<h2  id="estado' + id + '" onclick="ejemplo(' + id + ',1)" value="HABILITAR"><img src="assets/img/check0.png" width="20px"/></h2>';
                        }
                    }
                });
            }
</script>

<br>