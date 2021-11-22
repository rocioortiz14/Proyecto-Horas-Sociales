<!-- Modal -->
<div class="modal fade" id="agregarPrvModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-plus"></i> AGREGAR PROVEEDOR</h5>
        <button type="button" id="cerrar1" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" action="" method="post" id="formAProveedor">
          <div class="form-group">
            <label for="" class="form-label text-dark">Codigo Proveedor: </label>
            <input type="text" class="form-control" name="inputCodigo" id="inputCodigo">
          </div>
          <div class="form-group">
            <label for="" class="form-label text-dark">NIT Proveedor: </label>
            <input type="text" class="form-control" name="inputNit" id="inputNit">
          </div>
          <div class="form-group">
            <label for="" class="form-label text-dark">Nombre: </label>
            <input type="text" class="form-control" name="inputNombre" id="inputNombre">
          </div>
          <div class="form-group">
            <label for="" class="form-label text-dark">Dirección: </label>
            <textarea name="inputDireccion" id="inputDireccion" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label for="" class="form-label text-dark">Telefono: </label>
            <input type="text" class="form-control" name="inputTelefono" id="inputTelefono">
          </div>

          <div class="form-group">
            <label for="" class="form-label text-dark">Correo: </label>
            <input type="text" class="form-control" name="inputCorreo" id="inputCorreo">
          </div>
          <div class="form-group">
            <label for="" class="form-label text-dark">Razón Social: </label>
            <input type="text" class="form-control" name="inputRazon" id="inputRazon">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="cerrar2" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
        <a href="#" class="btn btn-primary" id="guardar" name="guardar"> <i class="fa fa-save"></i> Guardar</a>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
