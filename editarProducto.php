<?php
    // Requerimos el archivo de control de sesiones.
    include 'configuracion/sesion.php';
    // Requerimos el archivo de administracion multimedia de la empresa.
    include 'configuracion/multimedia.php';
    // Capturamos id del producto.
    $id = $_GET['identificador'];
    // Definimos sentencia SQL de consulta de detalles del producto.
    $sql = 'SELECT p.p_producto, p.p_desc, c.c_nombre, p.p_presentacion, p.p_codigo, p.p_stock, p.p_imagen FROM tbl_productos AS p LEFT JOIN tbl_categorias AS c ON p.p_categoria = c.c_id WHERE p.p_id = :id';
    $mostrar = $conexion -> prepare($sql);
    $mostrar -> execute(['id' => $id]);
    $resultado = $mostrar -> fetch();
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
                  <h3> Actualizar producto</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio.php"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item"><a href="productos.php" class="text-secondary">Productos</a></li>
                    <li class="breadcrumb-item active">Actualizar</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <form class="" action="" method="post" id="formEProducto">
              <div class="row">
                <div class="col-12">
                  <div class="alert alert-light">
                    <i class="fa fa-warning"></i> Los que tienen (*), son requisito rellenarlos!
                  </div>
                </div>
                <div class="col-3">
                  <img src="imagenes/uploads/<?php echo $resultado[6]; ?>" class="img img-fluid" alt="" title="Imagen sin cargar...">
                </div>
                <div class="col-5">
                  <div class="form-group">
                    <label for="" class="form-label">Producto(*): </label>
                    <input type="text" class="form-control" name="inputProducto1" id="inputProducto1" value="<?php echo $resultado[0]; ?>">
                  </div>
                  <div class="form-group mt-2">
                    <label for="" class="form-label">Descripción(*): </label>
                    <textarea name="inputDesc1" id="inputDesc1" class="form-control"><?php echo $resultado[1]; ?></textarea>
                  </div>
                  <div class="form-group mt-2">
                      <label for="clientes" class="form-label">Categoria actual(*): <b class="text-info"><?php echo $resultado[2]; ?></b></label>
                      <select class="form-control select2 text-dark" name="inputCategoria1" id="inputCategoria1" style="width: 100%;">
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
                        <?php
                             $identificador1 = $resultado[3];
                             $resultado1 = '';
                             $estado1 = array('','UNIDAD','DOCENA','CAJA','ONZA','LIBRA','KILOGRAMO','QUINTAL','SACO','LITRO','GALON');
                             $array1 = $estado1;
                             for ($k1=1; $k1<sizeof($array1); $k1++)
                             {
                               if ($identificador1 == $k1) {
                                 $resultado1 = $array1[$k1];
                               }
                             }
                        ?>
                        <label for="" class="form-label">Presentacion actual(*): <b class="text-info"><?php echo $resultado1;  ?></b></label>
                        <select class="select2 form-control" name="inputPresentacion1" id="inputPresentacion1" style="width: 100%;">
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
                        <input type="text" class="form-control" name="inputCodigo1" id="inputCodigo1" value="<?php echo $resultado[4]; ?>">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group mt-4">
                        <label for="" class="form-label">Stock inicial: </label>
                        <input type="text" class="form-control" name="inputStockIni1" id="inputStockIni1" value="<?php echo $resultado[5]; ?>">
                      </div>
                    </div>
                    <div class="form-group mt-4">
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Cargar imagen de la empresa(*): </label><br>
                            <input type="file" class="form-control-file" id="inputImagen1" name="inputImagen1">
                        </div>
                    </div>

                  </div>
                </div>
                <div class="col-12 mt-5">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="action" value="update">
                    <a href="#" class="btn btn-primary pull-right btn-lg" id="guardar2" name="guardar2"> <i class="fa fa-save"></i> Guardar</a>
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
