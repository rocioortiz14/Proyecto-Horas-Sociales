<!-- Modal -->
<div class="modal fade" id="editarClModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-edit"></i> EDITAR CLIENTE</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" action="" method="post" id="formECliente">
          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <label for="" class="form-label">Nombres: </label>
            <input type="text" class="form-control" name="inputNombre1" id="inputNombre1">
          </div>
          <div class="form-group">
            <label for="" class="form-label">Apellidos: </label>
            <input type="text" class="form-control" name="inputApellido1" id="inputApellido1">
          </div>
          <div class="form-group">
            <label for="" class="form-label">Direccion: </label>
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

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
        <a href="#" class="btn btn-success" id="editar" name="editar"> <i class="fa fa-save"></i> Guardar</a>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
