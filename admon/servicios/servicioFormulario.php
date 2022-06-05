<?php
require_once dirname(__FILE__) . '/../../Clases/Servicio.php';
require_once dirname(__FILE__) . '/../../Clases/ConectorBD.php';
foreach ($_GET as $variable => $valor)
    ${$variable} = $valor;
foreach ($_POST as $Variable => $Valor)
    ${$Variable} = $Valor;
$foto = 'profile-pic.jpg';
if ($accion == 'Modificar') {
    $servicio = new Servicio('id', $id);
} else {
    $servicio = new Servicio(null, null);
}
if (trim($servicio->getFoto()) != null)
    $foto = $servicio->getFoto();
?>
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-13 lead">
                <ul class="breadcrumb">

                    <li class="breadcrumb-item active"><a data-toggle='tooltip' data-placement='bottom' title='Lista' href="principal2.php?CONTENIDO=admon/servicios/servicios.php&menu1=<?= $menu1 ?>">Registro de servicio</a></li>
                    <li class="breadcrumb-item" >Nueva servicio</li>
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
                                <h1> <?= strtoupper($accion) ?> SERVICIO</h1>
                            </div>
                            <br>
                            <form class="form-a" name="formulario" method="post" action="principal2.php?CONTENIDO=admon/servicios/servicioActualizar.php&menu1=<?= $menu1 ?>" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <label for="foto">foto</label>
                                        <input type="file" name="foto" id="file" style="display: none;" accept="image/*"/>
                                        <button type="button" id="btn_file" class="btn btn-success btn-sm">Cambiar foto</button><span class="small" id="text_file" style="margin-left: 50px;">Foto por defecto</span>
                                        <input type="hidden" name="fotoUpdate" value="<?= $foto ?>">
                                        <img src="foto/<?= $foto ?>" id="foto" style="height: 200%; max-height: 200px;"/>
                                    </div> 
                                    <div class="col-md-11 mb-2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Nombre del servicio</label>
                                            <input type="text" class="form-control form-control-lg form-control-a"  name="nombre" value="<?= $servicio->getNombre() ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-11 mb-2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Descripción</label>
                                            <textarea  type="text" class="form-control form-control-lg form-control-a" name="descripcion" value="<?= $servicio->getDescripcion() ?>" required><?= $servicio->getDescripcion() ?></textarea>
                                        </div>
                                    </div>


                                    <div class="col-md-12 mb-1">
                                        <div class="text-center">
                                            <div class="form-group label-floating">
                                                Estado
                                                <?php if ($servicio->getEstado() == 'X') { ?>
                                                    <th><input type="checkbox"  name="estado_r" id="estado1"  checked></th>
                                                <?php } else { ?>
                                                    <th><input type="checkbox"  name="estado_r" id="estado1" ></th>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>


                                    <input type="hidden" name="id" value="<?= $servicio->getId() ?>">
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
<!--<script type="text/javascript" src="js/jquery-3.1.1.min.js" ></script>-->
<!--<script type="text/javascript" src="js/jquery.min.js" ></script>-->
<script type="text/javascript">

    $('#btn_file').click(function () {
        $('#file').click();
    });
    $(function () {
        $('#file').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#foto').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
            $('#btn_file').text('Cambiar foto');
            $('#text_file').text(e.target.files[0].name);
        });
    });

</script>	