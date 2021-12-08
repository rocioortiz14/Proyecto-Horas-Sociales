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

          <?php if ($_SESSION["permiso"] == 1 || $_SESSION["permiso"] == 2 || $_SESSION["permiso"] == 3) { ?>

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

              <?php if ($_SESSION["permiso"] == 1 || $_SESSION["permiso"] == 2) { ?>

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

              <?php } ?>

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

          <!-- Contenedor tabla productos en stock bajo y vendidos-->
          <div class="row">
              <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                <?php
                    $query = $conexion -> prepare("SELECT v.v_id, p.p_producto, SUM(v.v_qty)
                                                  FROM tbl_venta AS v
                                                  LEFT JOIN tbl_venta_detalle AS vd ON v.v_id = vd.vd_venta
                                                  LEFT JOIN tbl_productos AS p ON vd.vd_producto = p.p_id
                                                  GROUP BY v.v_id
                                                  ORDER BY SUM(v.v_qty) DESC
                                                  LIMIT 0 , 10");

                    $query -> execute();
                    $results = $query -> fetchall();

                    if (count($results) > 0) {
                ?>
                    <div class="alert alert-primary">
                        <center> <strong> PRODUCTOS MÁS VENDIDOS</strong> </center>
                    </div>
                    <table class="table table-hover table-sm" id="tblProductosMasVendidos">
                      <thead>
                        <th class="bg-primary text-white text-center" style="width: 10%;">ID</th>
                        <th class="bg-primary text-white text-center" style="width: 60%;">Producto</th>
                        <th class="bg-primary text-white text-center" style="width: 30%;">Cantidad</th>
                      </thead>
                      <tbody>
                <?php
                          foreach ($results as $datos) {
                              echo '<tr>';
                                echo '<td class="text-center">' . $datos[0] . '</td>';
                                echo '<td class="text-center">' . $datos[1] . '</td>';
                                echo '<td class="text-center">' . $datos[2] . '</td>';
                              echo ' </tr>';
                          }
                ?>
                      </tbody>
                    </table>
                <?php
                  } else{
                    echo '<div class="alert alert-primary" role="alert"> Sin productos vendidos!!!</div>';
                  }
                ?>
              </div>
              <div class="col-12 col-sm-8 col-md-8 col-lg-8">

              </div>
          </div>

          <?php } ?>

        </div>
        <?php include 'secciones/pie-pagina.php'; // Incluimos el pie de pagina de la plantilla. ?>
      </div>
    </div>
    <?php include 'secciones/scripts.php'; // Incluimos los archivos js a la plantilla. ?>
    <script src="assets/js/scrollbar/simplebar.js"></script>
    <script src="assets/js/scrollbar/custom.js"></script>
  </body>
</html>
