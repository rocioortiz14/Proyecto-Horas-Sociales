<!-- Modal -->
<div class="modal fade" id="agregarUModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-plus"></i> AGREGAR USUARIO</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" action="" method="post" id="formAUsuario">
          <div class="form-group">
            <label for="" class="form-label">Nombre: </label>
            <input type="text" class="form-control" name="inputNombre" id="inputNombre">
          </div>
          <div class="form-group">
            <label for="" class="form-label">Usuario: </label>
            <input type="text" class="form-control" name="inputUsuario" id="inputUsuario">
          </div>
          <div class="form-group">
            <label for="" class="form-label">Contra: </label>
            <input type="password" class="form-control" name="inputContra" id="inputContra">
          </div>
          <div class="form-group">
            <label class="form-control-label" for="state-success">Empleado:</label>
              <select class="select form-control" name="imputEmpleado" id="imputEmpleado" style="width: 100%;">
                <option value="">Seleccionar...</option>
                <?php
                    $stmt1 = $conexion -> query("SELECT * FROM tbl_empleados");
                    // and somewhere later:
                    while ($data = $stmt1-> fetch()) {
                        echo '<option class="text-dark" value="'.$data[0].'">'.$data[2].'</option>';
                    }
                ?>
              </select>
          </div>
          <div class="form-group">
            <label class="form-control-label" for="state-success">Permiso:</label>
              <select class="select form-control" name="inputPermiso" id="inputPermiso" style="width: 100%;">
                <option value="">Seleccionar...</option>
                <?php
                    $stmt2 = $conexion -> query("SELECT * FROM tbl_permisos");
                    // and somewhere later:
                    while ($data = $stmt2 -> fetch()) {
                        echo '<option class="text-dark" value="'.$data[0].'">'.$data[1].'</option>';
                    }
                ?>
              </select>
          </div>
          <div class="form-group" id="centrar">
              <label class="form-control-label" for="state-success">Estado:</label>
              <select class="select form-control" name="inputEstado" id="inputEstado" style="width: 100%;">
                  <option value=''>Seleccionar...</option>
                  <?php
                    $estado = array('','ACTIVO','INACTIVO','BANEADO');
                    $array = $estado;
                    for ($k=1; $k<sizeof($array); $k++)
                    {
                      echo "<option value='$k'>". $array[$k] . "</option>";
                    }
                  ?>
              </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
        <a href="#" class="btn btn-primary" id="guardar" name="guardar"> <i class="fa fa-save"></i> Guardar</a>
        </form>
      </div>
    </div>
  </div>
</div>
