$(document).ready(function(){

    // Ejecutamos función que mediante AJAX muestra los datos de los usuarios en pantalla.
    mostrarUsuarios();

    // Función encargada de mostrar los usuarios en pantalla.
    function mostrarUsuarios() {
        $.ajax({
          url:"procedimientos/Usuarios.php",
          type: "POST",
          data: {action:"view"},
          success:function(response){
            $("#mostrarTablaUsuarios").html(response);
            $("#tblUsuarios").DataTable({
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
        if ($("#formAUsuario")[0].checkValidity()) {
          e.preventDefault();
          $.ajax({
            url: "procedimientos/Usuarios.php",
            type: "POST",
            data: $("#formAUsuario").serialize()+"&action=insert",
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
                        text: 'Usuario insertado!'
                    });
                    $("#agregarUModal").modal('hide');
                    $("#formAUsuario")[0].reset();
                    mostrarUsuarios();
                } else if (data === 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Alerta!',
                        text: 'Usuario no insertado!'
                    });
                    $("#agregarUModal").modal('hide');
                    $("#formAUsuario")[0].reset();
                    mostrarUsuarios();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Ha sucedido un error!'
                    });
                    $("#agregarUModal").modal('hide');
                    $("#formAUsuario")[0].reset();
                    mostrarUsuarios();
                }
            },
            error: function(e){
              console.log(e);
            }
          });
        }
    }); // Aquí termina la función encargada de insertar los usuarios.

    // Mediante Ajax, al dar clic en en el boton editar se muestran los datos en el formulario.
    $("body").on("click",".btnEdit",function(e){
        e.preventDefault();
        idU = $(this).attr('id');
        $.ajax({
          url:"procedimientos/Usuarios.php",
          type: "POST",
          data:{edit_id:idU},
          success:function(response){
            data = JSON.parse(response);

            $("#id").val(data[0]);
            $("#inputNombre1").val(data[1]);
            $("#inputUsuario1").val(data[2]);
            $("#imputEmpleado1").val(data[5]);
            $("#inputPermiso1").val(data[3]);
            $("#inputEstado1").val(data[4]);
          },
          error: function(e){
            console.log(e);
          }
        });
    }); // Aquí termina la función encargada de mostrar los datos del usuario en el formulario.

    // Mediante Ajax, al dar clic en en el boton actualizar, se almacenan todos los datos actualizados (Serialize).
    $("#editar").click(function(e){
        if ($("#formEditUsuario")[0].checkValidity()) {
          e.preventDefault();
          $.ajax({
            url: "procedimientos/Usuarios.php",
            type: "POST",
            data: $("#formEditUsuario").serialize()+"&action=update",
            success:function(response){
                data = JSON.parse(response);

                if (data === 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito!',
                        text: 'Usuario actualizado!'
                    });
                    $("#editarUModal").modal('hide');
                    $("#formEditUsuario")[0].reset();
                    mostrarUsuarios();
                } else if (data === 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Alerta!',
                        text: 'Usuario no actualizado!'
                    });
                    $("#editarUModal").modal('hide');
                    $("#formEditUsuario")[0].reset();
                    mostrarUsuarios();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Ha sucedido un error!'
                    });
                    $("#editarUModal").modal('hide');
                    $("#formEditUsuario")[0].reset();
                    mostrarUsuarios();
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
        var tdU = $(this).closest('tr');
        var idUDel = $(this).attr('id');

        Swal.fire({
          title: 'Estas seguro?',
          text: "Eliminarás este usuario del sistema!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url:"procedimientos/Usuarios.php",
              type: "POST",
              data:{del_id:idUDel},
              success:function(response){
                data = JSON.parse(response);

                if (data === 1) {
                    tdU.css('background-color','purple');
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito!',
                        text: 'Usuario eliminado!'
                    });
                    mostrarUsuarios();
                } else if (data === 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Alerta!',
                        text: 'Usuario no eliminado!'
                    });
                    mostrarUsuarios();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Ha sucedido un error!'
                    });
                    mostrarUsuarios();
                }
              },
              error: function(e){
                console.log(e);
              }
            });
          }
        });
    }); // Aquí termina la función encargada de eliminar los permisos.

});
