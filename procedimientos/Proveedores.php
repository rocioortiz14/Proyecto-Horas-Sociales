<?php

    // Requerimos el archivo de control de sesiones.
    require_once '../configuracion/sesion.php';
    // Requerimos el archivo de conexion a la base de datos e iniciamos la sesión.
    require_once '../configuracion/conexion.php';

    $cargar = $conexion -> prepare("SELECT * FROM tbl_proveedores");

    $cargar -> execute();
    /*Almacenamos el resultado de fetchAll en una variable*/
    $arrayDatos = $cargar -> fetchAll();
    //print_r($arrayDatos);

    if (isset($_POST['action']) && $_POST['action'] == "view") {

?>

        <table class="table table-hover table-sm" id="tblProveedores">
          <thead>
            <th class="bg-primary text-white text-center" style="width: 5%;">ID</th>
            <th class="bg-primary text-white text-center" style="width: 7%;">Código</th>
            <th class="bg-primary text-white text-center" style="width: 10%;">Nit Proveedor</th>
            <th class="bg-primary text-white text-center" style="width: 15%;">Nombre Proveedor</th>
            <th class="bg-primary text-white text-center" style="width: 15%;">Dirección Proveedor</th>
            <th class="bg-primary text-white text-center" style="width: 10%;">Telefono Proveedor</th>
            <th class="bg-primary text-white text-center" style="width: 15%;">Correo Proveedor</th>
            <th class="bg-primary text-white text-center" style="width: 15%;">Razon Social</th>
            <th class="bg-primary text-white text-center" style="width: 8%;"></th>
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
                  echo '<td class="text-center">' . $datos[7] . '</td>';

                  echo '<td class="">
                            <center>
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Acciones</button>
                                    <ul class="dropdown-menu">
                                        <a href="#" class="dropdown-item text-dark btnEdit" id="'.$datos[0].'" data-bs-toggle="modal" data-bs-target="#editarPrvModal" title="Editar Proveedor"><i class="fa fa-edit text-success"></i> Editar</a>
                                        <a href="#" class="dropdown-item text-dark btnDelete" id="'.$datos[0].'" title="Eliminar Proveedor"><i class="fa fa-trash text-danger"></i> Eliminar</a>
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
        $proveedorCod = $_POST['inputCodigo'];
        $proveedorNit = $_POST['inputNit'];
        $proveedorN = mb_strtoupper($_POST['inputNombre'], 'UTF-8');
        $proveedorD = mb_strtoupper($_POST['inputDireccion'], 'UTF-8');
        $proveedorT = $_POST['inputTelefono'];
        $proveedorC = $_POST['inputCorreo'];
        $proveedorR = mb_strtoupper($_POST['inputRazon'], 'UTF-8');

        if ($proveedorCod == '' || $proveedorCod == null ||
            $proveedorNit == '' || $proveedorNit == null ||
            $proveedorN == '' || $proveedorN == null ||
            $proveedorD == '' || $proveedorD == null ||
            $proveedorT == '' || $proveedorT == null ||
            $proveedorC == '' || $proveedorC == null ||
            $proveedorR == '' || $proveedorR == null ) {
            $JSON = 0; // Para el caso de datos vacios o nulos.
        } else {
          // Pasamos los parámetros para insertar Cliente y almacenamos la sentencia SQL en variable.
          $insertar = $conexion -> prepare("INSERT INTO tbl_proveedores (prv_codigo,
                                                                        prv_nit,
                                                                        prv_nombre,
                                                                        prv_direccion,
                                                                        prv_telefono,
                                                                        prv_correo,
                                                                        prv_razonsocial)
                                                                        VALUES (:proveedorCod,
                                                                        :proveedorNit,
                                                                        :proveedorN,
                                                                        :proveedorD,
                                                                        :proveedorT,
                                                                        :proveedorC,
                                                                        :proveedorR)");
          // Pasamos valores, con sentencias preparadas, para luego ejecutar.
          $insertar -> bindParam(':proveedorCod', $proveedorCod, PDO::PARAM_STR);
          $insertar -> bindParam(':proveedorNit', $proveedorNit, PDO::PARAM_STR);
          $insertar -> bindParam(':proveedorN', $proveedorN, PDO::PARAM_STR);
          $insertar -> bindParam(':proveedorD', $proveedorD, PDO::PARAM_STR);
          $insertar -> bindParam(':proveedorT', $proveedorT, PDO::PARAM_STR);
          $insertar -> bindParam(':proveedorC', $proveedorC, PDO::PARAM_STR);
          $insertar -> bindParam(':proveedorR', $proveedorR, PDO::PARAM_STR);
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

        $buscar = $conexion -> prepare("SELECT * FROM tbl_proveedores WHERE prv_id = :id");
        $buscar -> execute(['id' => $id]);
        $proveedorData = $buscar -> fetch();

        echo json_encode($proveedorData);
    }

    if (isset($_POST['action']) && $_POST['action'] == "update") {

        // Variable que almacena respuesta para el AJAX.
        $JSON = 0;

        // Capturamos los datos del formulario y los almacenamos en las variables.
        $IdPrv = $_POST['id'];
        $proveedorCod = $_POST['inputCodigo1'];
        $proveedorNit = $_POST['inputNit1'];
        $proveedorN = mb_strtoupper($_POST['inputNombre1']);
        $proveedorD = mb_strtoupper($_POST['inputDireccion1']);
        $proveedorT = $_POST['inputTelefono1'];
        $proveedorC = $_POST['inputCorreo1'];
        $proveedorR = mb_strtoupper($_POST['inputRazon1']);

        if ($proveedorCod == '' || $proveedorCod == null ||
            $proveedorNit == '' || $proveedorNit == null ||
            $proveedorN == '' || $proveedorN == null ||
            $proveedorD == '' || $proveedorD == null ||
            $proveedorT == '' || $proveedorT == null ||
            $proveedorC == '' || $proveedorC == null ||
            $proveedorR == '' || $proveedorR == null ) {
            $JSON = 0; // Para el caso de datos vacios o nulos.
        } else {
            // Pasamos los parámetros a la función actualizará el Cliente.
            $actualizar = $conexion -> prepare('UPDATE tbl_proveedores SET
                                                  prv_codigo = :proveedorCod,
                                                  prv_nit = :proveedorNit,
                                                  prv_nombre = :proveedorN,
                                                  prv_direccion = :proveedorD,
                                                  prv_telefono = :proveedorT,
                                                  prv_correo = :proveedorC,
                                                  prv_razonsocial = :proveedorR
                                                  WHERE prv_id = :IdPrv');
            $actualizar -> bindValue(':proveedorCod', $proveedorCod, PDO::PARAM_STR);
            $actualizar -> bindValue(':proveedorNit', $proveedorNit, PDO::PARAM_STR);
            $actualizar -> bindValue(':proveedorN', $proveedorN, PDO::PARAM_STR);
            $actualizar -> bindValue(':proveedorD', $proveedorD, PDO::PARAM_STR);
            $actualizar -> bindValue(':proveedorT', $proveedorT, PDO::PARAM_STR);
            $actualizar -> bindValue(':proveedorC', $proveedorC, PDO::PARAM_STR);
            $actualizar -> bindValue(':proveedorR', $proveedorR, PDO::PARAM_STR);
            $actualizar -> bindValue(':IdPrv', $IdPrv, PDO::PARAM_INT);
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
        $eliminar = $conexion -> prepare("DELETE FROM tbl_proveedores WHERE prv_id = :id");

        if ($eliminar -> execute(['id' => $id])) {
          $JSON = 1;
        } else {
          $JSON = 2;
        }

        // Finalmente imprimimos respuesta que interpretará AJAX posteriormente.
        echo json_encode($JSON);
    }

?>
