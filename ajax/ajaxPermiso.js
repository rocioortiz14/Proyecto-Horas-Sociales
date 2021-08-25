$(document).ready(function(){

    // Ejecutamos función que mediante AJAX muestra los datos de los usuarios en pantalla.
    mostrarPermisos();

    // Función encargada de mostrar los usuarios en pantalla.
    function mostrarPermisos() {
        $.ajax({
          url:"procedimientos/Permisos.php",
          type: "POST",
          data: {action:"view"},
          success:function(response){
            $("#mostrarTablaPermisos").html(response);
            $("#tblPermisos").DataTable({
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
        if ($("#formAPermiso")[0].checkValidity()) {
          e.preventDefault();
          $.ajax({
            url: "procedimientos/Permisos.php",
            type: "POST",
            data: $("#formAPermiso").serialize()+"&action=insert",
            success:function(response){
                data = JSON.parse(response);
                if (data === 0) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Oops!',
                        text: 'Rellene todos los campos!'
                    });
                    //$("#agregarPModal").modal('hide');
                    //$("#formAPermiso")[0].reset();
                    //mostrarPermisos();
                } else if (data === 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito!',
                        text: 'Permiso guardado!'
                    });
                    $("#agregarPModal").modal('hide');
                    $("#formAPermiso")[0].reset();
                    mostrarPermisos();
                }  else if (data === 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Permiso no guardado!'
                    });
                    $("#agregarPModal").modal('hide');
                    $("#formAPermiso")[0].reset();
                    mostrarPermisos();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Ha sucedido un error!'
                    });
                    $("#agregarPModal").modal('hide');
                    $("#formAPermiso")[0].reset();
                    mostrarPermisos();
                }

            },
            error: function(e){
              console.log(e);
            }
          });
        }
    }); // Aquí termina la función encargada de insertar los permisos.

    // Mediante Ajax, al dar clic en en el boton editar se muestran los datos en el formulario.
    $("body").on("click",".btnEdit",function(e){
        e.preventDefault();
        idP = $(this).attr('id');
        $.ajax({
          url:"procedimientos/Permisos.php",
          type: "POST",
          data:{edit_id:idP},
          success:function(response){
            data = JSON.parse(response);

            $("#id").val(data[0]);
            $("#inputPermiso1").val(data[1]);
            $("#inputDesc1").val(data[2]);
          },
          error: function(e){
            console.log(e);
          }
        });
    }); // Aquí termina la función encargada de mostrar los datos del permiso en el formulario.

    // Mediante Ajax, al dar clic en en el boton actualizar, se almacenan todos los datos actualizados (Serialize).
    $("#editar").click(function(e){
        if ($("#formEPermiso")[0].checkValidity()) {
          e.preventDefault();
          $.ajax({
            url: "procedimientos/Permisos.php",
            type: "POST",
            data: $("#formEPermiso").serialize()+"&action=update",
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
                        text: 'Permiso guardado!'
                    });
                    $("#editarPModal").modal('hide');
                    $("#formAPermiso")[0].reset();
                    mostrarPermisos();
                }  else if (data === 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Permiso no guardado!'
                    });
                    $("#editarPModal").modal('hide');
                    $("#formAPermiso")[0].reset();
                    mostrarPermisos();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Ha sucedido un error!'
                    });
                    $("#editarPModal").modal('hide');
                    $("#formAPermiso")[0].reset();
                    mostrarPermisos();
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
        var tdP = $(this).closest('tr');
        var idPDel = $(this).attr('id');

        Swal.fire({
          title: 'Estas seguro?',
          text: "Eliminarás este permiso del sistema!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url:"procedimientos/Permisos.php",
              type: "POST",
              data:{del_id:idPDel},
              success:function(response){
                data = JSON.parse(response);

                if (data === 1) {
                    tdP.css('background-color','purple');
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito!',
                        text: 'Permiso eliminado!'
                    });
                    mostrarPermisos();
                } else if (data === 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Alerta!',
                        text: 'Permiso no eliminado!'
                    });
                    mostrarPermisos();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Ha sucedido un error!'
                    });
                    mostrarPermisos();
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
