<!-- Modal -->
<div class="modal fade" id="editarPrvModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-plus"></i>EDITAR CLIENTE</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" action="" method="post" id="formEProveedor">
          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <label for="" class="form-label">Codigo Proveedor: </label>
            <input type="text" class="form-control" name="inputCodigo1" id="inputCodigo1">
          </div>
          <div class="form-group">
            <label for="" class="form-label">NIT Proveedor: </label>
            <input type="text" class="form-control" name="inputNit1" id="inputNit1">
          </div>
          <div class="form-group">
            <label for="" class="form-label">Nombre: </label>
            <input type="text" class="form-control" name="inputNombre1" id="inputNombre1">
          </div>
          <div class="form-group">
            <label for="" class="form-label">Dirección: </label>
            <textarea name="inputDireccion1" id="inputDireccion1" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label for="" class="form-label">Telefono: </label>
            <input type="text" class="form-control" name="inputTelefono1" id="inputTelefono1">
          </div>
          
          <div class="form-group">
            <label for="" class="form-label">Correo: </label>
            <input type="text" class="form-control" name="inputCorreo1" id="inputCorreo1">
          </div>
          <div class="form-group">
            <label for="" class="form-label">Razón Social: </label>
            <input type="text" class="form-control" name="inputRazon1" id="inputRazon1">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
        <a href="#" class="btn btn-primary" id="editar" name="editar"> <i class="fa fa-save"></i> Guardar</a>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
