<?php

  // Requerimos el archivo de control de sesiones.
  require_once '../configuracion/sesion.php';
  // Requerimos el archivo de conexion a la base de datos e iniciamos la sesión.
  require_once '../configuracion/conexion.php';

    $bClientes = $conexion -> prepare("SELECT * FROM tbl_clientes");

    $bClientes -> execute();
    /*Almacenamos el resCltado de fetchAll en Cna variable*/
    $arrayDatos = $bClientes -> fetchAll();
    //print_r($arrayDatos);

    if (isset($_POST['action']) && $_POST['action'] == "view") {

?>

        <table class="table table-hover table-sm" id="tblClientes">
          <thead>
            <th class="bg-primary text-white text-center" style="width: 3%;">ID</th>
            <th class="bg-primary text-white text-center" style="width: 18%;">Nombres</th>
            <th class="bg-primary text-white text-center" style="width: 18%;">Apellidos</th>
            <th class="bg-primary text-white text-center" style="width: 20%;">Dirección</th>
            <th class="bg-primary text-white text-center" style="width: 10%;">Telefono</th>
            <th class="bg-primary text-white text-center" style="width: 10%;">Correo</th>
            <th class="bg-primary text-white text-center" style="width: 10%;">Estado</th>
            <th class="bg-primary text-white text-center" style="width: 10%;"></th>
          </thead>
          <tbody>
<?php
            /*Recorremos todos los resultados, ya no hace falta invocar más a fetchAll como si fCera fetch...*/
            foreach ($arrayDatos as $datos) {
                echo '<tr>';

                  echo '<td class="text-center">' . $datos[0] . '</td>';
                  echo '<td class="text-center">' . $datos[1] . '</td>';
                  echo '<td class="text-center">' . $datos[2] . '</td>';
                  echo '<td class="text-center">' . $datos[3] . '</td>';
                  echo '<td class="text-center">' . $datos[4] . '</td>';
                  echo '<td class="text-center">' . $datos[5] . '</td>';
                  

                 
                  // Estado de los clientes.
                  if ($datos[6] == 1) {
                      echo '<td class="text-center"><span class="badge badge-primary">Activo</span></td>';
                  } else if ($datos[6] == 2) {
                      echo '<td class="text-center"><span class="badge badge-info">Inactivo</span></td>';
                  } else {
                      echo '<td class="text-center"><span class="badge badge-danger">Baneado</span></td>';
                  }

                  echo '<td class="">
                            <center>
                            <div class="btn-group">
                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Acciones</button>
                            <ul class="dropdown-menu">
                                <a href="#" class="dropdown-item text-dark btnEdit" id="'.$datos[0].'" data-bs-toggle="modal" data-bs-target="#editarClModal" title="Editar Cliente"><i class="fa fa-edit text-success"></i> Editar</a>
                                <a href="#" class="dropdown-item text-dark btnDelete" id="'.$datos[0].'" title="Eliminar Cliente"><i class="fa fa-trash text-danger"></i> Eliminar</a>
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
        $clienteNombre = $_POST['inputNombre'];
        $clienteApellido = $_POST['inputApellido'];
        $clienteDireccion = $_POST['inputDireccion'];
        $clienteTelefono = $_POST['inputTelefono'];
        $clienteEmail = $_POST['inputCorreo'];
        $clienteEstado = $_POST['inputEstado'];

        if ($clienteNombre == '' || $clienteNombre == null || $clienteApellido == '' || $clienteApellido == null|| $clienteDireccion == '' || $clienteDireccion == null|| $clienteTelefono == '' || $clienteTelefono == null || $clienteCorreo == '' || $clienteCorreo == null|| $clienteestado == '' || $clienteestado == null) {
            $JSON = 0; // Para el caso de datos vacios o nulos.
        } else {
          // Pasamos los parámetros para insertar permiso y almacenamos la sentencia SQL en variable.
          $insertarCl = $conexion -> prepare("INSERT INTO tbl_clientes (cliente_Nombre, cliente_Apellido, cliente_Direccion, cliente_Telefono, cliente_Correo, cliente_estado) VALUES (:clienteNombre, :clienteApellido, clienteeDireccion, clienteTelefono, clienteCorreo, clienteestado)");
          // Pasamos valores, con sentencias preparadas, para luego ejecutar.
          $insertarCl -> bindParam(':clienteNombre', $clienteNombre, PDO::PARAM_STR);
          $insertarCl -> bindParam(':clienteApellido', $clienteApellido, PDO::PARAM_STR);
          $insertarCl -> bindParam(':clienteDireccion', $clienteDireccion, PDO::PARAM_STR);
          $insertarCl -> bindParam(':clienteTelefono', $clienteTelefono, PDO::PARAM_STR);
          $insertarCl -> bindParam(':clienteCorreo', $clienteCorreo, PDO::PARAM_STR);
          $insertarCl -> bindParam(':clienteestado', $clienteestado, PDO::PARAM_STR);
          if($insertarCl -> execute()) {
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

        $buscarIdCl = $conexion -> prepare("SELECT * FROM tbl_clientes WHERE cliente_Id = :id");
        $buscarIdCl -> execute(['id' => $id]);
        $clienteData = $buscarIdCl -> fetch();

        echo json_encode($clienteData);
    }

    if (isset($_POST['action']) && $_POST['action'] == "update") {

        // Variable que almacena respuesta para el AJAX.
        $JSON = 0;

        // Capturamos los datos del formulario y los almacenamos en las variables.
        $idCl= $_POST['id'];
        $clienteNombre = $_POST['inputNombre1'];
        $clienteApellido = $_POST['inputApellido1'];
        $clienteDireccion = $_POST['inputDireccion1'];
        $clienteTelefono = $_POST['inputTelefono1'];
        $clienteCorreo = $_POST['inputCorreo1'];
        $clienteestado = $_POST['inputestado1'];

        if ($clienteNombre == '' || $clienteNombre == null || $clienteApellido == '' || $clienteApellido == null|| $clienteDireccion == '' || $clienteDireccion == null|| $clienteTelefono == '' || $clienteTelefono == null || $clienteCorreo == '' || $clienteCorreo == null|| $clienteestado == '' || $clienteestado == null) {
            $JSON = 0; // Para el caso de datos vacios o nulos.
        } else {
            // Pasamos los parámetros a la función actualizará el permiso.
            $actualizarCl = $conexion -> prepare('UPDATE tbl_clientes SET cliente_Nombre = :clienteNombre, cliente_Apellidos = :clienteApellidos, cliente_Direccion = :clienteDireccion, cliente_Telefono = :clienteTelefono, cliente_Correo = :clienteCorreo, cliente_estado = :clienteestado, cl_actualizar = NOW() WHERE cliente_Id = :idCl');
            $actualizarCl -> bindValue(':clienteNombre', $clienteNombre, PDO::PARAM_STR);
            $actualizarCl -> bindValue(':clienteApellido', $clienteApellido, PDO::PARAM_STR);
            $actualizarCl -> bindValue(':clienteDireccion', $clienteDireccion, PDO::PARAM_STR);
            $actualizarCl -> bindValue(':clienteTelefono', $clienteTelefono, PDO::PARAM_STR);
            $actualizarCl -> bindValue(':clienteCorreo', $clienteCorreo, PDO::PARAM_STR);
            $actualizarCl -> bindValue(':clienteestado', $clienteestado, PDO::PARAM_STR);
            $actualizarCl -> bindValue(':idCl', $idCl, PDO::PARAM_INT);
            // Ejecutamos y verificamos que el permiso ha sido actualizado.
            if($actualizarCl -> execute()) {
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
        $eliminarCl = $conexion -> prepare("DELETE FROM tbl_clientes WHERE clientes_Id = :id");

        if ($eliminarCl -> execute(['id' => $id])) {
          $JSON = 1;
        } else {
          $JSON = 2;
        }

        // Finalmente imprimimos respuesta que interpretará AJAX posteriormente.
        echo json_encode($JSON);
    }

?>
