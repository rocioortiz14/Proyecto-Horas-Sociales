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
                  <h3> Sobre la Desarrolladora</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio.php"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item active">Desarrolladora</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
            <div class="col-12 mt-3">
              <div class="alert alert-primary" role="alert"> Hay dos formas de realizar el diseño de una aplicación:
                La primera es el hacerlo tan sencillo que sea obvio para todos que no tiene deficiencias y
                 la segunda es el hacerlo tan complicado que no queden deficiencias obvias”. Tony Hoare
              </div>

              <div class="col-12 mt-2">
                <div class="alert alert-primary text-center">
                  <strong>INFORMACIÓN DE LA DESARROLLADORA</strong>
                </div>
                <div class="clearfix">
                  <img src="imagenes/rocio.jpeg" class="col-md-3 float-md-end mb-3 ms-md-3" alt="...">

                  <p>
                  <div class="d-flex flex-column bd-highlight mb-3">
                    <div class="p-2 bd-highlight"><strong>Nombre:</strong>    Gema Rocio Guadalupe Sanabria de Ochoa</div>
                    <div class="p-2 bd-highlight"><strong>Titulo:</strong>    Profesora de Educación Media Técnica para el Nivel de Educación Media y Básica.</div>
                    <div class="p-2 bd-highlight"><strong>Correo:</strong>    angelelcielo@gmail.com </div>
                    <div class="p-2 bd-highlight"><strong>Teléfono:</strong>  7258-5173</div>
                  </div>
                    <div class="d-flex flex-column bd-highlight mb-3 bg-dark text-white">
                      <div class="p-2 bd-highlight"><strong>IMPORTANTE:</strong></div>
                      <div class="p-2 bd-highlight">
                          Por último, el código  fuente del software informático para la Tienda de
                          Productos Básicos anexa a la empresa SOLECON ELECTRIC;
                          denominado (SYSINVENTORY), será de uso exclusivo de la empresa SOLECON ELECTRIC de San Miguel,
                          para la creación de nuevos módulos al software en cuestión,  pero no será de uso y comercialización
                          a otras instituciones o empresas externas, ya que el código fuente es una parte del programa  del ordenador
                          y pertenece como el resto de las partes, de entrada a su autor, a su creador y en su terminologia a la desarrolladora.
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->

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
