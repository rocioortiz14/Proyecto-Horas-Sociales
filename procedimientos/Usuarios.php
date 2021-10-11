<?php

    // Requerimos el archivo de control de sesiones.
    require_once '../configuracion/sesion.php';
    // Requerimos el archivo de conexion a la base de datos e iniciamos la sesión.
    require_once '../configuracion/conexion.php';

    $cargar = $conexion -> prepare("SELECT u.u_id, e.e_nombre, e.e_correo, u.u_usuario,
                                           u.u_permiso, p.p_permiso, u.u_estado
                                    FROM tbl_usuarios AS u
                                    LEFT JOIN tbl_permisos AS p ON u.u_permiso = p.p_id
                                    LEFT JOIN tbl_empleados AS e ON u.u_empleado = e.e_id
                                    ORDER BY u.u_id DESC");

    $cargar -> execute();
    /*Almacenamos el resultado de fetchAll en una variable*/
    $arrayDatos = $cargar -> fetchAll();
    //print_r($arrayDatos);

    if (isset($_POST['action']) && $_POST['action'] == "view") {

?>

        <table class="table table-hover table-sm" id="tblUsuarios">
          <thead>
            <th class="bg-primary text-white text-center" style="width: 3%;">ID</th>
            <th class="bg-primary text-white text-center" style="width: 32%;">NOMBRE COMPLETO</th>
            <th class="bg-primary text-white text-center" style="width: 20%;">CORREO</th>
            <th class="bg-primary text-white text-center" style="width: 10%;">USUARIO</th>
            <th class="bg-primary text-white text-center" style="width: 15%;">PERMISO</th>
            <th class="bg-primary text-white text-center" style="width: 10%;">ESTADO</th>
            <th class="bg-primary text-white text-center" style="width: 10%;">ACCIONES</th>
          </thead>
          <tbody>
<?php
            /*Recorremos todos los resultados, ya no hace falta invocar más a fetchAll como si fuera fetch...*/
            foreach ($arrayDatos as $datos) {
                echo '<tr>';

                  echo '<td class="text-center">' . $datos[0] . '</td>';
                  echo '<td class="text-center">' . $datos[1] . '</td>';
                  echo '<td class="text-center">' . $datos[2] . '</td>';
                  echo '<td class="text-center"><span class="badge badge-light text-dark">' . $datos[3] . '</span></td>';
                  echo '<td class="text-center">' . $datos[5] . '</td>';

                  // Estado de los usuarios.
                  if ($datos[6] == 1) {
                      echo '<td class="text-center"><span class="badge badge-primary">ACTIVO</span></td>';
                  } else if ($datos[6] == 2) {
                      echo '<td class="text-center"><span class="badge badge-info">INACTIVO</span></td>';
                  } else {
                      echo '<td class="text-center"><span class="badge badge-danger">BANEADO</span></td>';
                  }

                  echo '<td class="">
                            <center>
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Acciones</button>
                                    <ul class="dropdown-menu">
                                        <a href="#" class="dropdown-item text-dark btnEdit" id="'.$datos[0].'" data-bs-toggle="modal" data-bs-target="#editarUModal" title="Editar Usuario"><i class="fa fa-edit text-success"></i> Editar</a>
                                        <a href="#" class="dropdown-item text-dark btnDelete" id="'.$datos[0].'" title="Eliminar Usuario"><i class="fa fa-trash text-danger"></i> Eliminar</a>
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
      if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "insert") {

        // Variable que almacena respuesta para el AJAX.
        $responseJSON = 0;

        // Capturamos los datos del formulario y los almacenamos en las variables.
        $nombreU = mb_strtoupper($_POST['inputNombre'], 'UTF-8');
        $usuarioU = $_POST['inputUsuario'];
        $contraU = password_hash($_POST['inputContra'], PASSWORD_DEFAULT);
        $empleadoU = $_POST['imputEmpleado'];
        $estadoU = $_POST['inputEstado'];
        $permisoU = $_POST['inputPermiso'];

        if ($nombreU == '' || $usuarioU == '' || $contraU == '' || $empleadoU == '' || $estadoU == '' || $permisoU == '') {
            $responseJSON = 0;
            echo json_encode($responseJSON);
        } else {
            // Pasamos los parámetros para insertar usuario y almacenamos la sentencia SQL en variable.
            $insertar = $conexion -> prepare("INSERT INTO tbl_usuarios (u_nombre, u_usuario,
                                                                        u_contra, u_permiso,
                                                                        u_estado, u_empleado)
                                              VALUES (:nombreU, :usuarioU, :contraU,
                                                      :permisoU, :estadoU, :empleadoU)");
            // Pasamos valores, con sentencias preparadas, para luego ejecutar.
            $insertar -> bindParam(':nombreU', $nombreU, PDO::PARAM_STR);
            $insertar -> bindParam(':usuarioU', $usuarioU, PDO::PARAM_STR);
            $insertar -> bindParam(':contraU', $contraU, PDO::PARAM_STR);
            $insertar -> bindParam(':permisoU', $permisoU, PDO::PARAM_INT);
            $insertar -> bindParam(':estadoU', $estadoU, PDO::PARAM_INT);
            $insertar -> bindParam(':empleadoU', $empleadoU, PDO::PARAM_INT);
            try {
                $conexion -> beginTransaction();
                // Ejecutamos y verificamos que el usuario ha sido insertado.
                if($insertar -> execute()) {
                    $responseJSON = 1;
                }
                $conexion -> commit();
            } catch (Exception $e) {
                $responseJSON = 2;
                $conexion -> rollback();
                throw $e;
            }

            // Finalmente imprimimos respuesta que interpretará AJAX posteriormente.
            echo json_encode($responseJSON);
        }
    }

    // Se encarga de capturar el ID del usuario y devolver los datos del mismo.
    if (isset($_POST['edit_id'])) {
        // Capturamos el ID del usuario.
        $id = $_POST['edit_id'];

        $buscar = $conexion -> prepare("SELECT u.u_id, e.e_nombre, u.u_usuario,
                                               u.u_permiso, u.u_estado, u.u_empleado
                                        FROM tbl_usuarios AS u
                                        LEFT JOIN tbl_permisos AS p ON u.u_permiso = p.p_id
                                        LEFT JOIN tbl_empleados AS e ON u.u_empleado = e.e_id
                                        WHERE u.u_id = :id");
        $buscar -> execute(['id' => $id]);
        $data = $buscar -> fetch();

        echo json_encode($data);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "update") {

        // Variable que almacena respuesta para el AJAX.
        $responseJSON = 0;

        // Capturamos los datos del formulario y los almacenamos en las variables.
        $id = $_POST['id'];
        $nombreU = mb_strtoupper($_POST['inputNombre1'], 'UTF-8');
        $usuarioU = $_POST['inputUsuario1'];
        $contraU = password_hash($_POST['inputContra1'], PASSWORD_DEFAULT);
        $empleadoU = $_POST['imputEmpleado1'];
        $estadoU = $_POST['inputEstado1'];
        $permisoU = $_POST['inputPermiso1'];

        if ($nombreU == '' || $usuarioU == '' || $contraU == '' || $empleadoU == '' || $estadoU == '' || $permisoU == '') {
            $responseJSON = 0;
            echo json_encode($responseJSON);
        } else {
            // Pasamos los parámetros a la función actualizará el usuario.
            $actualizar = $conexion -> prepare('UPDATE tbl_usuarios SET u_nombre = :nombreU, u_usuario = :usuarioU,
                                                                        u_contra = :contraU, u_permiso = :permisoU,
                                                                        u_estado = :estadoU, u_empleado = :empleadoU
                                                                    WHERE u_id = :id');
            $actualizar -> bindValue(':nombreU', $nombreU, PDO::PARAM_STR);
            $actualizar -> bindValue(':usuarioU', $usuarioU, PDO::PARAM_STR);
            $actualizar -> bindValue(':contraU', $contraU, PDO::PARAM_STR);
            $actualizar -> bindValue(':permisoU', $permisoU, PDO::PARAM_INT);
            $actualizar -> bindValue(':estadoU', $estadoU, PDO::PARAM_INT);
            $actualizar -> bindValue(':empleadoU', $empleadoU, PDO::PARAM_INT);
            $actualizar -> bindValue(':id', $id, PDO::PARAM_INT);
            try {
                $conexion -> beginTransaction();
                // Ejecutamos y verificamos que el usuario ha sido actualizado.
                if($actualizar -> execute()) {
                    $responseJSON = 1;
                }
                $conexion -> commit();
            } catch (Exception $e) {
                $responseJSON = 2;
                $conexion -> rollback();
                throw $e;
            }

            // Finalmente imprimimos respuesta que interpretará AJAX posteriormente.
            echo json_encode($responseJSON);
        }
    }


    if (isset($_POST['del_id'])) {

        // Variable que almacena respuesta para el AJAX.
        $responseJSON = 0;

        // Capturamos el ID del usuario a eliminar.
        $id = $_POST['del_id'];

        // Pasamos los parámetros a la función que preparara la sentencia SQL de eliminación.
        $eliminar = $conexion -> prepare("DELETE FROM tbl_usuarios WHERE u_id = :id");

        if ($eliminar -> execute(['id' => $id])) {
          $responseJSON = 1;
        } else {
          $responseJSON = 2;
        }

        // Finalmente imprimimos respuesta que interpretará AJAX posteriormente.
        echo json_encode($responseJSON);
    }

?>
