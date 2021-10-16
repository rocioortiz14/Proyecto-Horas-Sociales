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
  <body class="bg-light">
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
      <div class="content bg-light">
          <div class="mx-auto col-11">
              <div class="row">
                  <div class="col-3 mt-4">
                      <a href="ventas.php" class="btn btn-info btn-sm"> <i class="fa fa-reply"></i> REGRESAR</a>
                  </div>
                  <div class="col-9 mt-4">
                      <a href="#" class="btn btn-danger btn-sm float-end"> <strong>(F2)</strong> FACTURAR</a>
                      <a href="#" class="btn btn-success btn-sm float-end me-1" id="btnAdd" data-bs-toggle="modal" data-bs-target="#agregarClModal"> <strong>(F1)</strong> REGISTRAR CLIENTE</a>
                  </div>
                  <div class="col-4 mt-3">
                      <div class="form-group">
                          <label for="clientes" class="fw-bold text-dark">Clientes(*): </label>
                          <select class="form-control js-example-theme-single text-dark" name="clientes" id="clientes" style="width: 100%;">
                              <option value="">Seleccionar...</option>
                              <?php
                                  $stmt1 = $conexion -> query("SELECT * FROM tbl_clientes");
                                  // and somewhere later:
                                  while ($data = $stmt1-> fetch()) {
                                      echo '<option class="text-white" value="'.$data[0].'">'.$data[0].' | '.$data[1].' '.$data[2].'</option>';
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
                          <label for="fechaC" class="fw-bold text-dark">Fecha venta(*): </label>
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
                          <label for="numero" class="fw-bold text-dark">N° de venta: </label>
                          <input class="form-control form-control-md" type="text" name="numero" id="numero">
                      </div>
                  </div>
                  <div class="col-6 mt-3">
                      <div class="form-group">
                          <input class="form-control form-control-md" type="text" name="buscadorP" id="buscadorP" placeholder="Seleccione productos...">
                      </div>
                  </div>
                  <div class="col-4 mt-3">
                      <div class="form-group">
                          <a href="#" class="btn btn-success btn-md float-start"> <strong>(ENTER)</strong> CARGAR PRODUCTOS</a>
                      </div>
                  </div>
                  <div class="col-1 mt-3">
                        <label class="text-dark fw-bold float-end mt-2">IVA:</label>
                  </div>
                  <div class="col-1 mt-3">
                      <div class="form-group media-body icon-state">
                        <label class="switch float-start"><input type="checkbox" checked="" data-bs-original-title="" title=""><span class="switch-state bg-primary"></span></label>
                      </div>
                  </div>
                  <div class="col-9 mt-3">
                      <table class="table table-sm table-responsive">
                          <thead class="table-secondary">
                            <tr>
                              <th class="text-center" scope="col">#</th>
                              <th class="text-left" scope="col">Producto</th>
                              <th class="text-center" scope="col">Cantidad</th>
                              <th class="text-center" scope="col">Precio venta</th>
                              <th class="text-center" scope="col">Sub-total</th>
                              <th class="text-center" scope="col"></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th style="width: 3%;" scope="row">1</th>
                              <td style="width: 55%;">Maisena</td>
                              <td style="width: 10%;"> <input class="form-control form-control-sm" type="text" name=""> </td>
                              <td style="width: 14%;"> <input class="form-control form-control-sm" type="text" name=""> </td>
                              <td style="width: 15%;">$ </td>
                              <td style="width: 3%;"> <a href="#" class="text-danger"> <i class="fa fa-trash fa-lg"></i> </a> </td>
                            </tr>
                            <tr>
                              <th style="width: 3%;" scope="row">1</th>
                              <td style="width: 55%;">Azucar</td>
                              <td style="width: 10%;"> <input class="form-control form-control-sm" type="text" name=""> </td>
                              <td style="width: 14%;"> <input class="form-control form-control-sm" type="text" name=""> </td>
                              <td style="width: 15%;">$ </td>
                              <td style="width: 3%;"> <a href="#" class="text-danger"> <i class="fa fa-trash fa-lg"></i> </a> </td>
                            </tr>
                            <tr>
                              <th style="width: 3%;" scope="row">1</th>
                              <td style="width: 55%;">Sal</td>
                              <td style="width: 10%;"> <input class="form-control form-control-sm" type="text" name=""> </td>
                              <td style="width: 14%;"> <input class="form-control form-control-sm" type="text" name=""> </td>
                              <td style="width: 15%;">$ </td>
                              <td style="width: 3%;"> <a href="#" class="text-danger"> <i class="fa fa-trash fa-lg"></i> </a> </td>
                            </tr>
                          </tbody>
                      </table>
                      <hr class="text-success">
                      <center>
                          <a href="#" class="btn btn-sm btn-info-gradien"> LIMPIAR CESTA</a>
                          <a href="javascript:location.reload();" class="btn btn-sm btn-primary-gradien"> ACTUALIZAR</a>
                      </center>
                  </div>
                  <div class="col-3 mt-3">
                    <div class="alert" style="background-color: #e5e5e5;">
                        <p><strong class="text-dark">Cantidad productos: </strong> <em class="float-end text-dark">3</em> </p>
                        <p><strong class="text-dark">Valor de la venta: </strong> <em class="float-end text-dark">$</em> </p>
                        <p><strong class="text-dark">IVA(%): </strong> <em class="float-end text-dark">$</em> </p>
                    </div>
                    <div class="alert" role="alert" style="background-color: #afafaf;">
                        <p><strong class="text-dark">Total a pagar: </strong> <em class="float-end">$</em> </p>
                    </div>
                  </div>
              </div>
          </div>
      </div>
      <?php include 'modales/agregarCliente.php'; // Incluimos los archivos js a la plantilla. ?>
      <?php include 'secciones/scripts.php'; // Incluimos los archivos js a la plantilla. ?>
      <script src="ajax/ajaxVenta.js"></script>
  </body>
</html>
