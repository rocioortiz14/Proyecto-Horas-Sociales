<?php
    // Requerimos el archivo de control de sesiones.
    include 'configuracion/sesion.php';
    // Requerimos el archivo de administracion multimedia de la empresa.
    include 'configuracion/multimedia.php';
    $expt1 = 1;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'secciones/cabezera.php'; // Incluimos los estilos a la plantilla ?>
  </head>
  <body class="bg-light">

    <?php if ($_SESSION["permiso"] == 1 || $_SESSION["permiso"] == 2) { ?>

    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
      <div class="content bg-light">
          <div class="mx-auto col-11">
              <div class="row">
                  <div class="col-3 mt-4">
                      <a href="compras.php" class="btn btn-info btn-sm"> <i class="fa fa-reply"></i> REGRESAR</a>
                  </div>
                  <div class="col-9 mt-4">
                      <a id="facturar" class="btn btn-danger btn-sm float-end"> <strong>(F2)</strong> FACTURAR</a>
                      <a id="nuevoProveedor" class="btn btn-success btn-sm float-end me-1" data-bs-toggle="modal" data-bs-target="#agregarPrvModal"> <strong>(F3)</strong> REGISTRAR PROVEEDOR</a>
                  </div>
                  <div class="col-4 mt-3">
                      <div class="form-group">
                          <label for="proveedores" class="fw-bold text-dark">Provedor(*): </label>
                          <select class="form-control select2 text-dark" name="proveedores" id="proveedores" style="width: 100%;">
                              <option value="">Seleccionar...</option>
                              <?php
                                  $stmt1 = $conexion -> query("SELECT * FROM tbl_proveedores");
                                  // and somewhere later:
                                  while ($data = $stmt1-> fetch()) {
                                      echo '<option class="text-white" value="'.$data[0].'">'.$data[1].' | '.$data[3].'</option>';
                                  }
                              ?>
                          </select>
                      </div>
                  </div>
                  <div class="col-2 mt-3">
                      <div class="form-group">
                          <label for="comprobante" class="fw-bold text-dark">Comprobante(*): </label>
                          <input class="form-control form-control-md" type="text" name="comprobante" id="comprobante" value="FACTURA" placeholder="FACTURA" disabled>
                      </div>
                  </div>
                  <div class="col-2 mt-3">
                      <div class="form-group">
                          <label for="fechaC" class="fw-bold text-dark">Fecha compra(*): </label>
                          <input class="form-control form-control-md" type="date" name="fechaC" id="fechaC">
                      </div>
                  </div>
                  <div class="col-2 mt-3">
                      <div class="form-group">
                          <label for="serie" class="fw-bold text-dark">Serie: </label>
                          <input class="form-control form-control-md" type="text" name="serie" id="serie">
                      </div>
                  </div>
                  <div class="col-2 mt-3">
                      <div class="form-group">
                          <label for="numero" class="fw-bold text-dark">N° de compra: </label>
                          <input class="form-control form-control-md" type="text" name="numero" id="numero">
                      </div>
                  </div>
                  <div class="col-6 mt-3">
                      <div class="form-group">
                        <select class="form-control select2 text-dark" name="productos" id="productos" style="width: 100%;">
                            <option value="">Seleccionar...</option>
                            <?php
                                $stmt1 = $conexion -> query("SELECT * FROM tbl_productos");
                                // and somewhere later:
                                while ($data = $stmt1-> fetch()) {
                                    echo '<option class="text-white" value="'.$data[0].'" data-nombre="'.$data[1].'">'.$data[1].' | '.$data[5].'</option>';
                                }
                            ?>
                        </select>
                      </div>
                  </div>
                  <div class="col-4 mt-3">
                      <div class="form-group">
                          <!-- <a href="#" class="btn btn-success btn-md float-start"> <strong>(ENTER)</strong> CARGAR PRODUCTOS</a> -->
                      </div>
                  </div>
                  <div class="col-1 mt-3">
                        <label class="text-dark fw-bold float-end mt-2">IVA:</label>
                  </div>
                  <div class="col-1 mt-3">
                      <div class="form-group media-body icon-state">
                        <label class="switch float-start"><input id="is_iva" type="checkbox" checked="" data-bs-original-title="" title=""><span class="switch-state bg-primary"></span></label>
                      </div>
                  </div>
                  <div class="col-9 mt-3">
                      <table class="table table-sm table-responsive">
                          <thead class="table-secondary">
                            <tr>
                              <th class="text-center" scope="col">#</th>
                              <th class="text-left" scope="col">Producto</th>
                              <th class="text-center" scope="col">Cantidad</th>
                              <th class="text-center" scope="col">Precio compra</th>
                              <th class="text-center" scope="col">Precio venta</th>
                              <th class="text-center" scope="col">Sub-total</th>
                              <th class="text-center" scope="col">Vencimiento</th>
                              <th class="text-center" scope="col"></th>
                            </tr>
                          </thead>
                          <tbody id="listaProductos">
                          </tbody>
                      </table>
                      <hr class="text-success">
                      <center>
                          <a id="clean_table" class="btn btn-sm btn-info-gradien"> LIMPIAR CESTA</a>
                          <a href="javascript:location.reload();" class="btn btn-sm btn-primary-gradien"> RECARGAR</a>
                      </center>
                  </div>
                  <div class="col-3 mt-3">
                    <div class="alert" style="background-color: #e5e5e5;">
                        <p><strong class="text-dark">Cantidad productos: </strong> <em class="float-end text-dark" id="tqty">0</em> </p>
                        <p><strong class="text-dark">Valor de la compra: </strong> <em class="float-end text-dark" id="tpc">$</em> </p>
                        <p><strong class="text-dark">IVA(%): </strong> <em class="float-end text-dark" id="tiva">$</em> </p>
                    </div>
                    <div class="alert" role="alert" style="background-color: #afafaf;">
                        <p><strong class="text-dark">Total a pagar: </strong> <em class="float-end" id="ttl">$</em> </p>
                    </div>
                  </div>
              </div>
          </div>
      </div>
      <?php include 'modales/agregarProveedores.php'; ?>

      <?php } ?>

      <?php include 'secciones/scripts.php'; // Incluimos los archivos js a la plantilla. ?>
      <script src="ajax/ajaxCompra.js"></script>
  </body>
</html>
