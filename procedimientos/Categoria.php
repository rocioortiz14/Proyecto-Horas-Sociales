<?php

    // Requerimos el archivo de control de sesiones.
    require_once '../configuracion/sesion.php';
    // Requerimos el archivo de conexion a la base de datos e iniciamos la sesión.
    require_once '../configuracion/conexion.php';

    $cargar = $conexion -> prepare("SELECT * FROM tbl_categorias");

    $cargar -> execute();
    /*Almacenamos el resultado de fetchAll en una variable*/
    $arrayDatos = $cargar -> fetchAll();
    //print_r($arrayDatos);

    if (isset($_POST['action']) && $_POST['action'] == "view") {

?>

        <table class="table table-hover table-sm" id="tblCategorias">
          <thead>
            <th class="bg-primary text-white text-center" style="width: 5%;">ID</th>
            <th class="bg-primary text-white text-center" style="width: 25%;">Categoría</th>
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
                                    <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Acciones</button>
                                    <ul class="dropdown-menu">
                                        <a href="#" class="dropdown-item text-dark btnEdit" id="'.$datos[0].'" data-bs-toggle="modal" data-bs-target="#editarCModal" title="Editar categoría"><i class="fa fa-edit text-success"></i> Editar</a>
                                        <a href="#" class="dropdown-item text-dark btnDelete" id="'.$datos[0].'" title="Eliminar categoría"><i class="fa fa-trash text-danger"></i> Eliminar</a>
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
        $categoriaC = $_POST['inputCategoria'];
        $descC = $_POST['inputDesc'];

        if ($categoriaC == '' || $categoriaC == null || $descC == '' || $descC == null) {
            $JSON = 0; // Para el caso de datos vacios o nulos.
        } else {
          // Pasamos los parámetros para insertar permiso y almacenamos la sentencia SQL en variable.
          $insertar = $conexion -> prepare("INSERT INTO tbl_categorias (c_nombre, c_desc) VALUES (:categoriaC, :descC)");
          // Pasamos valores, con sentencias preparadas, para luego ejecutar.
          $insertar -> bindParam(':categoriaC', $categoriaC, PDO::PARAM_STR);
          $insertar -> bindParam(':descC', $descC, PDO::PARAM_STR);
          if($insertar -> execute()) {
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

        $buscar = $conexion -> prepare("SELECT * FROM tbl_categorias WHERE c_id = :id");
        $buscar -> execute(['id' => $id]);
        $categoriaData = $buscar -> fetch();

        echo json_encode($categoriaData);
    }

    if (isset($_POST['action']) && $_POST['action'] == "update") {

        // Variable que almacena respuesta para el AJAX.
        $JSON = 0;

        // Capturamos los datos del formulario y los almacenamos en las variables.
        $idC = $_POST['id'];
        $categoriaC = $_POST['inputCategoria1'];
        $descC = $_POST['inputDesc1'];

        if ($categoriaC == '' || $categoriaC == null || $descC == '' || $descC == null) {
            $JSON = 0; // Para el caso de datos vacios o nulos.
        } else {
            // Pasamos los parámetros a la función actualizará el permiso.
            $actualizar = $conexion -> prepare('UPDATE tbl_categorias SET c_nombre = :categoriaC, c_desc = :descC, c_actualizar = NOW() WHERE c_id = :idC');
            $actualizar -> bindValue(':categoriaC', $categoriaC, PDO::PARAM_STR);
            $actualizar -> bindValue(':descC', $descC, PDO::PARAM_STR);
            $actualizar -> bindValue(':idC', $idC, PDO::PARAM_INT);
            // Ejecutamos y verificamos que el permiso ha sido actualizado.
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

        // Capturamos el ID del permiso a eliminar.
        $id = $_POST['del_id'];

        // Pasamos los parámetros a la función que preparara la sentencia SQL de eliminación.
        $eliminar = $conexion -> prepare("DELETE FROM tbl_categorias WHERE c_id = :id");

        if ($eliminar -> execute(['id' => $id])) {
          $JSON = 1;
        } else {
          $JSON = 2;
        }

        // Finalmente imprimimos respuesta que interpretará AJAX posteriormente.
        echo json_encode($JSON);
    }

?>
