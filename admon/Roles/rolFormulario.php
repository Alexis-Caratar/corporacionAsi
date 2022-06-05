<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__) . '/../../Clases/Rol.php';
require_once dirname(__FILE__) . '/../../Clases/ConectorBD.php';
foreach ($_GET as $variable => $valor)
    ${$variable} = $valor;

foreach ($_POST as $Variable => $Valor)
    ${$Variable} = $Valor;
if ($accion == 'Modificar')
    $usuario = new Rol('idrol', $idrol);
else
    $usuario = new Rol(null, null);
?>
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-13 lead">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" ><a  data-toggle='tooltip' data-placement='bottom' title='Lista' href="principal2.php?CONTENIDO=admon/Roles/roles.php&menu1=<?= $menu1 ?>">Registro de roles</a></li>
                    <li class="breadcrumb-item active">Nuevo registro</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
<br>
<div class="col-lg-10 offset-2">
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-10">
                    <div class="container-fluid">
                        <div class="page-header">
                            <!--inicio de tabla--> 
                            <div class="text-center">
                                <h1><?= strtoupper($accion) ?> Rol</h1> 
                            </div>
                            <br>
                            <form class="form-a" name="formulario" method="post" action="principal2.php?CONTENIDO=admon/Roles/rolesActualizar.php&menu1=<?= $menu1 ?>" enctype="multipart/form-data">
                                <div class="row">

                                    <div class="col-md-5 mb-1">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Rol</label>
                                            <input type="text" class="form-control form-control-lg form-control-a"  name="rol" value="<?= $usuario->getRol() ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Descripción</label>
                                            <input type="text" class="form-control form-control-lg form-control-a"  name="descripcion" value="<?= $usuario->getDescripcion() ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <div class="text-center">
                                            <div class="form-group label-floating">
                                                Estado
                                                <?php if ($usuario->getEstado_r() == 'X') { ?>
                                                    <th><input type="checkbox"  name="estado_r" id="estado1"  checked></th>
                                                <?php } else { ?>
                                                    <th><input type="checkbox"  name="estado_r" id="estado1" ></th>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="idrol" value="<?= $usuario->getIdrol() ?>">
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
