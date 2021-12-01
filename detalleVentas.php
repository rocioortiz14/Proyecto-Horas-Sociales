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

          <?php if ($_SESSION["permiso"] == 1 || $_SESSION["permiso"] == 2) { ?>

          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h3> Detalle de ventas</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio.php"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item"><a href="ventas.php" class="text-dark">Compras</a></li>
                    <li class="breadcrumb-item">Detalles</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                  <a href="#" class="btn btn-primary btn-md imprimir"> <i class="fa fa-print"></i> Imprimir comprobante</a>
                  <hr>
                  <div class="card" id="invoiceF">
                      <?php
                          $idVenta = $_GET['identificador'];
                          $query2 = "SELECT
                                    v.v_id,
                                    v.v_fecha,
                                    cl.cliente_Nombre,
                                    cl.cliente_Telefono,
                                    cl.cliente_Correo,
                                    v.v_comprobante,
                                    v.v_serie,
                                    v.v_numero
                                    FROM tbl_venta AS v
                                    LEFT JOIN tbl_clientes AS cl ON v.v_cliente = cl.cliente_Id
                                    WHERE v.v_id = :idVenta";
                          $cabezera = $conexion -> prepare($query2);
                          $cabezera -> execute(['idVenta' => $idVenta]);
                          $cabezeraR = $cabezera -> fetch();
                      ?>
                      <div class="row">
                          <div class="col-4 mt-5">
                              <center>
                                  <img src="imagenes/uploads/<?php echo $resultado[12]; ?>" alt="logo" class="img img-fluid">
                              </center>
                          </div>
                          <div class="col-8 mt-5">
                              <h3 class="text-center"><?php echo $resultado[1]; ?></h3>
                              <h5 class="text-center"><?php echo $resultado[7]; ?></h5>
                              <h6 class="text-center font-italic"><?php echo 'CORREO: '.$resultado[8].' - TELÉFONO: '.$resultado[3]; ?></h6>
                          </div>
                          <div class="col-12"><hr></div>
                          <div class="col-3 mt-2">
                            <h6 class="text-center">COMPROBANTE: <?php echo $cabezeraR[5]; ?>.</h6>
                          </div>
                          <div class="col-3 mt-2">
                            <h6 class="text-center">FECHA: <?php echo $cabezeraR[1]; ?>.</h6>
                          </div>
                          <div class="col-3 mt-2">
                            <h6 class="text-center">SERIE: <?php echo $cabezeraR[6]; ?>.</h6>
                          </div>
                          <div class="col-3 mt-2">
                            <h6 class="text-center">NÚMERO: <?php echo $cabezeraR[7]; ?>.</h6>
                          </div>
                          <div class="col-12"><hr></div>
                          <div class="col-12">
                            <h6 class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              CLIENTE: <?php echo $cabezeraR[2]; ?></h6>
                          </div><!--
                          <div class="col-5">
                            <h6 class="text-justify"> NIT: <?php #echo $cabezeraR[3]; ?>.</h6>
                          </div> -->
                          <div class="col-7">
                            <h6 class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              TELÉFONO: <?php echo $cabezeraR[3]; ?>.</h6>
                          </div>
                          <div class="col-5">
                            <h6 class="text-justify">CORREO: <?php echo $cabezeraR[4]; ?></h6>
                          </div>
                          <div class="col-12"><hr></div>
                          <center>
                              <div class="col-11 mt-2">
                                  <table class="table table-bordered table-hover">
                                      <thead>
                                          <th class="text-center">N°</th>
                                          <th class="text-center">CÓDIGO</th>
                                          <th class="text-center">PRODUCTO</th>
                                          <th class="text-center">CANTIDAD</th>
                                          <th class="text-center">VALOR UNITARIO (USD)</th>
                                          <th class="text-center">VALOR TOTAL (USD)</th>
                                      </thead>
                                      <tbody>
                                          <?php
                                              $query3 = "SELECT DISTINCT
                                                        p.p_codigo,
                                                        p.p_producto,
                                                        p.p_pv as pc,
                                                        vd.vd_qty,
                                                        v.v_stot,
                                                        v.v_iva,
                                                        vd.vd_stot,
                                                        v.v_ttl
                                                        FROM tbl_venta_detalle AS vd
                                                        LEFT JOIN tbl_venta AS v ON vd.vd_venta = v.v_id
                                                        LEFT JOIN tbl_productos AS p ON vd.vd_producto = p.p_id
                                                        WHERE vd.vd_venta = :idVenta";
                                              $detalle = $conexion -> prepare($query3);
                                              $detalle -> execute(['idVenta' => $idVenta]);
                                              $detalleR = $detalle -> fetchAll();
                                              $contador = 1;
                                              #$totalF = 0;
                                              foreach ($detalleR as $datos) {
                                                  echo '<tr>';

                                                    echo '<td class="text-center">' . $contador . '</td>';
                                                    echo '<td class="text-center">' . $datos[0] . '</td>';
                                                    echo '<td class="text-justify">' . $datos[1] . '</td>';
                                                    echo '<td class="text-center">' . $datos[3] . '</td>';
                                                    echo '<td class="text-center">$' . $datos[2] . '</td>';
                                                    echo '<td class="text-center">$' . $datos[6] . '</td>';
                                                echo '</tr>';
                                                #$totalF = $totalF + $datos[6];
                                                $contador = $contador + 1;
                                              }
                                          ?>
                                          <tr>
                                            <th class="text-end" colspan="5">TOTAL PARCIAL:</th>
                                            <th class="text-center">$<?php echo $datos[4]; ?></th>
                                          </tr>
                                          <tr>
                                            <th class="text-end" colspan="5">IVA(13%):</th>
                                            <th class="text-center">$<?php echo $datos[5]; ?></th>
                                          </tr>
                                      </tbody>
                                      <tfoot>
                                      <th class="text-end" colspan="5">TOTAL FACTURA:</th>
                                        <th class="text-center">$<?php echo $datos[7]; ?></th>
                                      </tfoot>
                                  </table><br><br>
                              </div>
                          </center>
                      </div>
                  </div>
              </div>
            </div>
          </div>

          <?php } ?>

          <!-- Container-fluid Ends-->
        </div>
        <?php include 'secciones/pie-pagina.php'; // Incluimos el pie de pagina de la plantilla. ?>
      </div>
    </div>
    <?php include 'secciones/scripts.php'; // Incluimos los archivos js a la plantilla. ?>
    <script src="assets/js/scrollbar/simplebar.js"></script>
    <script src="assets/js/scrollbar/custom.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        // Imprimimos invoice de ìndice de libro de especies municipales.
        $(".imprimir").click(function() {

            var nombreDiv = 'invoiceF';
            var contenido = document.getElementById(nombreDiv).innerHTML;
            var contenidoOriginal= document.body.innerHTML;
            document.body.innerHTML = contenido;
            if (window.print()) {
                document.body.innerHTML = contenidoOriginal;
            } else {
                location.reload();
            }

        });
    });
    </script>
  </body>
</html>
