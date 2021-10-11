<?php

    // Requerimos el archivo de control de sesiones.
    require_once '../configuracion/sesion.php';
    // Requerimos el archivo de conexion a la base de datos e iniciamos la sesión.
    require_once '../configuracion/conexion.php';

    $cargar = $conexion -> prepare("SELECT * FROM tbl_clientes");

    $cargar -> execute();
    /*Almacenamos el resultado de fetchAll en una variable*/
    $arrayDatos = $cargar -> fetchAll();
    //print_r($arrayDatos);

    if (isset($_POST['action']) && $_POST['action'] == "view") {

?>

        <table class="table table-hover table-sm" id="tblClientes">
          <thead>
            <th class="bg-primary text-white text-center" style="width: 5%;">ID</th>
            <th class="bg-primary text-white text-center" style="width: 20%;">Nombre</th>
            <th class="bg-primary text-white text-center" style="width: 20%;">Apellidos</th>
            <th class="bg-primary text-white text-center" style="width: 20%;">Dirección</th>
            <th class="bg-primary text-white text-center" style="width: 5%;">Telefono</th>
            <th class="bg-primary text-white text-center" style="width: 15%;">Correo</th>
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
                  echo '<td class="text-center">' . $datos[3] . '</td>';
                  echo '<td class="text-center">' . $datos[4] . '</td>';
                  echo '<td class="text-center">' . $datos[5] . '</td>';

                  echo '<td class="">
                            <center>
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Acciones</button>
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
        $clienteN = mb_strtoupper($_POST['inputNombre'], 'UTF-8');
        $clienteA = mb_strtoupper($_POST['inputApellido'], 'UTF-8');
        $clienteD = mb_strtoupper($_POST['inputDireccion'], 'UTF-8');
        $clienteT = $_POST['inputTelefono'];
        $clienteC = $_POST['inputCorreo'];

        if ($clienteN == '' || $clienteN == null ||
            $clienteA == '' || $clienteA == null ||
            $clienteD == '' || $clienteD == null ||
            $clienteT == '' || $clienteT == null ||
            $clienteC == '' || $clienteC == null ) {
            $JSON = 0; // Para el caso de datos vacios o nulos.
        } else {
          // Pasamos los parámetros para insertar Cliente y almacenamos la sentencia SQL en variable.
          $insertar = $conexion -> prepare("INSERT INTO tbl_clientes (cliente_Nombre,
                                                                        cliente_Apellido,
                                                                        cliente_Direccion,
                                                                        cliente_Telefono,
                                                                        cliente_Correo)
                                                                        VALUES (:clienteN,
                                                                        :clienteA,
                                                                        :clienteD,
                                                                        :clienteT,
                                                                        :clienteC)");
          // Pasamos valores, con sentencias preparadas, para luego ejecutar.
          $insertar -> bindParam(':clienteN', $clienteN, PDO::PARAM_STR);
          $insertar -> bindParam(':clienteA', $clienteA, PDO::PARAM_STR);
          $insertar -> bindParam(':clienteD', $clienteD, PDO::PARAM_STR);
          $insertar -> bindParam(':clienteT', $clienteT, PDO::PARAM_STR);
          $insertar -> bindParam(':clienteC', $clienteC, PDO::PARAM_STR);
          if($insertar -> execute()) {
              $JSON = 1; // Se procede a insertar.
          } else {
            $JSON = 2; // Error en la inserción.
          }
        }

        // Finalmente imprimimos respuesta que interpretará AJAX posteriormente.
        echo json_encode($JSON);
    }

    // Se encarga de capturar el ID del Cliente y devolver los datos del mismo.
    if (isset($_POST['edit_id'])) {
        // Capturamos el ID del Cliente.
        $id = $_POST['edit_id'];

        $buscar = $conexion -> prepare("SELECT * FROM tbl_clientes WHERE cliente_Id = :id");
        $buscar -> execute(['id' => $id]);
        $clienteData = $buscar -> fetch();

        echo json_encode($clienteData);
    }

    if (isset($_POST['action']) && $_POST['action'] == "update") {

        // Variable que almacena respuesta para el AJAX.
        $JSON = 0;

        // Capturamos los datos del formulario y los almacenamos en las variables.
        $idCl = $_POST['id'];
        $clienteN = mb_strtoupper($_POST['inputNombre1'], 'UTF-8');
        $clienteA = mb_strtoupper($_POST['inputApellido1'], 'UTF-8');
        $clienteD = mb_strtoupper($_POST['inputDireccion1'], 'UTF-8');
        $clienteT = $_POST['inputTelefono1'];
        $clienteC = $_POST['inputCorreo1'];

        if ($clienteN == '' || $clienteN == null ||
            $clienteA == '' || $clienteA == null ||
            $clienteD == '' || $clienteD == null ||
            $clienteT == '' || $clienteT == null ||
            $clienteC == '' || $clienteC == null ) {
            $JSON = 0; // Para el caso de datos vacios o nulos.
        } else {
            // Pasamos los parámetros a la función actualizará el Cliente.
            $actualizar = $conexion -> prepare('UPDATE tbl_clientes SET
                                                  cliente_Nombre = :clienteN,
                                                  cliente_Apellido = :clienteA,
                                                  cliente_Direccion = :clienteD,
                                                  cliente_Telefono = :clienteT,
                                                  cliente_Correo = :clienteC
                                                  WHERE cliente_Id = :idCl');
            $actualizar -> bindValue(':clienteN', $clienteN, PDO::PARAM_STR);
            $actualizar -> bindValue(':clienteA', $clienteA, PDO::PARAM_STR);
            $actualizar -> bindValue(':clienteD', $clienteD, PDO::PARAM_STR);
            $actualizar -> bindValue(':clienteT', $clienteT, PDO::PARAM_STR);
            $actualizar -> bindValue(':clienteC', $clienteC, PDO::PARAM_STR);
            $actualizar -> bindValue(':idCl', $idCl, PDO::PARAM_INT);
            // Ejecutamos y verificamos que el Cliente ha sido actualizado.
            if($actualizar -> execute()) {
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

        // Capturamos el ID del Cliente a eliminar.
        $id = $_POST['del_id'];

        // Pasamos los parámetros a la función que preparara la sentencia SQL de eliminación.
        $eliminar = $conexion -> prepare("DELETE FROM tbl_clientes WHERE cliente_Id = :id");

        if ($eliminar -> execute(['id' => $id])) {
          $JSON = 1;
        } else {
          $JSON = 2;
        }

        // Finalmente imprimimos respuesta que interpretará AJAX posteriormente.
        echo json_encode($JSON);
    }

?>
