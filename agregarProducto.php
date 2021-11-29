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
                  <h3> Agregar producto</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio.php"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item"><a href="productos.php" class="text-secondary">Productos</a></li>
                    <li class="breadcrumb-item active">Agregar</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <form class="" action="" method="post" id="formAProducto">
              <div class="row">
                <div class="col-12">
                  <div class="alert alert-light">
                    <i class="fa fa-warning"></i> Los que tienen (*), son requisito rellenarlos!
                  </div>
                </div>
                <div class="col-3">
                  <img src="imagenes/cargar.png" class="img img-fluid" alt="" title="Imagen sin cargar...">
                </div>
                <div class="col-5">
                  <div class="form-group">
                    <label for="" class="form-label">Producto(*): </label>
                    <input type="text" class="form-control" name="inputProducto" id="inputProducto">
                  </div>
                  <div class="form-group mt-2">
                    <label for="" class="form-label">Descripción(*): </label>
                    <textarea name="inputDesc" id="inputDesc" class="form-control"></textarea>
                  </div>
                  <div class="form-group mt-2">
                      <label for="clientes" class="form-label">Categoria(*): </label>
                      <select class="form-control select2 text-dark" name="inputCategoria" id="inputCategoria" style="width: 100%;">
                          <option value="">Seleccionar...</option>
                          <?php
                              $stmt1 = $conexion -> query("SELECT * FROM tbl_categorias");
                              // and somewhere later:
                              while ($data = $stmt1-> fetch()) {
                                  echo '<option class="text-white" value="'.$data[0].'">'.$data[0].' | '.$data[1].' '.$data[2].'</option>';
                              }
                          ?>
                      </select>
                  </div>
                  </div>
                <div class="col-4">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="" class="form-label">Presentacion(*): </label>
                        <select class="select2 form-control" name="inputPresentacion" id="inputPresentacion" style="width: 100%;">
                            <option value=''>Seleccionar...</option>
                            <?php
                              $estado = array('','UNIDAD','DOCENA','CAJA','ONZA','LIBRA','KILOGRAMO','QUINTAL','SACO','LITRO','GALON');
                              $array = $estado;
                              for ($k=1; $k<sizeof($array); $k++)
                              {
                                echo "<option value='$k'>". $array[$k] . "</option>";
                              }
                            ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-8">
                      <div class="form-group mt-4">
                        <label for="" class="form-label">Codigo: </label>
                        <input type="text" class="form-control" name="inputCodigo" id="inputCodigo">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group mt-4">
                        <label for="" class="form-label">Stock inicial: </label>
                        <input type="text" class="form-control" name="inputStockIni" id="inputStockIni">
                      </div>
                    </div>
                    <!-- <div class="col-4" hidden>
                      <div class="form-group mt-2">
                        <label for="" class="form-label">Producto perecedero: </label>
                      </div>
                      <div class="form-group media-body icon-state">
                        <label class="switch float-start">
                          <input type="checkbox" id="inputCheck" name="inputCheck" value="1">
                          <span class="switch-state bg-primary"></span>
                        </label>
                      </div>
                    </div>
                    <div class="col-8" hidden>
                      <div class="form-group mt-2">
                        <label for="" class="form-label">Fecha caducidad: </label>
                        <input type="date" class="form-control" name="inputFecha" id="inputFecha" disabled>
                      </div>
                    </div> -->
                    <div class="form-group mt-4">
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Cargar imagen de la empresa: </label><br>
                            <input type="file" class="form-control-file" id="inputImagen" name="inputImagen">
                        </div>
                    </div>

                  </div>
                </div>
                <div class="col-12 mt-5">
                    <input type="hidden" name="action" value="insert">
                    <a href="#" class="btn btn-primary pull-right btn-lg" id="guardar" name="guardar"> <i class="fa fa-save"></i> Guardar</a>
                </div>
              </div>
            </form>
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
    <script src="ajax/ajaxProducto.js" charset="utf-8"></script>
  </body>
</html>
