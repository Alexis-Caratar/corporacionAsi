<?php
require_once dirname(__FILE__) . '/../../Clases/Usuario.php';
require_once dirname(__FILE__) . '/../../Clases/Genero.php';
require_once dirname(__FILE__) . '/../../Clases/ConectorBD.php';
require_once dirname(__FILE__) . '/../../Clases/Rol.php';
foreach ($_GET as $Variable => $Valor)
    ${$Variable} = $Valor;
foreach ($_POST as $Variable => $Valor)
    ${$Variable} = $Valor;
$ingresoContraseña = '';
$validacionContraseña = '';

$foto = 'profile-pic.jpg';
if ($accion == 'Modificar') {
    $usuario = new Usuario('identificacion', $identificacion);
    //valida el cambio de la contraseña siempre y cuando accion sea Modificar
    $validacionContraseña .= "<button class='btn badge-primary' id='btnCambiarContraseña' onclick='desplegar()' >Cambiar contraseña</button>";
    $validacionContraseña .= "<div id='cambiarContraseña' style='display: none;'>";
    $validacionContraseña .= "<form class='form-a' name='formularioContraseña' method='post' action='principal2.php?CONTENIDO=admon/usuario/usuariosFinalActualizar.php&menu1='{$menu1}' onsubmit='return validarCambio()'>";

    $validacionContraseña .= "<div class='row' >";
    $validacionContraseña .= "<div class='col-md-4 mb-2' >";
    $validacionContraseña .= "<label for=''>Contraseña</label>";
    $validacionContraseña .= "<input class='form-control form-control-lg form-control-a' type='password' name='' id='contraseña1'  value='' />";
    $validacionContraseña .= "</div>";
    $validacionContraseña .= "</div>";

    $validacionContraseña .= "<div class='row' >";
    $validacionContraseña .= "<div class='col-md-4 mb-2' >";
    $validacionContraseña .= "<label for=''>Contraseña confirm</label>";
    $validacionContraseña .= "<input class='form-control form-control-lg form-control-a' type='password' name='clave' id='contraseña2' onkeyup='contraseñaIgual(this)' value='' placeholder='' />";
    $validacionContraseña .= '</div>';
    $validacionContraseña .= '</div>';
    $validacionContraseña .= "<font id='mensaje' color='red'></font><br>";
    $validacionContraseña .= "<input type='submit' class='btn btn-b' name='accion' value='Cambiar contraseña' />";
    $validacionContraseña .= "<input type='hidden'  name='identificacion' value={$usuario->getIdentificacion()} />";

    $validacionContraseña .= "</form>";
    $validacionContraseña .= "</div>";
} else {
    $usuario = new Usuario(null, null);
//    $ingresoContraseña .= "<div class='col-md-4 mb-2' >";
//    $ingresoContraseña .= "<div class='form-group label-floating'>";
//    $ingresoContraseña .= "<label class='control-label'>Contraseña</label>";
//    $ingresoContraseña .= "<input class='form-control form-control-lg form-control-a' type='password' name='clave' value='{$usuario->getClave()}' required />";
//    $ingresoContraseña .= '</div>';
//    $ingresoContraseña .= '</div>';
}
if (trim($usuario->getFoto()) != null)
    $foto = $usuario->getFoto();
?>
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-13 lead">
                <ul class="breadcrumb">
                    
                    <li class="breadcrumb-item active"><a data-toggle='tooltip' data-placement='bottom' title='Adicionar' href="principal2.php?CONTENIDO=admon/usuario/usuarioFinal.php&menu1=<?=$menu1?>" data-toggle='tooltip' data-placement='bottom' title="lISTADO">Listado de usuarios</a></li>
                    <li class="breadcrumb-item" >Usuarios </li>
                </ul>
            </div>
        </div>
    </div>
