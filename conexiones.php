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
    <link rel="stylesheet" href="assets/css/timeline.css">
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
                  <h3> Conexiones al sistema</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio.php"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Sesiones</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
              <div class="col-12">
                  <div class="timeline">
                      <?php
                          $cargar = $conexion -> prepare("SELECT i.i_id, e.e_nombre, u.u_usuario, e.e_correo, e.e_cargo, i.i_ip, i.i_crear, i.i_actualizar
                                                          FROM tbl_ip AS i
                                                          LEFT JOIN tbl_usuarios AS u ON i.i_id_user = u.u_id
                                                          LEFT JOIN tbl_empleados AS e ON u.u_empleado = e.e_id
                                                          ORDER BY i.i_id DESC");
                          $cargar -> execute();
                          $arrayDatos = $cargar -> fetchAll();
                          $contador = 1;

                          foreach ($arrayDatos as $datos) {
                      ?>
                              <div class="timeline__event animated fadeInUp delay-3s timeline__event--type<?php echo $contador; ?>">
                                    <div class="timeline__event__icon ">
                                      <?php
                                          if ($datos[6] == $datos[7]) {
                                            echo '<i class="text-white fa fa-spin fa-circle-o-notch"></i>';
                                          } else {
                                            echo '<i class="text-white fa fa-check-circle"></i>';
                                          }
                                      ?>
                                  </div>
                                  <div class="timeline__event__date text-center">
                                      <?php
                                          if ($datos[6] == $datos[7]) {
                                            echo 'EN SESIÓN';
                                          } else {
                                            echo 'SESIÓN <br> FINALIZADA';
                                          }
                                      ?>
                                  </div>
                                  <div class="timeline__event__content ">
                                    <div class="timeline__event__title"><?php echo $datos[0].' - '.$datos[2]; ?></div>
                                    <div class="timeline__event__description">
                                      <p><?php echo '<strong>Nombre: </strong> '.$datos[1].'. - <strong>Correo: </strong> '.$datos[3].'.'; ?></p>
                                      <p><?php echo '<strong>Cargo: </strong> '.$datos[4].'. - <strong>Ip desde donde se conecta: </strong> '.$datos[5].'.'; ?></p>
                                      <?php
                                          if ($datos[6] == $datos[7]) {
                                            echo '<strong>Inicio de sesion: </strong> '.$datos[6].'.';
                                          } else {
                                            echo '<strong>Inicio de sesion: </strong> '.$datos[6].'. - <strong>Cierre de sesion: </strong> '.$datos[7].'.';
                                          }
                                      ?>
                                    </div>
                                  </div>
                              </div>
                      <?php
                            $contador = $contador + 1;
                            if ($contador == 4) {
                                $contador = 1;
                            }
                        } ?>
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
