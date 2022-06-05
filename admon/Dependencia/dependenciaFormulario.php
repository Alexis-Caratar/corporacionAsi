<?php
require_once dirname(__FILE__).'/../../Clases/Dependencia.php';
require_once dirname(__FILE__).'/../../Clases/ConectorBD.php';
foreach ($_GET as $variable => $valor)
    ${$variable} = $valor;
foreach ($_POST as $Variable => $Valor)
    ${$Variable} = $Valor;
if ($accion == 'Modificar')
    $usuario = new Dependencia('numeropresupuestal', $numeropresupuestal);
else
    $usuario= new Dependencia(null, null);
?>
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-13 lead">
                <ul class="breadcrumb">
                    
                    <li class="breadcrumb-item active"><a data-toggle='tooltip' data-placement='bottom' title='Lista' href="principal2.php?CONTENIDO=admon/Dependencia/dependencia.php&menu1=<?=$menu1?>">Registro de dependencias</a></li>
                    <li class="breadcrumb-item" >Nueva dependencia</li>
                </ul>
            </div>
        </div>
    </div>
</header>

<!--formulario inicio-->
<br>

<div class="col-lg-10 offset-2">
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-10">
                <div class="container-fluid">
                    <div class="page-header">
                        <!--inicio de tabla--> 
                        <br>
                        <div class="text-center">
                            <h1> <?= strtoupper($accion) ?> DEPENDENCIA</h1>
                    </div>
                        <br>
                                <form class="form-a" name="formulario" method="post" action="principal2.php?CONTENIDO=admon/Dependencia/dependenciaActualizar.php&menu1=<?=$menu1?>" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-11 mb-2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">N° Presupuestal</label>
                                            <input type="number" class="form-control form-control-lg form-control-a"  name="numeropresupuestal" value="<?= $usuario->getNumeropresupuestal() ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-11 mb-2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Dependencia</label>
                                            <input type="text" class="form-control form-control-lg form-control-a" name="nombre" value="<?= $usuario->getNombre() ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-11 mb-2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Descripcion</label>
                                            <textarea  class="form-control form-control-lg form-control-a"   type="text" name="descripcion" value="<?= $usuario->getDescripcion() ?>"><?=$usuario->getDescripcion()?></textarea>
                                        </div>
                                    </div>
                                    
                                    
                                     
                                    <input type="hidden" name="numeroA" value="<?= $usuario->getNumeropresupuestal() ?>">
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
<!--formulario fin-->




