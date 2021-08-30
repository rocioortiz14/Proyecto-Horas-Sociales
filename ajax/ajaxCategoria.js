$(document).ready(function(){

    // Ejecutamos función que mediante AJAX muestra los datos de los usuarios en pantalla.
    mostrarCategoria();

    // Función encargada de mostrar los usuarios en pantalla.
    function mostrarCategoria() {
        $.ajax({
          url:"procedimientos/Categoria.php",
          type: "POST",
          data: {action:"view"},
          success:function(response){
            $("#mostrarTablaCategorias").html(response);
            $("#tblCategorias").DataTable({
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
        if ($("#formACategoria")[0].checkValidity()) {
          e.preventDefault();
          $.ajax({
            url: "procedimientos/Categoria.php",
            type: "POST",
            data: $("#formACategoria").serialize()+"&action=insert",
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
                    $("#agregarCModal").modal('hide');
                    $("#formACategoria")[0].reset();
                    mostrarCategoria();
                }  else if (data === 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Categoría no guardada!'
                    });
                    $("#agregarCModal").modal('hide');
                    $("#formACategoria")[0].reset();
                    mostrarCategoria();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Ha sucedido un error!'
                    });
                    $("#agregarCModal").modal('hide');
                    $("#formACategoria")[0].reset();
                    mostrarCategoria();
                }

            },
            error: function(e){
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
                    mostrarCategoria();
                }  else if (data === 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Categoría no guardado!'
                    });
                    $("#editarCModal").modal('hide');
                    $("#formECategoria")[0].reset();
                    mostrarCategoria();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Ha sucedido un error!'
                    });
                    $("#editarCModal").modal('hide');
                    $("#formECategoria")[0].reset();
                    mostrarCategoria();
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
                    mostrarCategoria();
                } else if (data === 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Alerta!',
                        text: 'Categoría no eliminada!'
                    });
                    mostrarCategoria();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Ha sucedido un error!'
                    });
                    mostrarCategoria();
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
