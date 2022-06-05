<?php
	date_default_timezone_set('America/Bogota');
	require_once dirname(__FILE__) . '/Clases/ConectorBD.php';
	require_once dirname(__FILE__) . '/Clases/Usuario.php';
	//require_once dirname(__FILE__) . '/Clases/Control.php';
	require_once dirname(__FILE__) . '/Clases/Rol.php';
	require_once dirname(__FILE__) . '/Clases/Menusis.php';

foreach ($_GET as $Variable => $Valor) {
	    ${$Variable} = $Valor;
	}

	foreach ($_POST as $Variable => $Valor) {
	    ${$Variable} = $Valor;
	}

	setlocale(LC_ALL, "es_ES@euro", "es_ES", "esp");
	ob_start();
	session_start(); //crea o mantiene la sesion, asi se tiene acceso a las variables de sesion creadas
	header('Content-Type: text/html; charset=utf-8'); //Corrige errores de acentos (tildes, y demas)
        
	if (!isset($_SESSION['usuario'])) {
           
	    $mensaje = "Sesion No Valida";
	    header("Location: index.php?mensaje=$mensaje");
	}

	date_default_timezone_set('America/Bogota');

	$user = unserialize($_SESSION['usuario']);
	$usuario= new Usuario('usuario', $user);
        
	$listaM = "";
	$menu = Menusis::getDatosEnObjetos('idpadre is null');

	for ($j = 0; $j < count($menu); $j++) {
	   $principal = $menu[$j];
            $listaM .= "<li class='nav-item'>";
            //$listaM .= "<a class='nav-link text-white ' href='{$principal->getLink_menusis()}'>";
            $listaM .= "<a class='nav-link text-white' href = '#' onClick='permiso({$principal->getIdmenusis()},{$user->getIdentificacion()},".'"'."{$principal->getLink_menusis()}".'"'.")'> {$principal->getMenusis()}";
            $listaM .= "<div class='text-white text-center me-2 d-flex align-items-center justify-content-center'>";
            $listaM .= "{$principal->getIcon()}";
            $listaM .= "</div>";
            //$listaM .= "<span class='nav-link-text ms-1'>{$principal->getMenusis()}</span>";
            $listaM .= "</a>";
            $listaM .= "</li>";
           //--------------------------------------
//	   $listaM .= "<li>";
//	   $listaM .= "<a href='#'>";
//	   $listaM .= "<i class='{$principal->getIcon()}'></i>";
//	   $listaM .= "<span class='menu-title'>{$principal->getMenusis()}</span>";
//	   $listaM .= "<i class='arrow'></i>";
//	   $listaM .= "</a>";
//	   $listaM .= "<!--Submenu-->";
//	   $listaM .= "<ul class='collapse'>";
//	   $submenu = "select * from menusis where idpadre={$principal->getIdmenusis()} order by orden";
//	   $datos1 = ConectorBD::ejecutarQuery($submenu, null);
//
//	   for ($t = 0; $t < count($datos1); $t++) {
//	   		$principal2 = $datos1[$t];
//       		$listaM .= "<li><a href='{$principal2[2]}'><i class='{$principal2[5]}'></i> {$principal2[1]}</a></li>";
//	   }

	  // $listaM .= "</ul>";
	   //$listaM .= "</li>";
	}
	//FIN DE MENU
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>
    Corporacion ASI
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="./assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Corporacion ASI</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="principal2.php?CONTENIDO=inicio.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Inicio</span>
          </a>
        </li>
        <?=$listaM?>
        
        
      </ul>
    </div>
    
  </aside>
    
         <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign In</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
   <?php include $_GET['CONTENIDO'] ?>
  </main>
    
    
    
    
    

  
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-icons py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Material UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3 d-flex">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <a class="btn btn-outline-dark w-100" href="">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/material-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
                      
  </div>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/chartjs.min.js"></script>
  <script src="dataTables/jquery-3.6.0.min.js" type="text/javascript"></script>
  
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/material-dashboard.min.js?v=3.0.2"></script>
  <script>
            
            
             function permiso(idmenu,idusuario,ruta ) {
                let request = $.ajax({
                    type: "POST",
                    url: "admon/OpcionAcceso/permisos.php",
                    data: {
                        menu: idmenu,
                        usuario: idusuario,
                        accion: "R",
                        
                    }
                });
                request.done(function (transporte) {
                    let transport = JSON.parse(JSON.stringify(transporte));
                    if (transport['flag'] === false) {
                        alert("el usuario no tiene permiso para la opcion seleccionada");
                        console.log(transport);
                        location = "principal2.php?CONTENIDO=inicio.php";
                    }else{
                        console.log(transport);
                        location = ruta+"&menu1="+transport['menu'];
                    }
                });
                request.fail(function (transporte){
                    let transport = JSON.parse(JSON.stringify(transporte));
                    alert("el usuario no tiene permiso para la opcion seleccionada");
                    console.log(transport);
                    location = "principal2.php?CONTENIDO=inicio.php";
                });
            }
//            function myFunction() {
//        $.ajax({
//          url: "php/notificaciones.php",
//          type: "POST",
//          processData:false,
//          success: function(data){
//            $("#notification-count").remove();                  
//            $("#notification-latest").show();$("#notification-latest").html(data);
//          },
//          error: function(){}           
//        });
//      }
                                 
         
        </script>
        
</body>

</html>