</header>
<br>
<div class="col-lg-13 offset-0">
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="container-fluid">
                    <div class="page-header">
                        <!--inicio de tabla--> 
                        <br>
                        <div class="text-center">
                            <h1> <?= strtoupper($accion) ?> USUARIO</h1>
                    </div>
                        <br>
                                <form class="form-a" name="formulario" method="post" action="principal2.php?CONTENIDO=admon/usuario/usuariosFinalActualizar.php&menu1=<?=$menu1?>" enctype="multipart/form-data">
                                    <div class="row">
                            <div class="col-md-12 mb-2">
                                        <label for="foto">foto</label>
                                        <input type="file" name="foto" id="file" style="display: none;" accept="image/*"/>
                                        <button type="button" id="btn_file" class="btn btn-success btn-sm">Cambiar foto</button><span class="small" id="text_file" style="margin-left: 50px;">Foto por defecto</span>
                                        <input type="hidden" name="fotoUpdate" value="<?= $foto ?>">
                                        <img src="foto/<?= $foto ?>" id="foto" style="height: 200%; max-height: 200px;"/>
                                    </div> 
                            <div class="col-md-3 mb-2">
                                <div class="form-group label-floating">
                                    <label class="control-label">Identificación</label>
                                    <input type="number" class="form-control form-control-lg form-control-a" onkeyup="consultar(this.value);" name="identificacion" id="identificacion" value="<?= $usuario->getIdentificacion() ?>" required>
                                </div>
                            </div> 
                            <div class="col-md-5 mb-2">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nombres</label>
                                    <input type="text" class="form-control form-control-lg form-control-a" name="nombres" value="<?= $usuario->getNombres() ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group label-floating">
                                    <label class="control-label">Apellidos</label>
                                    <input type="text" class="form-control form-control-lg form-control-a" name="apellidos" value="<?= $usuario->getApellidos() ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group label-floating">
                                    <label class="control-label">Genero</label>
                                    <select name="genero"  class='form-control form-control-lg form-control-a'><?=Genero::getDatosEnOptions($usuario->getGenero()->getIdgenero(), null,null); ?></select>
                                </div>
                            </div>
                            <div class="col-md-5 mb-2">
                                <div class="form-group label-floating">
                                    <label class="control-label">Dirección</label>
                                    <input type="text" class="form-control form-control-lg form-control-a"  name="direccion" value="<?= $usuario->getDireccion() ?>">
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group label-floating">
                                    <label class="control-label">Teléfono</label>
                                    <input type="number" class="form-control form-control-lg form-control-a"  name="telefono" value="<?= $usuario->getTelefono() ?>"required>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group label-floating">
                                    <label class="control-label">Usuario</label>
                                    <div>
                                        <input type="text" class="form-control form-control-lg form-control-a" name="usuario" value="<?= $usuario->getUsuario()?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 mb-3">
                                <div class="form-group label-floating">
                                    <label class="control-label">Contraseña</label>
                                    <div>
                                        <input type="password" class="form-control form-control-lg form-control-a" name="clave" value="<?= $usuario->getClave() ?>">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-2">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Rol</label>
                                                <select name="rol" class='form-control form-control-lg form-control-a' required><?= Rol::getDatosEnOptions($usuario->getRol(), "estado_r = 'X'", null);?></select>
                                            </div>
                                        </div>
                                        <?= $ingresoContraseña?>
                            <div class="col-md-12 mb-2">
                                <p class="text-center">
                                    <input type="hidden" name="Aidentificacion" value="<?= $usuario->getidentificacion() ?>">
                            <input type="hidden" name="tipo" value="<?= $usuario->getTipo() ?>">
                                    <button type="submit" value="<?= $accion ?>" name="accion" class="btn btn-success btn-raised " <?= $accion ?>><i class="zmdi zmdi-floppy"></i> Guardar</button>
                                </p>
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
    function contraseñaIgual(f) {
        var identicas = (document.getElementById('contraseña1').value == document.getElementById('contraseña2').value);
        var mensaje = '';
        if (!identicas) {
            mensaje = 'Las contraseñas no coinciden';
        } else {
            mensaje = 'las contraseñas coinciden';
        }
        document.getElementById('mensaje').innerHTML = mensaje;
        return identicas;
    }
    function validarCambio() {
        if (document.getElementById('contraseña1').value === '' && document.getElementById('contraseña2').value === '') {
            alert('los campos son obligatorios para guardar su contraseña');
            return false;
        }
        var identicas = (document.getElementById('contraseña1').value == document.getElementById('contraseña2').value);
        if (!identicas) {
            alert('Las contraseñas no coinciden, por favor digite de forma correcta la contraseña');
            return false;
        }
    }
    function desplegar() {
        $("#btnCambiarContraseña").click(function () {
            $('#cambiarContraseña').toggle();
        });
    }
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
    //consulta de usuario si ya esta registrado
    function consultar(usuario) {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', './Clases/Usuario.php', true);
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onreadystatechange = function() {
		if(this.readyState === 4 && this.status===200) {
			if(this.responseText!=''){
                            alert('El usuario con la identificacion #'+usuario+' ya esta registrado');
                            $('.btn-raised').hide();
                        }else $('.btn-raised').show();
		}
	}
	xhr.send('usuario='+usuario);

}
    
</script>	