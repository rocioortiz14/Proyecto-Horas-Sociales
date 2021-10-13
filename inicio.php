<?php
    // Requerimos el archivo de control de sesiones.
    include 'configuracion/sesion.php';
    // Requerimos el archivo de administracion multimedia de la empresa.
    include 'configuracion/multimedia.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'secciones/cabezera.php'; // Incluimos los estilos a la plantilla ?>
  </head>
  <body>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <?php include 'secciones/menu-superior.php'; // Incluimos el pie de pagina de la plantilla. ?>
      <!-- Page Body Start -->
      <div class="page-body-wrapper">
        <?php include 'secciones/menu-lateral.php'; // Incluimos el pie de pagina de la plantilla. ?>
        <!-- DETALLE DEL MODULO EN UTILIZACION -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h3> Panel principal</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio.php"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Inicio</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- GENERAR FACTURA DE VENTA -->
              <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                <a href="generar-ventas.php">
                  <div class="card o-hidden">
                    <div class="card-body">
                      <div class="ecommerce-widgets media">
                        <div class="media-body">
                          <p class="f-w-500 font-roboto text-secondary">GENERAR<span class="badge pill-badge-primary ms-3">Venta</span></p>
                          <h4 class="f-w-500 mb-0 f-20"><span class="counter text-dark">FACTURAR</span></h4>
                        </div>
                        <div class="ecommerce-box light-bg-primary"><i class="fa fa-dollar text-primary" aria-hidden="true"></i></div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <!-- GENERAR FACTURA DE COMPRA -->
              <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                <a href="generar-compras.php">
                  <div class="card o-hidden">
                    <div class="card-body">
                      <div class="ecommerce-widgets media">
                        <div class="media-body">
                          <p class="f-w-500 font-roboto text-secondary">GENERAR<span class="badge pill-badge-danger ms-3">Compra</span></p>
                          <h4 class="f-w-500 mb-0 f-20"><span class="counter text-dark">FACTURAR</span></h4>
                        </div>
                        <div class="ecommerce-box light-bg-primary"><i class="fa fa-dollar text-danger" aria-hidden="true"></i></div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <!-- GCONSULTAR PRODUCTO -->
              <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                <a href="#">
                  <div class="card o-hidden">
                    <div class="card-body">
                      <div class="ecommerce-widgets media">
                        <div class="media-body">
                          <p class="f-w-500 font-roboto text-secondary">CONSULTAR<span class="badge pill-badge-success ms-3">Producto</span></p>
                          <h4 class="f-w-500 mb-0 f-20"><span class="counter text-dark">DETALLE</span></h4>
                        </div>
                        <div class="ecommerce-box light-bg-primary"><i class="fa fa-star-o text-success" aria-hidden="true"></i></div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <!-- ADMINISTRAR INVENTARIO -->
              <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                <a href="#">
                  <div class="card o-hidden">
                    <div class="card-body">
                      <div class="ecommerce-widgets media">
                        <div class="media-body">
                          <p class="f-w-500 font-roboto text-secondary">ADMINISTRAR<span class="badge pill-badge-warning ms-3">Almacen</span></p>
                          <h4 class="f-w-500 mb-0 f-20"><span class="counter text-dark">INVENTARIO</span></h4>
                        </div>
                        <div class="ecommerce-box light-bg-primary"><i class="fa fa-cubes text-warning" aria-hidden="true"></i></div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <?php include 'secciones/pie-pagina.php'; // Incluimos el pie de pagina de la plantilla. ?>
      </div>
    </div>
    <?php include 'secciones/scripts.php'; // Incluimos los archivos js a la plantilla. ?>
  </body>
</html>
