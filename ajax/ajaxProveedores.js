$(document).ready(function(){

    // Ejecutamos función que mediante AJAX muestra los datos de los usuarios en pantalla.
    mostrarProveedores();
  
    // Función encargada de mostrar los usuarios en pantalla.
    function mostrarProveedores() {
        $.ajax({
          url:"procedimientos/Proveedores.php",
          type: "POST",
          data: {action:"view"},
          success:function(response){
            $("#mostrarTablaProveedores").html(response);
            $("#tblProveedores").DataTable({
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
        if ($("#formAProveedor")[0].checkValidity()) {
          e.preventDefault();
          $.ajax({
            url: "procedimientos/Proveedores.php",
            type: "POST",
            data: $("#formAProveedor").serialize()+"&action=insert",
            success:function(response){
                data = JSON.parse(response);
                if (data === 0) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Oops!',
                        text: 'Rellene todos los campos!'
                    });
                    //$("#agregarClModal").modal('hide');
                    //$("#formAProveedor")[0].reset();
                    //mostrarProveedores();
                } else if (data === 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito!',
                        text: 'Proveedor  guardado!'
                    });
                    $("#agregarPrvModal").modal('hide');
                    $("#formAProveedor")[0].reset();
                    mostrarProveedores();
                }  else if (data === 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Proveedor no guardado!'
                    });
                    $("#agregarPrvModal").modal('hide');
                    $("#formAProveedor")[0].reset();
                    mostrarProveedores();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Ha sucedido un error!'
                    });
                    $("#agregarPrvModal").modal('hide');
                    $("#formAProveedor")[0].reset();
                    mostrarProveedores();
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
        idPrv = $(this).attr('id');
        $.ajax({
          url:"procedimientos/Proveedores.php",
          type: "POST",
          data:{edit_id:idPrv},
          success:function(response){
            data = JSON.parse(response);
  
            $("#id").val(data[0]);
            $("#inputCodigo1").val(data[1]);
            $("#inputNit1").val(data[2]);
            $("#inputNombre1").val(data[3]);
            $("#inputDireccion1").val(data[4]);
            $("#inputTelefono1").val(data[5]);
            $("#inputCorreo1").val(data[6]);
            $("#inputRazon1").val(data[7]);
          },
          error: function(e){
            console.log(e);
          }
        });
    }); // Aquí termina la función encargada de mostrar los datos del permiso en el formulario.
  
    // Mediante Ajax, al dar clic en en el boton actualizar, se almacenan todos los datos actualizados (Serialize).
    $("#editar").click(function(e){
        if ($("#formEProveedor")[0].checkValidity()) {
          e.preventDefault();
          $.ajax({
            url: "procedimientos/Proveedores.php",
            type: "POST",
            data: $("#formEProveedor").serialize()+"&action=update",
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
                        text: 'Proveedor guardado!'
                    });
                    $("#editarPrvModal").modal('hide');
                    $("#formEProveedor")[0].reset();
                    mostrarProveedores();
                }  else if (data === 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Proveedor no guardado!'
                    });
                    $("#editarPrvModal").modal('hide');
                    $("#formEProveedor")[0].reset();
                    mostrarProveedores();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Ha sucedido un error!'
                    });
                    $("#editarPrvModal").modal('hide');
                    $("#formEProveedor")[0].reset();
                    mostrarProveedores();
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
        var tdPrv = $(this).closest('tr');
        var idPrvDel = $(this).attr('id');
  
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
              url:"procedimientos/Proveedores.php",
              type: "POST",
              data:{del_id:idPrvDel},
              success:function(response){
                data = JSON.parse(response);
  
                if (data === 1) {
                    tdPrv.css('background-color','purple');
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito!',
                        text: 'Proveedor eliminado!'
                    });
                    mostrarProveedores();
                } else if (data === 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Alerta!',
                        text: 'Permiso no eliminado!'
                    });
                    mostrarProveedores();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Ha sucedido un error!'
                    });
                    mostrarProveedores();
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
  