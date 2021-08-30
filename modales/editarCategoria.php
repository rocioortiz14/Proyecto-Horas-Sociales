<!-- Modal -->
<div class="modal fade" id="editarCModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-plus"></i> AGREGAR CATEGORÍA</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" action="" method="post" id="formECategoria">
          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <label for="" class="form-label">Categoría: </label>
            <input type="text" class="form-control" name="inputCategoria1" id="inputCategoria1">
          </div>
          <div class="form-group">
            <label for="" class="form-label">Descripción: </label>
            <textarea name="inputDesc1" id="inputDesc1" class="form-control"></textarea>
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
