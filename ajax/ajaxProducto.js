$(document).ready(function(){

    // Ejecutamos función que mediante AJAX muestra los datos de los usuarios en pantalla.
    mostrarProducto();

    // Función encargada de mostrar los usuarios en pantalla.
    function mostrarProducto() {
        $.ajax({
          url:"procedimientos/Producto.php",
          type: "POST",
          data: {action:"view"},
          success:function(response){
            $("#mostrarTablaProductos").html(response);
            $("#tblProductos").DataTable({
              "iDisplayLength": 5,
                "language":{
                  "sProcessing":     "Procesando...",
                  "sLengthMenu":     "Mostrar _MENU_ registros",
                  "sZeroRecords":    "No se encontraron resultados",
                  "sEmptyTable":     "Ningún dato disponible en esta tabla",
                  "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                  "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                  "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                  "sInfoPostFix":    "",
                  "sSearch":         "Buscar:",
                  "sUrl":            "",
                  "sInfoThousands":  ",",
                  "sLoadingRecords": "Cargando...",
                  "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
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
    } // Aquí termina la función encargada de mostrar los usuarios.

    // Mediante Ajax, al dar clic en en el boton guardar se almacenan todos los datos (Serialize).
    $("#guardar").click(function(e){
        e.preventDefault();
        var producto = $('#inputProducto').val();
        var descripcion = $('#inputDesc').val();
        var categoria = $('#inputCategoria').val();
        var stock = $('#inputStockIni').val();
        var codigo = $('#inputCodigo').val();
        // var checkBox = document.getElementById("inputCheck");
        // var fechaP = $('#inputFecha').val();
        var presentacion = $('#inputPresentacion').val();
        var imagen = $('#inputImagen').val();

        if (producto === '' || descripcion === '' || categoria === '' || presentacion === '') {
            Swal.fire({
                icon: 'info',
                title: 'Oops!',
                text: 'Por favor rellene todos los campos con (*)'
            });
        } else {
            var form = $("#formAProducto");
            var formdata = false;
            if (window.FormData) {
              formdata = new FormData(form[0]);
            }

            $.ajax({
                url: "procedimientos/Producto.php",
                type: "POST",
                data:  formdata ? formdata : form.serialize(),
                dataType: 'JSON',
                contentType: false,
                processData: false,
                success: function(data) {
                    // data = JSON.parse(response);
                    if (data.code==0) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Oops!',
                            text: 'Formato de imagen incorrecto!'
                        });
                    } else if (data.code == "1") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito!',
                            text: 'Producto insertado!'
                        }).then(function(result) {
                            location.reload();
                        });
                    } else if (data.code == "2") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Alerta!',
                            text: 'No se pudo insertar producto!'
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
        }

    }); // Aquí termina la función encargada de insertar los Productos.

    // Mediante Ajax, al dar clic en en el boton guardar se almacenan todos los datos (Serialize).
    $("#guardar2").click(function(e){
        e.preventDefault();
        var producto = $('#inputProducto1').val();
        var descripcion = $('#inputDesc1').val();
        var categoria = $('#inputCategoria1').val();
        var stock = $('#inputStockIni1').val();
        var codigo = $('#inputCodigo1').val();
        // var checkBox = document.getElementById("inputCheck");
        // var fechaP = $('#inputFecha').val();
        var presentacion = $('#inputPresentacion1').val();
        var imagen = $('#inputImagen1').val();
        //console.log(imagen);

        if (producto === '' || descripcion === '' || categoria === '' || presentacion === '' || imagen === '') {
            Swal.fire({
                icon: 'info',
                title: 'Oops!',
                text: 'Por favor rellene todos los campos con (*)'
            });
        } else {
            var form = $("#formEProducto");
            var formdata = false;
            if (window.FormData) {
              formdata = new FormData(form[0]);
              //formdata.append("imagen", "imagen");
            }

            $.ajax({
                url: "procedimientos/Producto.php",
                type: "POST",
                data: formdata ? formdata : form.serialize(),
                dataType: 'JSON',
                contentType: false,
                processData: false,
                success: function(data) {
                    // data = JSON.parse(response);
                    if (data.code == "0") {
                        Swal.fire({
                            icon: 'info',
                            title: 'Oops!',
                            text: 'Formato de imagen incorrecto!'
                        });
                    } else if (data.code == "1") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito!',
                            text: 'Producto actualizado!'
                        }).then(function(result) {
                            location.reload();
                        });
                    } else if (data.code == "2") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Alerta!',
                            text: 'No se pudo actualizar producto!'
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
        }

    }); // Aquí termina la función encargada de actualizar los Productos.

    // Mediante Ajax, al dar clic en el boton eliminar, aparece a la alerta de confirmación de eliminación de usuario.
    $("body").on("click",".btnDelete",function(e){
        e.preventDefault();

        // Capturamos la fila del usuario en la tabla y el ID del usuario.
        var td = $(this).closest('tr');
        var idDel = $(this).attr('id');

        Swal.fire({
          title: 'Estas seguro?',
          text: "Eliminarás este producto del sistema!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url:"procedimientos/Producto.php",
              type: "POST",
              data:{del_id:idDel},
              success:function(response){
                data = JSON.parse(response);

                if (data === 1) {
                    td.css('background-color','purple');
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito!',
                        text: 'Producto eliminada!'
                    });
                    mostrarProducto();
                } else if (data === 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Alerta!',
                        text: 'Producto no eliminada!'
                    });
                    mostrarProducto();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Ha sucedido un error!'
                    });
                    mostrarProducto();
                }
              },
              error: function(e){
                console.log(e);
              }
            });
          }
        });
    }); // Aquí termina la función encargada de eliminar los Categoria.

});
