<?php
require_once dirname(__FILE__) . '/../../Clases/Contactos.php';
require_once dirname(__FILE__) . '/../../Clases/Servicio.php';
require_once dirname(__FILE__) . '/../../Clases/ConectorBD.php';
foreach ($_GET as $variable => $valor)
    ${$variable} = $valor;
foreach ($_POST as $Variable => $Valor)
    ${$Variable} = $Valor;
$accion = 'Adicionar';
if ($accion == 'Adicionar')
    $servicio = new Contactos(null, null);
else
    $servicio = new Contactos(null, null);
?>

<section id="contact" class="contact">
    <div class="container">

        <div class="section-title">
            <h2 data-aos="fade-up">Contactenos</h2>
            <p data-aos="fade-up">Estamos ubicados en Pasto, Nariño, Colombia, Sur America.</p>
        </div>

        <div class="row justify-content-center">

            <div class="col-xl-4 col-lg-4 mt-4" data-aos="fade-up">
                <div class="info-box">
                    <i class="bx bx-map"></i>
                    <h3>Nuestra dirección</h3>
                    <p>Carrera 7 # 18 - 28 Venecia - Pasto - NAriño</p>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 mt-4" data-aos="fade-up" data-aos-delay="100">
                <div class="info-box">
                    <i class="bx bx-envelope"></i>
                    <h3>Email</h3>
                    <p>fundacioncreativida@gmail.com<br>www.fundacioncreativida.org</p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 mt-4" data-aos="fade-up" data-aos-delay="200">
                <div class="info-box">
                    <i class="bx bx-phone-call"></i>
                    <h3>Teléfonos</h3>
                    <p>182862222 - 3194521423</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="300">
            <div class="col-xl-9 col-lg-12 mt-4">
                <form class="form-a" name="frmContactos" onsubmit="return confirmar()" method="post" action="home.php?CONTENIDO=admon/contactos/contactosActualizar.php&accion=<?= $accion ?>" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-md-6 form-group">
                            <input type="text" name="nombres" class="form-control" id="name" value="<?= $servicio->getNombres() ?>" placeholder="Nombres" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <input type="number" name="telefono" class="form-control" id="telefono" value="<?= $servicio->getTelefono() ?>" placeholder="Teléfono" required>
                        </div>

                        <div class="form-group mt-3">
                            <input type="email" class="form-control" name="correo" id="email" value="<?= $servicio->getCorreo() ?>" placeholder="Correo" required>
                        </div>

                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="asunto" id="subject" value="<?= $servicio->getAsunto() ?>" placeholder="Asunto" required>
                        </div>

                        <div class="col-md-6 form-group mt-3">
                            <input type="number" name="numpersonas" class="form-control" id="numeropersonas" value="<?= $servicio->getNumpersonas() ?>" placeholder="Numero de personas" required>
                        </div>
                        <div class="col-md-6 form-group mt-3">
                            <select name="idservicio"  class="form-control"><?= Servicio::getDatosEnOptions($servicio->getIdservicio(), "estado='X'") ?> </select>
                            <!--         pediente buscador con libreria= class="selectpicker" data-live-search="true"-->
                        </div>

                        <div class="form-group mt-3">
                            <textarea class="form-control" name="mensaje" rows="5" placeholder=" Su mensaje" value="<?= $servicio->getMensaje() ?>"required ></textarea>
                        </div>

                        <input type="hidden" name="id" value="<?= $servicio->getId() ?>">
                        <div class="col-md-12">
                            <div class="text-center">
                                <br>

                                <button type="submit" value="<?= $accion ?>" name="accion" onclick=""  class="btn btn-success btn-raised " <?= $accion ?>><i class="zmdi zmdi-floppy"></i> Guardar</button>
                            </div>
                            <!--                    onclick="confirmar()" -->
                        </div>
                    </div>
                </form>
            </div>

        </div>
</section><!-- End Contact Section -->
<script>

    function confirmar() {

        Swal.fire({
            title: 'Desea realmente Confirmar su solicitud',
            // text: "Desea realmente Corfirmar su pedido!",
            icon: 'alert',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar'

        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: 'Su información se ha enviado correctamente',
                    showConfirmButton: false,
                    timer: 1500
                }).then(()=>{document.frmContactos.submit();});
                            }
        })
        return false;

    }

</script>