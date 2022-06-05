<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__) . '/../../Clases/OpcionAcceso.php';
require_once dirname(__FILE__) . '/../../Clases/Rol.php';
require_once dirname(__FILE__) . '/../../Clases/Menusis.php';
require_once dirname(__FILE__) . '/../../Clases/ConectorBD.php';
foreach ($_GET as $variable => $valor)
    ${$variable} = $valor;

foreach ($_POST as $Variable => $Valor)
    ${$Variable} = $Valor;
if ($accion == 'Modificar')
    $usuario = new OpcionAcceso('idperfil', $idperfil);
    
else
    $usuario = new OpcionAcceso(null, null);

?>
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-13 lead">
                <ul class="breadcrumb">
                    
                    <li class="breadcrumb-item active"><a href="principal2.php?CONTENIDO=admon/OpcionAcceso/opcionacceso.php&accion=Adicionar&identificacion=<?=$idusuario?>&n_user=<?=$n_user?>&menu1=<?=$menu1?>">Listado de control de permiso</a></li>
                    <li class="breadcrumb-item" >nuevo permiso</li>
                </ul>
            </div>
        </div>
    </div>
</header>

<!--formulario inicio-->
<br>

<div class="col-lg-10 offset-1">
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="container-fluid">
                    <div class="page-header">
                        <!--inicio de tabla--> 
                        <br>
                        <div class="text-center">
                            <?= strtoupper($accion) ?> ACCESOS A: <?=$n_user?>
                    </div>
                        <br>
                                <form class="form-a" name="asignacionvehiculo" method="post" action="principal2.php?CONTENIDO=admon/OpcionAcceso/opcionActualizar.php&idusuario=<?=$idusuario?>&n_user=<?=$n_user?>&menu1=<?=$menu1?>" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-8 mb-2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Opción del Menú</label>
                                            <select name="menu" class='form-control form-control-lg form-control-a'><?= Menusis::getDatosEnOptions($usuario->getMenu(),'idpadre') ?></select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 mb-2">
                                    <h3><b>Selecciona los tipos de permisos </b></h3> 
                                </div>
                                    <div class="col-md-2 mb-2">
                                    Adicionar
                                    <?php if ($usuario->getCrear() == 'X') { ?>
                                        <input type="checkbox" name="crear" id="crear1" onclick="crear"checked>
                                    <?php } else { ?>
                                        <input type="checkbox" name="crear" id="crear1" onclick="crear" >
                                    <?php } ?>
                                </div>
                                <div class="col-md-2 mb-2">
                                    Leer
                                    <?php if ($usuario->getLeer() == 'X') { ?>
                                        <input type="checkbox" name="leer" id="leer1" onclick="leer"  checked>
                                    <?php } else { ?>
                                        <input type="checkbox" name="leer" id="leer1" onclick="leer">
                                    <?php } ?>
                                </div>
                                <div class="col-md-2 mb-2">
                                    Actualizar
                                    <?php if ($usuario->getActualizar() == 'X') { ?>
                                        <input type="checkbox" name="actualizar" id="actualizar1" checked>
                                    <?php } else { ?>
                                        <input type="checkbox" name="actualizar" id="actualizar1">
                                    <?php } ?>
                                </div>
                                <div class="col-md-2 mb-2">
                                    Eliminar
                                    <?php if ($usuario->getBorrar() == 'X') { ?>
                                        <input type="checkbox" name="borrar" id="borrar1" checked>
                                    <?php } else { ?>
                                        <input type="checkbox" name="borrar" id="borrar1">
                                    <?php } ?>
                                </div>
                                    
                                    
                                     
                                    <input type="hidden" name="idperfil" value="<?= $usuario->getIdperfil() ?>">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <button type="submit" value="<?= $accion ?>" name="accion" class="btn btn-success btn-raised " <?= $accion ?>><i class="zmdi zmdi-floppy"></i> Guardar</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        <!--fin de tabla--> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
<br>
 <script type="text/javascript" src="assets/dataTables/jquery-3.6.0.min.js" ></script>
<script type="text/javascript">
$("#crear1").click(function () {
    var estado = $("#crear1")[0].checked;
    if (estado === true) {
        $("#leer1")[0].checked = true;
    }
});
$("#leer1").click(function () {
    var estado = $("#leer1")[0].checked;
    if (estado === true) {
        $("#crear1")[0].checked = true;
    }
});


</script>