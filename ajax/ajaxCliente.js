$(document).ready(function(){

    // Ejecutamos función que mediante AJAX muestra los datos de los clientes en pantalla.
    mostrarCliente();

    // Función encargada de mostrar los clientes en pantalla.
    function mostrarCliente() {
        $.ajax({
          url:"procedimientos/Cliente.php",
          type: "POST",
          data: {action:"view"},
          success:function(response){
            $("#mostrarTablaClientes").html(response);
            $("#tblClientes").DataTable({
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
    } // Aquí termina la función encargada de mostrar los cliente.

    // Mediante él evento de click, mostramos Modal de inserción de cliente.
 

    // Mediante Ajax, al dar clic en en el boton guardar se almacenan todos los datos (Serialize).
    $("#guardar").click(function(e){
        if ($("#formACliente")[0].checkValidity()) {
          e.preventDefault();
          $.ajax({
            url: "procedimientos/Cliente.php",
            type: "POST",
            data: $("#formACliente").serialize()+"&action=insert",
            success:function(response){
                data = JSON.parse(response);
                if (data === 0) {
                  Swal.fire({
                      icon: 'info',
                      title: 'Oops!',
                      text: 'Rellene todos los campos!'
                  });
                  //  $("#agregarCliente").modal('hide');
                  //  $("#formACliente")[0].reset();
                 //   mostrarCliente();
                } else if (data === 1) {
                  Swal.fire({
                      icon: 'success',
                      title: 'Éxito!',
                      text: 'Permiso guardado!'
                  });
                  $("#agregarClModal").modal('hide');
                  $("#formACliente")[0].reset();
                  mostrarCliente();
                } else if (data === 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Alerta!',
                        text: 'Cliente no guardarado!'
                    });
                    $("#agregarClModal").modal('hide');
                    $("#formACliente")[0].reset();
                    mostrarCliente();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Ha sucedido un error!'
                    });
                    $("#agregarClModal").modal('hide');
                    $("#formACliente")[0].reset();
                    mostrarCliente();
                }

            },
            error: function(e){
              console.log(e);
            }
          });
        }
    }); // Aquí termina la función encargada de insertar los cliente.

    // Mediante Ajax, al dar clic en en el boton editar se muestran los datos en el formulario.
    $("body").on("click",".btnEdit",function(e){
        e.preventDefault();
        idCl = $(this).attr('id');
        $.ajax({
          url:"procedimientos/Cliente.php",
          type: "POST",
          data:{edit_id:idCl},
          success:function(response){
            data = JSON.parse(response);

            $("#id").val(data[0]);
            $("#inputNombre1").val(data[1]);
            $("#inputApellido1").val(data[2]);
            $("#inputDireccion1").val(data[3]);
            $("#inputTelefono1").val(data[4]);
            $("#inputCorreo1").val(data[5]);
            $("#inputestado1").val(data[6]);
          },
          error: function(e){
            console.log(e);
          }
        });
    }); // Aquí termina la función encargada de mostrar los datos del Cliente en el formulario.

    // Mediante Ajax, al dar clic en en el boton actualizar, se almacenan todos los datos actualizados (Serialize).
    $("#editar").click(function(e){
        if ($("#formECliente")[0].checkValidity()) {
          e.preventDefault();
          $.ajax({
            url: "procedimientos/Cliente.php",
            type: "POST",
            data: $("#formECliente").serialize()+"&action=update",
            success:function(response){
                data = JSON.parse(response);

                if (data === 0) {
                  Swal.fire({
                      icon: 'info',
                      title: 'Oops!',
                      text: 'Rellene todos los campos!'
                  });
                } else if  (data === 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito!',
                        text: 'Cliente actualizado!'
                    });
                    $("#editarClModal").modal('hide');
                    $("#formECliente")[0].reset();
                    mostrarCliente();
                } else if (data === 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Alerta!',
                        text: 'Cliente no actualizado!'
                    });
                    $("#editarClModal").modal('hide');
                    $("#formECliente")[0].reset();
                    mostrarCliente();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Ha sucedido un error!'
                    });
                    $("#editarClModal").modal('hide');
                    $("#formECliente")[0].reset();
                    mostrarCliente();
                }
            },
            error: function(e){
              console.log(e);
            }
          });
        }
    }); // Aquí termina la función encargada de actualizar los cliente.

    // Mediante Ajax, al dar clic en el boton eliminar, aparece a la alerta de confirmación de eliminación de Cliente.
    $("body").on("click",".btnDelete",function(e){
        e.preventDefault();

        // Capturamos la fila del Cliente en la tabla y el ID del Cliente.
        var tdCl = $(this).closest('tr');
        var idClDel = $(this).attr('id');

        Swal.fire({
          title: 'Estas seguro?',
          text: "Eliminarás este Cliente del sistema!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url:"procedimientos/Cliente.php",
              type: "POST",
              data:{del_id:idClDel},
              success:function(response){
                data = JSON.parse(response);

                if (data === 1) {
                    tdCl.css('background-color','purple');
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito!',
                        text: 'Cliente eliminado!'
                    });
                    mostrarCliente();
                } else if (data === 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Alerta!',
                        text: 'Cliente no eliminado!'
                    });
                    mostrarCliente();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Ha sucedido un error!'
                    });
                    mostrarCliente();
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
