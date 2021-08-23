<?php

    // Requerimos el archivo de control de sesiones.
    require_once '../configuracion/sesion.php';
    // Requerimos el archivo de conexion a la base de datos e iniciamos la sesión.
    require_once '../configuracion/conexion.php';

    $bUsuarios = $conexion -> prepare("SELECT * FROM tbl_usuarios");

    $bUsuarios -> execute();
    /*Almacenamos el resultado de fetchAll en una variable*/
    $arrayDatos = $bUsuarios -> fetchAll();
    //print_r($arrayDatos);

    if (isset($_POST['action']) && $_POST['action'] == "view") {

?>

        <table class="table table-hover table-sm" id="tblUsuarios">
          <thead>
            <th class="bg-primary text-white text-center" style="width: 3%;">ID</th>
            <th class="bg-primary text-white text-center" style="width: 27%;">Nombre completo</th>
            <th class="bg-primary text-white text-center" style="width: 35%;">Usuario</th>
            <th class="bg-primary text-white text-center" style="width: 10%;">Permiso</th>
            <th class="bg-primary text-white text-center" style="width: 15%;">Estado</th>
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

                  // Para tipos de roles.
                  if ($datos[4] == 1) {
                      echo '<td class="text-center"><span class="badge badge-primary">Administrador</span></td>';
                  } else if ($datos[4] == 2) {
                      echo '<td class="text-center"><span class="badge badge-info">Gerencia</span></td>';
                  } else if ($datos[4] == 3) {
                      echo '<td class="text-center"><span class="badge badge-secondary">Usuario</span></td>';
                  } else {
                      echo '<td class="text-center"><span class="badge badge-danger">Intruso</span></td>';
                  }

                  // Estado de los usuarios.
                  if ($datos[5] == 1) {
                      echo '<td class="text-center"><span class="badge badge-primary">Activo</span></td>';
                  } else if ($datos[5] == 2) {
                      echo '<td class="text-center"><span class="badge badge-info">Inactivo</span></td>';
                  } else {
                      echo '<td class="text-center"><span class="badge badge-danger">Baneado</span></td>';
                  }

                  echo '<td>
                            <center>
                            <div class="dropdown">
                                <button type="button" class="btn btn-sm btn-block btn-outline-primary dropdown-toggle font-weight-bold" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item btnDetail" id="'.$datos[0].'" data-toggle="modal" data-target="#detail_UModal"><i class="fas fa-eye text-primary"></i> Detalle</a>
                                    <a class="dropdown-item btnEdit" id="'.$datos[0].'" data-toggle="modal" data-target="#edit_UModal"><i class="fas fa-edit text-info"></i> Editar</a>
                                    <a class="dropdown-item btnDelete" id="'.$datos[0].'"><i class="fas fa-trash text-danger"></i> Eliminar</a>
                                </div>
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
        $nameU = $_POST['inputName'];
        $addressU = $_POST['inputAddress'];
        $phoneU = $_POST['inputPhone'];
        $emailU = $_POST['inputEmail'];
        $userU = $_POST['inputUser'];
        $passU = password_hash($_POST['inputPass'], PASSWORD_DEFAULT);
        $roleU = $_POST['inputRole'];

        //$data = [$nameU, $addressU, $phoneU, $emailU, $userU, $passU, $roleU];

        // Pasamos los parámetros para insertar usuario y almacenamos la sentencia SQL en variable.
        $insertarU = $conexion -> prepare("INSERT INTO usuarios (nombreU, direccionU, telefonoU, correoU, usuarioU, contraU, rolU)
                                          VALUES (:nameU, :addressU, :phoneU, :emailU, :userU, :passU, :roleU)");
        // Pasamos valores, con sentencias preparadas, para luego ejecutar.
        $insertarU -> bindParam(':nameU', $nameU, PDO::PARAM_STR);
        $insertarU -> bindParam(':addressU', $addressU, PDO::PARAM_STR);
        $insertarU -> bindParam(':phoneU', $phoneU, PDO::PARAM_STR);
        $insertarU -> bindParam(':emailU', $emailU, PDO::PARAM_STR);
        $insertarU -> bindParam(':userU', $userU, PDO::PARAM_STR);
        $insertarU -> bindParam(':passU', $passU, PDO::PARAM_STR);
        $insertarU -> bindParam(':roleU', $roleU, PDO::PARAM_INT);
        try {
            $conexion -> beginTransaction();
            // Ejecutamos y verificamos que el usuario ha sido insertado.
            if($insertarU -> execute()) {
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

    // Se encarga de capturar el ID del usuario y devolver los datos del mismo.
    if (isset($_POST['edit_id'])) {
        // Capturamos el ID del usuario.
        $id = $_POST['edit_id'];

        $buscarIdU = $conexion -> prepare("SELECT * FROM usuarios WHERE idU = :id");
        $buscarIdU -> execute(['id' => $id]);
        $usuarioData = $buscarIdU -> fetch();

        echo json_encode($usuarioData);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "update") {

        // Variable que almacena respuesta para el AJAX.
        $responseJSON = 0;

        // Capturamos los datos del formulario y los almacenamos en las variables.
        $idU = $_POST['id'];
        $nameU = $_POST['inputName1'];
        $addressU = $_POST['inputAddress1'];
        $phoneU = $_POST['inputPhone1'];
        $emailU = $_POST['inputEmail1'];
        $userU = $_POST['inputUser1'];
        $passU = password_hash($_POST['inputPass1'], PASSWORD_DEFAULT);
        $roleU = $_POST['inputRole1'];
        //$data = [':nameU' => $nameU, ':addressU' => $addressU, ':phoneU' => $phoneU, ':emailU' => $emailU, ':userU' => $userU, ':passU' => $passU, ':roleU' => $roleU, ':idU' => $idU];

        // Pasamos los parámetros a la función actualizará el usuario.
        $actualizarU = $conexion -> prepare('UPDATE usuarios SET nombreU = :nameU, direccionU = :addressU, telefonoU = :phoneU, correoU = :emailU,
                                            usuarioU = :userU, contraU = :passU, rolU = :roleU WHERE idU = :idU');
        $actualizarU -> bindValue(':nameU', $nameU, PDO::PARAM_STR);
        $actualizarU -> bindValue(':addressU', $addressU, PDO::PARAM_STR);
        $actualizarU -> bindValue(':phoneU', $phoneU, PDO::PARAM_STR);
        $actualizarU -> bindValue(':emailU', $emailU, PDO::PARAM_STR);
        $actualizarU -> bindValue(':userU', $userU, PDO::PARAM_STR);
        $actualizarU -> bindValue(':passU', $passU, PDO::PARAM_STR);
        $actualizarU -> bindValue(':roleU', $roleU, PDO::PARAM_INT);
        $actualizarU -> bindValue(':idU', $idU, PDO::PARAM_INT);
        try {
            $conexion -> beginTransaction();
            // Ejecutamos y verificamos que el usuario ha sido actualizado.
            if($actualizarU -> execute()) {
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


    if (isset($_POST['del_id'])) {

        // Variable que almacena respuesta para el AJAX.
        $responseJSON = 0;

        // Capturamos el ID del usuario a eliminar.
        $id = $_POST['del_id'];

        // Pasamos los parámetros a la función que preparara la sentencia SQL de eliminación.
        $eliminarU = $conexion -> prepare("DELETE FROM usuarios WHERE idU = :id");

        if ($eliminarU -> execute(['id' => $id])) {
          $responseJSON = 1;
        } else {
          $responseJSON = 2;
        }

        // Finalmente imprimimos respuesta que interpretará AJAX posteriormente.
        echo json_encode($responseJSON);
    }

?>
