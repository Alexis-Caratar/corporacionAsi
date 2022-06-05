<?php
require_once dirname(__FILE__) . '/../../Clases/Dependencia.php';
require_once dirname(__FILE__) . '/../../Clases/ConectorBD.php';

$lista = '';
$datos = Dependencia::getDatosEnObjetos(null, 'numeropresupuestal');
for ($i = 0; $i < count($datos); $i++) {
    $dependencia = $datos[$i];
    $lista .= '<tr class="gradeC">';
        $lista .= '<td class="text-center">' . $dependencia->getNumeropresupuestal() . '</td>';
    $lista .= '<td class="text-center">' . $dependencia->getNombre() . '</td>';
    $lista .= '<td class="text-center">' . strtoupper($dependencia->getDescripcion()) . '</td>';
    $lista .= '<td class="text-center">';
    //$lista .= "<a ' href='#' onClick='permisosCU(" . $menu1 . ",{$user->getIdentificacion()}," . '"' . "principal.php?CONTENIDO=admon/Dependencia/dependenciaFormulario.php&accion=Modificar&numeropresupuestal={$dependencia->getNumeropresupuestal()}" . '"' . "," . '"' . "U" . '"' . ")'>"
    //       . " <span class='glyphicon glyphicon-pencil' data-toggle='tooltip' data-placement='bottom' title='Modificar'></span></a></td>";
    //$lista .= '<td class="text-center">';
    //$lista .= "<a><span data-toggle='tooltip' data-placement='bottom' title='Eliminar' onClick='eliminar({$dependencia->getNumeropresupuestal()}," . $menu1 . ",{$user->getIdentificacion()}," . '"' . "D" . '"' . ")' class='glyphicon glyphicon-trash'/></span></a>";
    $lista .= "<div class='card'>";
    $lista .= "<div class='card-close'>";
    $lista .= "<div class='dropdown'>";
    $lista .= "<button type='button' id='closeCard1' data-toggle='dropdown'  class='dropdown-toggle'><i class='fa fa-cog'></i></button>";
    $lista .= "<div aria-labelledby='closeCard1' class='dropdown-menu dropdown-menu-right has-shadow'>";
    $lista .= "<a href='#' onClick='permisosCU(" . $menu1 . ",{$user->getIdentificacion()}," . '"' . "principal2.php?CONTENIDO=admon/Dependencia/dependenciaFormulario.php&accion=Modificar&numeropresupuestal={$dependencia->getNumeropresupuestal()}" . '"' . "," . '"' . "U" . '"' . ")' class='dropdown-item edit' data-toggle='tooltip' data-placement='bottom' title='Modificar'><img src='assets/icon/modificar.png' width='15px' alt=''  /></a>";
    $lista .= "<a href='#' onClick='eliminar({$dependencia->getNumeropresupuestal()}," . $menu1 . ",{$user->getIdentificacion()}," . '"' . "D" . '"' . ")' class='dropdown-item' data-toggle='tooltip' data-placement='bottom' title='Eliminar'> <img src='assets/icon/eliminar.png' width='20px' alt=''  /></a>";
    $lista .= "</div>";
    $lista .= "</div>";
    $lista .= "</div>";
    $lista .= '</td>';
    $lista .= '</tr>';
}


$dependencia = new Dependencia(null, null);
?>
<head>
    <meta charset="utf-8">
    <script src="assets/tablas/jquery-3.5.1.js" type="text/javascript"></script>
</head>
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-13 lead">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" >Registro de dependencia</li>
                    <li class="breadcrumb-item"><a href="#" data-toggle='tooltip' data-placement='bottom' title='Adicionar' onclick="permisosCU(<?= $menu1 ?>, <?= $user->getIdentificacion() ?>, 'principal2.php?CONTENIDO=admon/Dependencia/dependenciaFormulario.php&accion=Adicionar', 'C')">Nuevo dependencia</a></li>
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
                            <h1> Registro de Dependencias</h1>
                        </div>
                        <br>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">

                                <table class="table table-hover text-center" id="dataTables-dependencia">
                                    <thead class="badge-primary" >

                                        <tr class="text-center">
                                            <th class="text-center">Centros&nbsp;de&nbsp;costo</th>
                                            <th class="text-center">Dependencia</th>
                                            <th class="text-center">Estado</th>
                                            <th class="text-center"> </th>

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






