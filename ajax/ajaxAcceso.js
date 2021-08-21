$("#botonAcceso").click(function(e) {
    if ($("#accesoFormulario")[0].checkValidity()) {
      e.preventDefault();
      $.ajax({
        url: "procedimientos/Acceso.php",
        type: "POST",
        data: $("#accesoFormulario").serialize()+"&action=acceso",
        success:function(response){
          data = JSON.parse(response);
          if (data === 0) {
              $("#accesoU").val("");
              $("#accesoC").val("");
              Swal.fire({
                  icon: 'warning',
                  title: 'Oops...',
                  text: 'Rellene todos los campos!'
              });
          } else if (data === 1) {
              Swal.fire({
                  icon: 'success',
                  title: 'Éxito',
                  text: 'Bienvenido!',
                  timer: 2000,
              }).then(function() {
                  window.location = "inicio.php";
              });
          } else if (data === 2) {
              $("#accesoU").val("");
              $("#accesoC").val("");
              Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Usuario no encontrado!'
              });
          } else if (data === 3) {
              $("#accesoU").val("");
              $("#accesoC").val("");
              Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Contraseña incorrecta!'
              });
          } else {
            $("#accesoU").val("");
            $("#accesoC").val("");
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'No se pudo obtener ninguna respuesta!'
            });
          }
        },
        error: function(e){
          console.log(e);
        }
      });
    }
});