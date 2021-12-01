$(document).ready(function(){

    $(document).keydown(function(e) {
      if (e.which == 114) { //F1 AGREGAR PROVEEDOR
        $('#agregarClModal').modal('toggle');
        e.stopPropagation();
      }
    });

    $('#cerrar1').click(function(e) {
      e.preventDefault();
      $("#formACliente")[0].reset();
    });

    $('#cerrar2').click(function(e) {
      e.preventDefault();
      $("#formACliente")[0].reset();
    });

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

    $(document).keydown(function(e) {
      if (e.which == 113) { //F2 Guardar
        $("#facturar").click();
        e.stopPropagation();
      }
    });
    $("#is_iva").click(function(){
      totales();
    });
    $("#productos").on('select2:close',function(){
      var id = $(this).val();
      var sel = $(this);
      var nombre = $("#productos option:selected").data("nombre");
      if(id != ""){
        qty = $("#listaProductos tr").length;
        qty++;
        exis = 0;
        $("#listaProductos tr").each(function(){
          if($(this).attr("id") == id){
            exis = 1;
          }
        });
        if(!exis){
          $.ajax({
            type:"POST",
            url:"procedimientos/Ventas.php",
            data: {
              action: "consultar",
              id: id
            },
            dataType: "json",
            success: function(data){
              var tr =  '<tr id="'+id+'">';
                tr += '<td style="width: 3%;" scope="row">'+qty+'</td>';
                tr += '<td style="width: 41%;">'+nombre+'</td>';
                tr += '<td style="width: 14%;">'+data.stock+'</td>';
                tr += '<td style="width: 10%;"> <input class="form-control form-control-sm numeric cantidad" type="text"> </td>';
                tr += '<td style="width: 14%;"> <input class="form-control form-control-sm numeric pv" type="text" value="'+data.pv+'"> </td>';
                tr += '<td style="width: 15%;" class="stot">$ </td>';
                tr += '<td style="width: 3%;"> <a class="text-danger delete"> <i class="fa fa-trash fa-lg"></i> </a> </td>';
              tr += '</tr>';
              $("#listaProductos").append(tr);
              $(".numeric").numeric({negative:false,decimalPlaces:2});
              $("#listaProductos tr:last").find(".cantidad").val("1").focus().select();
              entro = false;
              sel.val("").select2().trigger("change");
            }
          });
        } else{
          Swal.fire({
              icon: 'warning',
              title: 'Alerta!',
              text: 'Ya agrego este producto!'
          });
        }
      }
    });
    $("#facturar").click(function(){
      guardar_venta();
    });
    });
    function renumerar(){
    var qty =1;
    $("#listaProductos tr").each(function(){
      $(this).find("td:eq(0)").text(qty);
      qty++;
    });
    }
    $(document).on("click",".delete",function(){
    $(this).parents("tr").remove();
    renumerar();
    });

    $(document).on("keyup",".cantidad",function(evt){
    var valor = $(this).val();
    if(evt.keyCode == 13 && entro){
      if(valor != "" && parseFloat(valor)>0){
        $(this).parents("tr").find(".pv").focus();
      }
    }
    entro=true;
    totales();
    });
    $(document).on("keyup",".pc",function(evt){
    var valor = $(this).val();
    if(evt.keyCode == 13){
      if(valor != "" && parseFloat(valor)>0){
        $(this).parents("tr").find(".pv").focus();
      }
    }
    totales();
    });
    $(document).on("keyup",".pv",function(evt){
    var valor = $(this).val();
    if(evt.keyCode == 13){
      if(valor != "" && parseFloat(valor)>0){
        $("#productos").select2("open");
        totales();
      }
    }
    });
    $(document).on("click","#clean_table",function(evt){
    $("#listaProductos").html("");
    totales();
    });
    function totales(){
    var is_iva = $("#is_iva").is(":checked");
    var qty = 0;
    var ttl = 0;
    var iva = 0;
    $("#listaProductos tr").each(function(){
      var pc = parseFloat($(this).find(".pv").val());
      var cantidad = parseFloat($(this).find(".cantidad").val());
      if(isNaN(pc)){
        pc =0;
      }
      if(isNaN(cantidad)){
        cantidad =0;
      }
      var stot = pc * cantidad;
      $(this).find(".stot").text("$"+stot.toFixed(2));
      qty += cantidad;
      ttl += stot;
    });

    if(is_iva){
      iva = ttl * 0.13;
    }
    var ttliva = ttl + iva;
    $("#tqty").text(qty);
    $("#tpc").text("$"+ttl.toFixed(2));
    $("#tiva").text("$"+iva.toFixed(2));
    $("#ttl").text("$"+ttliva.toFixed(2));
    }
    function guardar_venta(){
    var cliente = $("#clientes").val();
    var comprobante = $("#comprobante").val();
    var fechaV = $("#fechaV").val();
    var serie = $("#serie").val();
    var numero = $("#numero").val();

    var tqty = $("#tqty").text();
    var tpc = $("#tpc").text().split("$")[1];
    var tiva = $("#tiva").text().split("$")[1];
    var ttl = $("#ttl").text().split("$")[1];

    var err = 0; num = 0;
    if(cliente == "" || comprobante == "" || fechaV == "" || numero == ""){
      err = 1;
    }
    var productos = new Array();
    $("#listaProductos tr").each(function(){
      var id = $(this).attr("id");
      var cantidad = parseFloat($(this).find(".cantidad").val());
      var pv = parseFloat($(this).find(".pv").val());
      //var pc = parseFloat($(this).find(".pc").val());
      var stot = parseFloat($(this).find(".stot").text().split("$")[1]);
      if(cantidad >0 && pv >0){
        var prod = new Object();
        prod.id = id;
        prod.cantidad = cantidad;
        //prod.pc = pc;
        prod.pv = pv;
        prod.stot = stot;
        prod_item = JSON.stringify(prod);
        productos.push(prod_item);
      } else{
        err = 1;
      }
      num++;
    });
    productos_json = '[' + productos + ']';
    if(!err && num>0){
      $.ajax({
          url: "procedimientos/Ventas.php",
          type: "POST",
          data: {
            cliente : cliente,
            comprobante : comprobante,
            fechaV : fechaV,
            serie : serie,
            numero : numero,
            tqty : tqty,
            tpc : tpc,
            tiva : tiva,
            ttl : ttl,
            productos : productos_json,
            action : "insert",
          },
          dataType: 'JSON',
          success: function(data) {
              if (data.code==0){
                  Swal.fire({
                      icon: 'info',
                      title: 'Oops!',
                      text: 'No se ingreso la venta!'
                  });
              } else if (data.code==2){
                  Swal.fire({
                      icon: 'info',
                      title: 'Oops!',
                      text: 'No se ingresaron los detalles de la venta!'
                  });
              } else if (data.code==1){
                  Swal.fire({
                      icon: 'success',
                      title: 'Éxito!',
                      text: 'Venta insertada!'
                  }).then(function(result) {
                      location.reload();
                  });
              }
          },
          error: function(e)
          {
            console.log(e);
          }
      });
    } else{
      Swal.fire({
          icon: 'warning',
          title: 'Alerta!',
          text: 'Complete todos los datos para continuar!'
      });
    }

    }
