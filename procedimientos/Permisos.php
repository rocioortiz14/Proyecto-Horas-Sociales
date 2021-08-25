<?php

    // Requerimos el archivo de control de sesiones.
    require_once '../configuracion/sesion.php';
    // Requerimos el archivo de conexion a la base de datos e iniciamos la sesión.
    require_once '../configuracion/conexion.php';

    $bPermisos = $conexion -> prepare("SELECT * FROM tbl_permisos");

    $bPermisos -> execute();
    /*Almacenamos el resultado de fetchAll en una variable*/
    $arrayDatos = $bPermisos -> fetchAll();
    //print_r($arrayDatos);

    if (isset($_POST['action']) && $_POST['action'] == "view") {

?>

        <table class="table table-hover table-sm" id="tblPermisos">
          <thead>
            <th class="bg-primary text-white text-center" style="width: 5%;">ID</th>
            <th class="bg-primary text-white text-center" style="width: 25%;">Permiso</th>
            <th class="bg-primary text-white text-center" style="width: 60%;">Descripción</th>
            <th class="bg-primary text-white text-center" style="width: 10%;"></th>
          </thead>
          <tbody>
<?php
            /*Recorremos todos los resultados, ya no hace falta invocar más a fetchAll como si fuera fetch...*/
            foreach ($arrayDatos as $datos) {
                echo '<tr>';

                  echo '<td class="text-center">' . $datos[0] . '</td>';
                  echo '<td class="text-center">' . $datos[1] . '</td>';
                  echo '<td class="text-center">' . $datos[2] . '</td>';
                  echo '<td class="">
                            <center>
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Acciones</button>
                                    <ul class="dropdown-menu">
                                        <a href="#" class="dropdown-item text-dark btnEdit" id="'.$datos[0].'" data-bs-toggle="modal" data-bs-target="#editarPModal" title="Editar permiso"><i class="fa fa-edit text-success"></i> Editar</a>
                                        <a href="#" class="dropdown-item text-dark btnDelete" id="'.$datos[0].'" title="Eliminar permiso"><i class="fa fa-trash text-danger"></i> Eliminar</a>
                                    </ul>
                                </div>
                            </center>
                        </td>';
                echo ' </tr>';
            }
?>
          </tbody>
        </table>
<?php
    }
?>

<?php
      if (isset($_POST['action']) && $_POST['action'] == "insert") {

        // Variable que almacena respuesta para el AJAX.
        $JSON = 0;

        // Capturamos los datos del formulario y los almacenamos en las variables.
        $permisoP = $_POST['inputPermiso'];
        $descP = $_POST['inputDesc'];

        if ($permisoP == '' || $permisoP == null || $descP == '' || $descP == null) {
            $JSON = 0; // Para el caso de datos vacios o nulos.
        } else {
          // Pasamos los parámetros para insertar permiso y almacenamos la sentencia SQL en variable.
          $insertarP = $conexion -> prepare("INSERT INTO tbl_permisos (p_permiso, p_descripcion) VALUES (:permisoP, :descP)");
          // Pasamos valores, con sentencias preparadas, para luego ejecutar.
          $insertarP -> bindParam(':permisoP', $permisoP, PDO::PARAM_STR);
          $insertarP -> bindParam(':descP', $descP, PDO::PARAM_STR);
          if($insertarP -> execute()) {
              $JSON = 1; // Se procede a insertar.
          } else {
            $JSON = 2; // Error en la inserción.
          }
        }

        // Finalmente imprimimos respuesta que interpretará AJAX posteriormente.
        echo json_encode($JSON);
    }

    // Se encarga de capturar el ID del permiso y devolver los datos del mismo.
    if (isset($_POST['edit_id'])) {
        // Capturamos el ID del permiso.
        $id = $_POST['edit_id'];

        $buscarIdP = $conexion -> prepare("SELECT * FROM tbl_permisos WHERE p_id = :id");
        $buscarIdP -> execute(['id' => $id]);
        $permisoData = $buscarIdP -> fetch();

        echo json_encode($permisoData);
    }

    if (isset($_POST['action']) && $_POST['action'] == "update") {

        // Variable que almacena respuesta para el AJAX.
        $JSON = 0;

        // Capturamos los datos del formulario y los almacenamos en las variables.
        $idP = $_POST['id'];
        $permisoP = $_POST['inputPermiso1'];
        $descP = $_POST['inputDesc1'];

        if ($permisoP == '' || $permisoP == null || $descP == '' || $descP == null) {
            $JSON = 0; // Para el caso de datos vacios o nulos.
        } else {
            // Pasamos los parámetros a la función actualizará el permiso.
            $actualizarP = $conexion -> prepare('UPDATE tbl_permisos SET p_permiso = :permisoP, p_descripcion = :descP, p_actualizar = NOW() WHERE p_id = :idP');
            $actualizarP -> bindValue(':permisoP', $permisoP, PDO::PARAM_STR);
            $actualizarP -> bindValue(':descP', $descP, PDO::PARAM_STR);
            $actualizarP -> bindValue(':idP', $idP, PDO::PARAM_INT);
            // Ejecutamos y verificamos que el permiso ha sido actualizado.
            if($actualizarP -> execute()) {
                $JSON = 1;
            } else {
              $JSON = 2;
            }
        }

        // Finalmente imprimimos respuesta que interpretará AJAX posteriormente.
        echo json_encode($JSON);
    }


    if (isset($_POST['del_id'])) {

        // Variable que almacena respuesta para el AJAX.
        $JSON = 0;

        // Capturamos el ID del permiso a eliminar.
        $id = $_POST['del_id'];

        // Pasamos los parámetros a la función que preparara la sentencia SQL de eliminación.
        $eliminarP = $conexion -> prepare("DELETE FROM tbl_permisos WHERE p_id = :id");

        if ($eliminarP -> execute(['id' => $id])) {
          $JSON = 1;
        } else {
          $JSON = 2;
        }

        // Finalmente imprimimos respuesta que interpretará AJAX posteriormente.
        echo json_encode($JSON);
    }

?>
