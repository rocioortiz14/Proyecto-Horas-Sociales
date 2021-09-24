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
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h3> Detalle de la empresa</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item active">Empresa</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-4 mt-3">
                  <div class="alert alert-primary text-center">
                    <strong>LOGO DE LA EMPRESA</strong>
                  </div>
                  <center><img src="imagenes/solecon.jpeg" alt="logo empresa" class="img img-fluid"></center>
              </div>
              <div class="col-8 mt-3">
                <div class="alert alert-primary text-center">
                  <strong>INFORMACIÓN DE LA EMPRESA</strong>
                </div>
                <form class="" method="post">
                  <div class="row">
                      <div class="col-8">
                          <div class="form-group">
                              <label for="">Empresa: </label>
                              <input type="text" name="empresa" id="empresa" class="form-control">
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="form-group">
                              <label for="">Eslogan: </label>
                              <input type="text" name="eslogan" id="eslogan" class="form-control">
                          </div>
                      </div>
                      <div class="col-8 mt-3">
                          <div class="form-group">
                              <label for="">Dirección: </label>
                              <input type="text" name="direccion" id="direccion" class="form-control">
                          </div>
                      </div>
                      <div class="col-4 mt-3">
                          <div class="form-group">
                              <label for="">Correo: </label>
                              <input type="email" name="correo" id="correo" class="form-control">
                          </div>
                      </div>
                      <div class="col-3 mt-3">
                          <div class="form-group">
                              <label for="">Teléfono 1: </label>
                              <input type="text" name="telefono1" id="telefono1" class="form-control">
                          </div>
                      </div>
                      <div class="col-3 mt-3">
                          <div class="form-group">
                              <label for="">Teléfono 2: </label>
                              <input type="text" name="telefono2" id="telefono2" class="form-control">
                          </div>
                      </div>
                      <div class="col-3 mt-3">
                          <div class="form-group">
                              <label for="">Móvil 1: </label>
                              <input type="text" name="movil1" id="movil1" class="form-control">
                          </div>
                      </div>
                      <div class="col-3 mt-3">
                          <div class="form-group">
                              <label for="">Móvil 2: </label>
                              <input type="text" name="movil2" id="movil2" class="form-control">
                          </div>
                      </div>
                      <div class="col-6 mt-3">
                          <div class="form-group">
                              <label for="">Razón social: </label>
                              <input type="text" name="razon" id="razon" class="form-control">
                          </div>
                      </div>
                      <div class="col-3 mt-3">
                          <div class="form-group">
                              <label for="">NRC: </label>
                              <input type="text" name="nrc" id="nrc" class="form-control">
                          </div>
                      </div>
                      <div class="col-3 mt-3">
                          <div class="form-group">
                              <label for="">NIT: </label>
                              <input type="text" name="nit" id="nit" class="form-control">
                          </div>
                      </div>
                      <div class="col-12 mt-3">
                          <div class="form-group">
                              <label for="exampleFormControlFile1">Cargar logo de la empresa: </label><br>
                              <input type="file" class="form-control-file" id="logo" name="logo">
                          </div>
                      </div>
                      <div class="col-12 mt-3">
                          <a href="#" class="btn btn-md btn-info"> Actualizar datos de la empresa</a>
                      </div>
                  </div>
                </form>
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
