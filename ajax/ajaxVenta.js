$(document).ready(function(){

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
                } else if (data === 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito!',
                        text: 'Cliente guardado!'
                    });
                    $("#agregarClModal").modal('hide');
                    $("#formACliente")[0].reset();
                    location.reload();
                }  else if (data === 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Cliente no guardado!'
                    });
                    $("#agregarClModal").modal('hide');
                    $("#formACliente")[0].reset();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Ha sucedido un error!'
                    });
                    $("#agregarClModal").modal('hide');
                    $("#formACliente")[0].reset();
                }
  
            },
            error: function(e){
              console.log(e);
            }
          });
        }
    }); // Aquí termina la función encargada de insertar los permisos.

  
  });
  