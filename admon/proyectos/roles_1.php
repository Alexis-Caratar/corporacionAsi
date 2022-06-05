<?php
require_once dirname(__FILE__) . '/../../Clases/Rol.php';
require_once dirname(__FILE__) . '/../../Clases/ConectorBD.php';
foreach ($_GET as $Variable => $Valor) {
    ${$Variable} = $Valor;
}
foreach ($_POST as $Variable => $Valor) {
    ${$Variable} = $Valor;
}
$lista = '';
$serial = 1;
$datos = Rol::getDatosEnObjetos(null, 'idrol');
if (count($datos) > 0) {
    for ($i = 0; $i < count($datos); $i++) {
        $rol = $datos[$i];
        $lista .= '<tr class="gradeC">';
        $lista .= "<td class='text-center'>{$serial}</td>";
        $lista .= '<td class="text-center">' . $rol->getRol() . '</td>';
        $lista .= '<td class="text-center">' . $rol->getDescripcion() . '</td>';
        $boton = "";
        if ($rol->getEstado_r() == 'X')
            $boton = "<span class='label label-success' data-toggle='tooltip' data-placement='bottom' title='estado Activado' style='border-radius: 15px'>Activado</span>";
        else
            $boton = "<span class='label label-danger' data-toggle='tooltip' data-placement='bottom' title='estado Desactivado' style='border-radius: 25px'>Desactivado</span>";
        $lista .= '<td class="text-center">' . $boton . '</td>';
        $lista .= '<td class="text-center">';

        $lista .= "<div class='card'>";
        $lista .= "<div class='card-close'>";
        $lista .= "<div class='dropdown'>";
        $lista .= "<button type='button' id='closeCard1' data-toggle='dropdown'  class='dropdown-toggle'><i class='fa fa-cog'></i></button>";
        $lista .= "<div aria-labelledby='closeCard1' class='dropdown-menu dropdown-menu-right has-shadow'>";
        $lista .= "<a href='#' onClick='permisosCU(" . $menu1 . ",{$user->getIdentificacion()}," . '"' . "principal2.php?CONTENIDO=admon/Roles/rolFormulario.php&accion=Modificar&idrol={$rol->getIdrol()}" . '"' . "," . '"' . "U" . '"' . ")' class='dropdown-item edit' data-toggle='tooltip' data-placement='bottom' title='Modificar'><img src='assets/icon/modificar.png' width='15px' alt=''  /></a>";
        $lista .= "<a href='#' onClick='eliminar({$rol->getIdrol()}," . $menu1 . ",{$user->getIdentificacion()}," . '"' . "D" . '"' . ")' class='dropdown-item' data-toggle='tooltip' data-placement='bottom' title='Eliminar'> <img src='assets/icon/eliminar.png' width='20px' alt=''  /></a>";
        $lista .= "</div>";
        $lista .= "</div>";
        $lista .= "</div>";
        $lista .= '</td>';
        $lista .= '</tr>';
        $serial += 1;
    }
}
?>
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="assets/tablas/jquery-3.5.1.js" type="text/javascript"></script>
<!--    <script type="text/javascript" src="js/plugins/dataTables/jquery-3.3.1.js" ></script>
    <script type="text/javascript" src="js/elert/alertify.js" ></script>-->
</head>

<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-13 lead">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" >Registro de Roles</li>
                    <li class="breadcrumb-item"><a href="#" data-toggle='tooltip' data-placement='bottom' title='Adicionar' onclick="permisosCU(<?= $menu1 ?>, <?= $user->getIdentificacion() ?>, 'principal2.php?CONTENIDO=admon/Roles/rolFormulario.php&accion=Adicionar', 'C')">Nuevo registro</a></li>
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
                            <h1> Registro de Roles</h1>
                        </div>
                        <br>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">

                                 <table class="table table-hover text-center" id="dataTables-dependencia">
                                <thead>
                                    <tr class="badge-primary">
                                        <th class="text-center">#</th>
                                        <th class="text-center">Roles</th>
                                        <th class="text-center">Descripción</th>
                                        <th class="text-center">estado</th>
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

<!-- Dashboard Header Section    -->
<script type="text/javascript">
 $(document).ready(function () {
            var a = "Reportes de Roles";
            $('#dataTables-dependencia').append();
            $('#dataTables-dependencia').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-primary glyphicon glyphicon glyphicon-save',
                        title: 'Reportes de Roles'
                        
                        
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'btn btn-primary glyphicon glyphicon glyphicon-save',
                        messageTop: a,
                        title: 'Reportes de Roles',
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
    function eliminar(idrol, idmenu, idusuario, accion) {
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
                    location = 'principal2.php?CONTENIDO=admon/Roles/rolesActualizar.php&accion=Eliminar&idrol=' + idrol + "&menu1=<?= $menu1 ?>";
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