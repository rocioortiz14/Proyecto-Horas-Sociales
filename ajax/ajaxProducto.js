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
              "iDisplayLength": 10,
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

        // if (checkBox.checked == true && fechaP === '') {
            // Swal.fire({
            //     icon: 'info',
            //     title: 'Oops!',
            //     text: 'Por favor ingrese fecha de caducidad!'
            // });
        // }

        // let dataProducto = new FormData(document.getElementById("formAProducto"));
        // let img = $("#inputImagen")[0].files;
        // let action = 'insert';

        if (producto === '' || descripcion === '' || categoria === '' || presentacion === '') {
            Swal.fire({
                icon: 'info',
                title: 'Oops!',
                text: 'Por favor rellene todos los campos con (*)'
            });
        } else {
            // dataProducto.append('imagen', img);
            // dataProducto.append('action', action);
            //console.log(Object.fromEntries(dataProducto));
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
                        /*
                        let path = "imagenes/uploads/"+data.src;
                        $(".logoImg").attr("src", path);
                        $(".logoImg").fadeOut(1).fadeIn(1000);
                        $(".logoLeft").attr("src", path);
                        $(".logoLeft").fadeOut(1).fadeIn(1000);
                        $("#logo").val('');
                        */
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

    }); // Aquí termina la función encargada de insertar los Categoria.

    // Mediante Ajax, al dar clic en en el boton editar se muestran los datos en el formulario.
    $("body").on("click",".btnEdit",function(e){
        e.preventDefault();
        idC = $(this).attr('id');
        $.ajax({
          url:"procedimientos/Categoria.php",
          type: "POST",
          data:{edit_id:idC},
          success:function(response){
            data = JSON.parse(response);

            $("#id").val(data[0]);
            $("#inputCategoria1").val(data[1]);
            $("#inputDesc1").val(data[2]);
          },
          error: function(e){
            console.log(e);
          }
        });
    }); // Aquí termina la función encargada de mostrar los datos del permiso en el formulario.

    // Mediante Ajax, al dar clic en en el boton actualizar, se almacenan todos los datos actualizados (Serialize).
    $("#editar").click(function(e){
        if ($("#formECategoria")[0].checkValidity()) {
          e.preventDefault();
          $.ajax({
            url: "procedimientos/Categoria.php",
            type: "POST",
            data: $("#formECategoria").serialize()+"&action=update",
            success:function(response){
                data = JSON.parse(response);

                if (data === 0) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Oops!',
                        text: 'Rellene todos los campos!'
                    });
                } else if (data === 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito!',
                        text: 'Categoría guardada!'
                    });
                    $("#editarCModal").modal('hide');
                    $("#formECategoria")[0].reset();
                    mostrarProducto();
                }  else if (data === 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Categoría no guardado!'
                    });
                    $("#editarCModal").modal('hide');
                    $("#formECategoria")[0].reset();
                    mostrarProducto();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Ha sucedido un error!'
                    });
                    $("#editarCModal").modal('hide');
                    $("#formECategoria")[0].reset();
                    mostrarProducto();
                }
            },
            error: function(e){
              console.log(e);
            }
          });
        }
    }); // Aquí termina la función encargada de actualizar los usuarios.

    // Mediante Ajax, al dar clic en el boton eliminar, aparece a la alerta de confirmación de eliminación de usuario.
    $("body").on("click",".btnDelete",function(e){
        e.preventDefault();

        // Capturamos la fila del usuario en la tabla y el ID del usuario.
        var tdC = $(this).closest('tr');
        var idCDel = $(this).attr('id');

        Swal.fire({
          title: 'Estas seguro?',
          text: "Eliminarás esta categoría del sistema!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url:"procedimientos/Categoria.php",
              type: "POST",
              data:{del_id:idCDel},
              success:function(response){
                data = JSON.parse(response);

                if (data === 1) {
                    tdC.css('background-color','purple');
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito!',
                        text: 'Categoría eliminada!'
                    });
                    mostrarProducto();
                } else if (data === 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Alerta!',
                        text: 'Categoría no eliminada!'
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
