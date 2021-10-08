<?php

    // Requerimos el archivo de control de sesiones.
    require_once '../configuracion/sesion.php';
    // Requerimos el archivo de conexion a la base de datos e iniciamos la sesión.
    require_once '../configuracion/conexion.php';

    $cargar = $conexion -> prepare("SELECT * FROM tbl_empleado");

    $cargar -> execute();
    /*Almacenamos el resultado de fetchAll en una variable*/
    $arrayDatos = $cargar -> fetchAll();
    //print_r($arrayDatos);

    if (isset($_POST['action']) && $_POST['action'] == "view") {

?>

        <table class="table table-hover table-sm" id="tblEmpleados">
          <thead>
            <th class="bg-primary text-white text-center" style="width: 5%;">ID</th>
            <th class="bg-primary text-white text-center" style="width: 10%;">Codigo</th>
            <th class="bg-primary text-white text-center" style="width: 20%;">Nombre</th>
            <th class="bg-primary text-white text-center" style="width: 5%;">Telefono</th>
            <th class="bg-primary text-white text-center" style="width: 15%;">Correo</th>
            <th class="bg-primary text-white text-center" style="width: 20%;">Dirección</th>
            <th class="bg-primary text-white text-center" style="width: 15%;">Cargo</th>
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
                  echo '<td class="text-center">' . $datos[6] . '</td>';
                  echo '<td class="">
                            <center>
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Acciones</button>
                                    <ul class="dropdown-menu">
                                        <a href="#" class="dropdown-item text-dark btnEdit" id="'.$datos[0].'" data-bs-toggle="modal" data-bs-target="#editarEmplModal" title="Editar Empleados"><i class="fa fa-edit text-success"></i> Editar</a>
                                        <a href="#" class="dropdown-item text-dark btnDelete" id="'.$datos[0].'" title="Eliminar Empleado"><i class="fa fa-trash text-danger"></i> Eliminar</a>
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
        $empleadosC = $_POST['inputCodigo'];
        $empleadosN = $_POST['inputNombre'];
        $empleadosT = $_POST['inputTelefono'];
        $empleadosC = $_POST['inputCorreo'];
        $empleadosD = $_POST['inputDireccion'];
        $empleadosCa = $_POST['inputCargo'];

        if ($empleadosC == '' || $empleadosC == null ||
            $empleadosN == '' || $empleadosN == null ||
            $empleadosT == '' || $empleadosT == null ||
            $empleadosC == '' || $empleadosC == null ||
            $empleadosD == '' || $empleadosD == null ||
            $empleadosCa == ''|| $empleadosCa == null) {
            $JSON = 0; // Para el caso de datos vacios o nulos.
        } else {
          // Pasamos los parámetros para insertar empleados y almacenamos la sentencia SQL en variable.
          $insertar = $conexion -> prepare("INSERT INTO tbl_empleado (e_codigo,
                                                                        e_nombre,
                                                                        e_telefono,
                                                                        e_correo,
                                                                        e_direccion,
                                                                        e_cargo)
                                                                        VALUES (:empleadosC,
                                                                        :empleadosN,
                                                                        :empleadosT,
                                                                        :empleadosC,
                                                                        :empleadosD,
                                                                        :empleadosCa)");
          // Pasamos valores, con sentencias preparadas, para luego ejecutar.
          $insertar -> bindParam(':empleadosC', $empleadosC, PDO::PARAM_STR);
          $insertar -> bindParam(':empleadosN', $empleadosN, PDO::PARAM_STR);
          $insertar -> bindParam(':empleadosT', $empleadosT, PDO::PARAM_STR);
          $insertar -> bindParam(':empleadosC', $empleadosC, PDO::PARAM_STR);
          $insertar -> bindParam(':empleadosD', $empleadosD, PDO::PARAM_STR);
          $insertar -> bindParam(':empleadosCa', $empleadosCa, PDO::PARAM_STR);
          if($insertar -> execute()) {
              $JSON = 1; // Se procede a insertar.
          } else {
            $JSON = 2; // Error en la inserción.
          }
        }

        // Finalmente imprimimos respuesta que interpretará AJAX posteriormente.
        echo json_encode($JSON);
    }

    // Se encarga de capturar el ID del empleados y devolver los datos del mismo.
    if (isset($_POST['edit_id'])) {
        // Capturamos el ID del empleados.
        $id = $_POST['edit_id'];

        $buscar = $conexion -> prepare("SELECT * FROM tbl_empleado WHERE id_empl = :id");
        $buscar -> execute(['id' => $id]);
        $empleadoData = $buscar -> fetch();

        echo json_encode($empleadoData);
    }

    if (isset($_POST['action']) && $_POST['action'] == "update") {

        // Variable que almacena respuesta para el AJAX.
        $JSON = 0;

        // Capturamos los datos del formulario y los almacenamos en las variables.
        $idEmp = $_POST['id'];
        $empleadosC = $_POST['inputCodigo1'];
        $empleadosN = $_POST['inputNombre1'];
        $empleadosT = $_POST['inputTelefono1'];
        $empleadosC = $_POST['inputCorreo1'];
        $empleadosD = $_POST['inputDireccion1'];
        $empleadosCa = $_POST['inputCargo1'];

        if ($empleadosC == '' || $empleadosC == null ||
            $empleadosN == '' || $empleadosN == null ||
            $empleadosT == '' || $empleadosT == null ||
            $empleadosC == '' || $empleadosC == null ||
            $empleadosD == '' || $empleadosD == null ||
            $empleadosCa == ''|| $empleadosCa == null ) {
            $JSON = 0; // Para el caso de datos vacios o nulos.
        } else {
            // Pasamos los parámetros a la función actualizará el empleados.
            $actualizar = $conexion -> prepare('UPDATE tbl_empleado SET
                                                  e_codigo = :empleadosC,
                                                  e_nombre = :empleadosN,
                                                  e_telefono = :empleadosT,
                                                  e_correo = :empleadosC,
                                                  e_direccion = :empleadosD,
                                                  e_cargo = :empleadosCa
                                                  WHERE id_empl = :idEmp');
            $actualizar -> bindValue(':empleadosC', $empleadosC, PDO::PARAM_STR);
            $actualizar -> bindValue(':empleadosN', $empleadosN, PDO::PARAM_STR);
            $actualizar -> bindValue(':empleadosT', $empleadosT, PDO::PARAM_STR);
            $actualizar -> bindValue(':empleadosC', $empleadosC, PDO::PARAM_STR);
            $actualizar -> bindValue(':empleadosD', $empleadosD, PDO::PARAM_STR);
            $actualizar -> bindValue(':empleadosCa', $empleadosCa, PDO::PARAM_STR);
            $actualizar -> bindValue(':idEmp', $idEmp, PDO::PARAM_INT);
            // Ejecutamos y verificamos que el empleados ha sido actualizado.
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

        // Capturamos el ID del empleados a eliminar.
        $id = $_POST['del_id'];

        // Pasamos los parámetros a la función que preparara la sentencia SQL de eliminación.
        $eliminar = $conexion -> prepare("DELETE FROM tbl_empleado WHERE id_empl = :id");

        if ($eliminar -> execute(['id' => $id])) {
          $JSON = 1;
        } else {
          $JSON = 2;
        }

        // Finalmente imprimimos respuesta que interpretará AJAX posteriormente.
        echo json_encode($JSON);
    }

?>
