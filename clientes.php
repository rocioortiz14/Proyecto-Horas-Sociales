<?php
  // Requerimos el archivo de control de sesiones.
  include 'configuracion/sesion.php';
?>
<!DOCTYPE html>
<html lang="es">
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
                  <h3> Administracion de clientes del sistema</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio.php"><i data-feather="home"></i></a> Panel principal</li>
                    <li class="breadcrumb-item active"> Clientes</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <a href="#" class="btn btn-primary btn-md" id="btnAdd" data-bs-toggle="modal" data-bs-target="#agregarClModal"> <i class="fa fa-plus"></i> Agregar Cliente</a>
                <hr>
                <div class="table-responsive-md" id="mostrarTablaClientes"></div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <?php include 'secciones/pie-pagina.php'; // Incluimos el pie de pagina de la plantilla. ?>
      </div>
    </div>
    <?php
      include 'modales/agregarCliente.php';
      include 'modales/editarCliente.php';
    ?>
    <?php include 'secciones/scripts.php'; // Incluimos los archivos js a la plantilla. ?>
    <script src="ajax/ajaxCliente.js" charset="utf-8"></script>
  </body>
</html>