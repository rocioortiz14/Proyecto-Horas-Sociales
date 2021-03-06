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
                  <h3> Administracion de compras</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio.php"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Compras</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                  <a href="generar-compras.php" class="btn btn-primary btn-md"> <i class="fa fa-plus"></i> Generar compras</a>
                  <hr>
                  <div class="table-responsive-md" id="mostrarTablaCompras"></div>
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
    <script type="text/javascript">
        $(document).ready(function() {
          $(document).on("click",".btnDelete",function(){
            var id = $(this).attr("id");
            Swal.fire({
               title: "Advertencia",
               text: "Esta seguro que desea anular esta compra ?",
               showCancelButton: true,
               icon: 'warning',
               cancelButtonColor: '#d33',
             }).then(function(res) {
                   if(res.value){
                     anular(id);
                   }
               });
          });
          // Ejecutamos funci??n que mediante AJAX muestra los datos de los usuarios en pantalla.
          mostrarCompras();

          });
          // Funci??n encargada de mostrar los usuarios en pantalla.
          function mostrarCompras() {
              $.ajax({
                url:"procedimientos/Compras.php",
                type: "POST",
                data: {action:"view"},
                success:function(response){
                  $("#mostrarTablaCompras").html(response);
                  $("#tblCompras").DataTable({
                    "iDisplayLength": 10,
                      "language":{
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ning??n dato disponible en esta tabla",
                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar compra:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                          "sFirst":    "Primero",
                          "sLast":     "??ltimo",
                          "sNext":     "Siguiente",
                          "sPrevious": "Anterior"
                        },
                        "oAria": {
                          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                      }
                  });
                },
                error: function(e){
                  console.log(e);
                }
              });
          } // Aqu?? termina la funci??n encargada de mostrar las compras realizadas.


        function anular(id){
          $.ajax({
            type: "POST",
            data : {
              action: "anular",
              id: id
            },
            url: "procedimientos/Compras.php",
            dataType: "json",
            success: function(data){
              if(data.code  == 1){
                Swal.fire({
                    icon: 'success',
                    title: '??xito!',
                    text: 'Compra anulada!'
                }).then(function(result) {
                    mostrarCompras();
                });
              } else if(data.code  == 3){
                Swal.fire({
                    icon: 'info',
                    title: 'Oops!',
                    text: 'No se anularon los detalles de la compra!'
                });
              } else if(data.code  == 0){
                Swal.fire({
                    icon: 'info',
                    title: 'Oops!',
                    text: 'No se anulo la compra!'
                });
              }
            }
          })
        }
    </script>
  </body>
</html>
