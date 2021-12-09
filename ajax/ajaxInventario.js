$(document).ready(function(){

    // Ejecutamos función que mediante AJAX muestra los datos del inventario.
    mostrarInventario();

    // Función encargada de mostrar inventario en pantalla.
    function mostrarInventario() {
        $.ajax({
          url:"procedimientos/Inventario.php",
          type: "POST",
          data: {action:"view"},
          success:function(response) {
            $("#mostrarTablaInventario").html(response);
            $('#tblInventario').DataTable({
              dom: 'Bfrtip',
              buttons: [
                {
                    extend: 'copy',
                    text: 'Copiar datos'
                },
                {
                    extend: 'csv',
                    text: 'Exportar CSV'
                },
                {
                    extend: 'excel',
                    text: 'Exportar EXCEL'
                },
                {
                    extend: 'pdf',
                    text: 'Exportar PDF'
                }
              ],
              language: {
                  "decimal": "",
                  "emptyTable": "No hay información",
                  "info": "Mostrando _START_ a _END_ de _TOTAL_ Documentos",
                  "infoEmpty": "Mostrando 0 to 0 of 0 Documentos",
                  "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                  "infoPostFix": "",
                  "thousands": ",",
                  "lengthMenu": "Mostrar _MENU_ Documentos",
                  "loadingRecords": "Cargando...",
                  "processing": "Procesando...",
                  "search": "Buscar:",
                  "zeroRecords": "Sin resultados encontrados",
                  "paginate": {
                      "first": "Primero",
                      "last": "Ultimo",
                      "next": "Siguiente",
                      "previous": "Anterior"
                  }
              }
          });
        },
        error: function(e) {
          console.log(e);
        }
      });
    } // Aquí termina la función encargada de mostrar el inventario.

});
