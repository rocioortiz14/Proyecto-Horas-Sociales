<?php
    // Requerimos el archivo de control de sesiones.
    include 'configuracion/sesion.php';
    // Requerimos el archivo de administracion multimedia de la empresa.
    include 'configuracion/multimedia.php';
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

          <?php if ($_SESSION["permiso"] == 1) { ?>

          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h3> Administracion de usuarios</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio.php"><i data-feather="home"></i></a> Panel principal</li>
                    <li class="breadcrumb-item active"> Usuarios</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <a href="#" class="btn btn-primary btn-md" id="btnAdd" data-bs-toggle="modal" data-bs-target="#agregarUModal"><i class="fa fa-plus"></i> Agregar usuario</a>
                <hr>
                <div class="table-responsive-sm" id="mostrarTablaUsuarios"></div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->

          <?php } ?>
          
        </div>
        <?php include 'secciones/pie-pagina.php'; // Incluimos el pie de pagina de la plantilla. ?>
      </div>
    </div>
    <?php
        include 'modales/agregarUsuario.php';
        include 'modales/editarUsuario.php';

        include 'secciones/scripts.php'; // Incluimos los archivos js a la plantilla. ?>
        <script src="assets/js/scrollbar/simplebar.js"></script>
        <script src="assets/js/scrollbar/custom.js"></script>
    <script src="ajax/ajaxUsuario.js" charset="utf-8"></script>
  </body>
</html>
