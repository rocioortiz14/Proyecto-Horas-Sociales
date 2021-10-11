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
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h3> Detalle de la empresa</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio.php"><i data-feather="home"></i></a></li>
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
                  <center><img src="imagenes/uploads/<?php echo $resultado[12]; ?>" alt="logo empresa" class="img img-fluid logoImg"></center>
                  <div class="alert alert-light mt-4">
                      <strong><i class="fa fa-info-circle"></i> </strong>Seleccionar imagen para logo de la empresa con tamano: 262 x 115.
                  </div>
              </div>
              <div class="col-8 mt-3">
                <div class="alert alert-primary text-center">
                  <strong>INFORMACIÓN DE LA EMPRESA</strong>
                </div>
                <form class="formGE" id="formGE" method="post" enctype="multipart/form-data">
                  <div class="row">
                      <div class="col-8">
                          <div class="form-group">
                              <label for="">Empresa: </label>
                              <input type="text" name="empresa" id="empresa" class="form-control" value="<?php echo $resultado[1]; ?>">
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="form-group">
                              <label for="">Eslogan: </label>
                              <input type="text" name="eslogan" id="eslogan" class="form-control" value="<?php echo $resultado[2]; ?>">
                          </div>
                      </div>
                      <div class="col-8 mt-3">
                          <div class="form-group">
                              <label for="">Dirección: </label>
                              <input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $resultado[7]; ?>">
                          </div>
                      </div>
                      <div class="col-4 mt-3">
                          <div class="form-group">
                              <label for="">Correo: </label>
                              <input type="email" name="correo" id="correo" class="form-control" value="<?php echo $resultado[8]; ?>">
                          </div>
                      </div>
                      <div class="col-3 mt-3">
                          <div class="form-group">
                              <label for="">Teléfono 1: </label>
                              <input type="text" name="telefono1" id="telefono1" class="form-control" value="<?php echo $resultado[3]; ?>">
                          </div>
                      </div>
                      <div class="col-3 mt-3">
                          <div class="form-group">
                              <label for="">Teléfono 2: </label>
                              <input type="text" name="telefono2" id="telefono2" class="form-control" value="<?php echo $resultado[4]; ?>">
                          </div>
                      </div>
                      <div class="col-3 mt-3">
                          <div class="form-group">
                              <label for="">Móvil 1: </label>
                              <input type="text" name="movil1" id="movil1" class="form-control" value="<?php echo $resultado[5]; ?>">
                          </div>
                      </div>
                      <div class="col-3 mt-3">
                          <div class="form-group">
                              <label for="">Móvil 2: </label>
                              <input type="text" name="movil2" id="movil2" class="form-control" value="<?php echo $resultado[6]; ?>">
                          </div>
                      </div>
                      <div class="col-6 mt-3">
                          <div class="form-group">
                              <label for="">Razón social: </label>
                              <input type="text" name="razon" id="razon" class="form-control" value="<?php echo $resultado[9]; ?>">
                          </div>
                      </div>
                      <div class="col-3 mt-3">
                          <div class="form-group">
                              <label for="">NRC: </label>
                              <input type="text" name="nrc" id="nrc" class="form-control" value="<?php echo $resultado[10]; ?>">
                          </div>
                      </div>
                      <div class="col-3 mt-3">
                          <div class="form-group">
                              <label for="">NIT: </label>
                              <input type="text" name="nit" id="nit" class="form-control" value="<?php echo $resultado[11]; ?>">
                          </div>
                      </div>
                      <div class="col-12 mt-3">
                          <div class="form-group">
                              <label for="exampleFormControlFile1">Cargar logo de la empresa: </label><br>
                              <input type="file" class="form-control-file" id="logo" name="logo">
                          </div>
                      </div>
                      <div class="col-12 mt-3">
                          <a href="#" class="btn btn-md btn-info btnGE"> Actualizar datos de la empresa</a>
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
    <script type="text/javascript">
        $(document).ready(function (e) {
            $(".btnGE").click(function(e) {
                e.preventDefault();
                var empresa = $('#empresa').val();
                var eslogan = $('#eslogan').val();
                var direccion = $('#direccion').val();
                var correo = $('#correo').val();
                var telefono1 = $('#telefono1').val();
                var telefono2 = $('#telefono2').val();
                var movil1 = $('#movil1').val();
                var movil2 = $('#movil2').val();
                var razon = $('#razon').val();
                var nrc = $('#nrc').val();
                var nit = $('#nit').val();
                var logo = $('#logo').val();

                let dataEmpresa = new FormData(document.getElementById("formGE"));
      	        let img = $("#logo")[0].files;
                let action = 'update';
                //console.log(Object.fromEntries(dataEmpresa));

                if (empresa === '' || eslogan === '' || direccion === '' || correo === '' || telefono1 === '' ||
                    telefono2 === '' || movil1 === '' || movil2 === '' || razon === '' || nrc === '' || nit === '') {
                      Swal.fire({
                          icon: 'info',
                          title: 'Oops!',
                          text: 'Por favor rellene todos los campos!'
                      });
                } else {
                      if(img.length > 0) {
                          dataEmpresa.append('logo', img);
                          dataEmpresa.append('action', action);
                          console.log(Object.fromEntries(dataEmpresa));
                          $.ajax({
                              url: "procedimientos/Empresa.php",
                              type: "POST",
                              data: dataEmpresa,
                              contentType: false,
                              cache: false,
                              processData:false,
                              success: function(response) {
                                  data = JSON.parse(response);
                                  if (data === 0) {
                                      Swal.fire({
                                          icon: 'info',
                                          title: 'Oops!',
                                          text: 'Imagen demasiado pesada!'
                                      });
                                  } else if (data.json === 1) {
                                      let path = "imagenes/uploads/"+data.src;
                                      $(".logoImg").attr("src", path);
                                      $(".logoImg").fadeOut(1).fadeIn(1000);
                                      $(".logoLeft").attr("src", path);
                                      $(".logoLeft").fadeOut(1).fadeIn(1000);
                                      $("#logo").val('');
                                      Swal.fire({
                                          icon: 'success',
                                          title: 'Éxito!',
                                          text: 'Datos de la empresa actualizados!'
                                      });
                                  } else if (data === 2) {
                                      Swal.fire({
                                          icon: 'warning',
                                          title: 'Alerta!',
                                          text: 'No se pudo actualizar los datos de la empresa!'
                                      });
                                  } else {
                                      Swal.fire({
                                          icon: 'error',
                                          title: 'Error!',
                                          text: 'No se pudo cargar la imagen!'
                                      });
                                  }
                              },
                              error: function(e)
                              {
                                console.log(e);
                              }
                          });
                      } else {
                          Swal.fire({
                              icon: 'info',
                              title: 'Oops!',
                              text: 'Por favor seleccione imagen de la empresa!'
                          });
                      }
                }
            });
        });
    </script>
  </body>
</html>