<script>
    $(document).ready(function () {
        let a = "Reportes de dependencia";
        $('#dataTables-dependencia').append();
        $('#dataTables-dependencia').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-primary glyphicon glyphicon glyphicon-save',
                    title: 'Reportes de dependencia',

//                        customize: function (doc) {
//                            doc.content.splice(0, 0, {
//                                margin: [0, 0, 0, 0],
//                                image: 'data:image/png;base64,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',
//
//                            });
//                        }
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-primary glyphicon glyphicon glyphicon-save',
                    messageTop: a,
                    title: 'Fundación creativida',
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
                    "sSortAscending": ": Actilet para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Actilet para ordenar la columna de manera descendente"
                }
            }

        });
    });

//funcion de validacion del permiso
    function eliminar(numeropresupuestal, idmenu, idusuario, accion) {
        let request = $.ajax({
            type: "POST",
            url: "admon/OpcionAcceso/permisos.php",
            data: {
                menu: idmenu,
                usuario: idusuario,
                accion: accion,
            }
        });
        request.done(function (transporte) {
            let transport = JSON.parse(JSON.stringify(transporte));
            if (transport['flag'] === false) {
                alert("el usuario no tiene permiso para la opcion seleccionada");
                console.log(transport);
                //location = "principal.php?CONTENIDO=inicio.php";
            } else {
                console.log(transport);
                if (confirm('Realemente desea eliminar este registro?'))
                    location = 'principal2.php?CONTENIDO=admon/Dependencia/dependenciaActualizar.php&accion=Eliminar&numeropresupuestal=' + numeropresupuestal + "&menu1=<?= $menu1 ?>";
            }

        });
        request.fail(function (transporte) {
            let transport = JSON.parse(JSON.stringify(transporte));
            alert("el usuario no tiene permiso para la opcion seleccionada");
            console.log(transport);
            //location = "principal.php?CONTENIDO=inicio.php";
        });
    }

    function permisosCU(idmenu, idusuario, ruta, accion) {
        let request = $.ajax({
            type: "POST",
            url: "admon/OpcionAcceso/permisos.php",
            data: {
                menu: idmenu,
                usuario: idusuario,
                accion: accion,
            }
        });
        request.done(function (transporte) {
            let transport = JSON.parse(JSON.stringify(transporte));
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
            let transport = JSON.parse(JSON.stringify(transporte));
            alert("el usuario no tiene permiso para la opcion seleccionada");
            console.log(transport);
            //location = "principal.php?CONTENIDO=inicio.php";
        });
    }//segunda opcion 
    function elimina(idimpuestos, idmenu, idusuario, accion) {
        let request = $.ajax({
            type: "POST",
            url: "admon/OpcionAcceso/permisos.php",
            data: {
                menu: idmenu,
                usuario: idusuario,
                accion: accion,
            }
        });
        request.done(function (transporte) {
            let transport = JSON.parse(JSON.stringify(transporte));
            if (transport['flag'] === false) {
                alert("el usuario no tiene permiso para la opcion seleccionada");
                console.log(transport);
                //location = "principal.php?CONTENIDO=inicio.php";
            } else {
                console.log(transport);
                if (confirm('Realemente desea eliminar este registro?'))
                    location = 'principal.php?CONTENIDO=admon/Dependencia/impuestosActualizar.php&accion=Eliminar&idimpuestos=' + idimpuestos + "&menu1=<?= $menu1 ?>";
            }

        });
        request.fail(function (transporte) {
            let transport = JSON.parse(JSON.stringify(transporte));
            alert("el usuario no tiene permiso para la opcion seleccionada");
            console.log(transport);
            //location = "principal.php?CONTENIDO=inicio.php";
        });
    }

    function permisosCU2(idmenu, idusuario, ruta, accion) {
        let request = $.ajax({
            type: "POST",
            url: "admon/OpcionAcceso/permisos.php",
            data: {
                menu: idmenu,
                usuario: idusuario,
                accion: accion,
            }
        });
        request.done(function (transporte) {
            let transport = JSON.parse(JSON.stringify(transporte));
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
            let transport = JSON.parse(JSON.stringify(transporte));
            alert("el usuario no tiene permiso para la opcion seleccionada");
            console.log(transport);
            //location = "principal.php?CONTENIDO=inicio.php";
        });
    }
</script>

