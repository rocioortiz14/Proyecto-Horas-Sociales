<?php

    // Requerimos el archivo de control de sesiones.
    require_once '../configuracion/sesion.php';
    // Requerimos el archivo de conexion a la base de datos e iniciamos la sesión.
    require_once '../configuracion/conexion.php';
    $cargar = $conexion -> prepare("SELECT * FROM tbl_productos");
    $cargar -> execute();
    /*Almacenamos el resultado de fetchAll en una variable*/
    $arrayDatos = $cargar -> fetchAll();
    //print_r($arrayDatos);
    if (isset($_POST['action']) && $_POST['action'] == "view") {
?>
        <table class="table table-hover table-sm" id="tblProductos">
          <thead>
            <th class="bg-primary text-white text-center" style="width: 5%;">ID</th>
            <th class="bg-primary text-white text-center" style="width: 10%;">Imagen</th>
            <th class="bg-primary text-white text-center" style="width: 20%;">Producto</th>
            <th class="bg-primary text-white text-center" style="width: 10%;">Categoría</th>
            <th class="bg-primary text-white text-center" style="width: 25%;">Descripción</th>
            <th class="bg-primary text-white text-center" style="width: 10%;">Presentación</th>
            <th class="bg-primary text-white text-center" style="width: 10%;"></th>
          </thead>
          <tbody>
<?php
            /*Recorremos todos los resultados, ya no hace falta invocar más a fetchAll como si fuera fetch...*/
            foreach ($arrayDatos as $datos) {
                echo '<tr>';

                  echo '<td class="text-center">' . $datos[0] . '</td>';
                  echo '<td class="text-center"><img src="imagenes/uploads/' . $datos[9] . '" class="img img-fluid"></td>';
                  echo '<td class="text-center">' . $datos[1] . '</td>';
                  echo '<td class="text-center">' . $datos[3] . '</td>';
                  echo '<td class="text-center">' . $datos[2] . '</td>';
                  echo '<td class="text-center">' . $datos[8] . '</td>';
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
        $JSON = array();
        $imagen = '';
        $imagenFinal = '';
        $fecha = '';
        $insertar = '';

        if (!isset($_FILES['inputImagen'])) {
            // code...
            $imagen = 'IMG-616f72f7244094.94613696.jpg';
        }

        // if (isset($_POST['inputFecha'])) {
        //     // code...
        //     $fecha = '';
        // } else {
        //     // code...
        //     $fecha = $_POST['inputFecha'];
        // }

        $producto = mb_strtoupper($_POST['inputProducto'], 'UTF-8');
        $descripcion = mb_strtoupper($_POST['inputDesc'], 'UTF-8');
        $categoria = mb_strtoupper($_POST['inputCategoria'], 'UTF-8');
        $stockIni = $_POST['inputStockIni'];
        $codigo = mb_strtoupper($_POST['inputCodigo'], 'UTF-8');
        // $check1 = $_POST['inputCheck'];
        $presentacion = $_POST['inputPresentacion'];

        # getting image data and store them in var
        $img_name = $_FILES['inputImagen']['name'];
        $img_size = $_FILES['inputImagen']['size'];
        $tmp_name = $_FILES['inputImagen']['tmp_name'];
        $error    = $_FILES['inputImagen']['error'];

        # get image extension store it in var
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg", "jpeg", "png");

        $pass = 0;
        if ($imagen == 'IMG-616f72f7244094.94613696.jpg') {
            // code...
            $pass =1;
            $imagenFinal = 'IMG-616f72f7244094.94613696.jpg';

                $insertar = $conexion -> prepare("INSERT INTO tbl_productos
                                                              (p_producto, p_desc,
                                                               p_categoria, p_stock,
                                                               p_codigo, p_presentacion,
                                                               p_imagen)
                                                        VALUES (:producto, :descripcion,
                                                                :categoria, :stockIni,
                                                                :codigo, :presentacion,
                                                                :imagenFinal)");
        }
        else {
            // code...
            if (in_array($img_ex_lc, $allowed_exs)) {
                $pass = 1;
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                # crating upload path on root directory
                $img_upload_path = "../imagenes/uploads/".$new_img_name;
                # move uploaded image to 'uploads' folder
                move_uploaded_file($tmp_name, $img_upload_path);
                $imagenFinal = $new_img_name;

                    $insertar = $conexion -> prepare("INSERT INTO tbl_productos
                                                                  (p_producto, p_desc,
                                                                   p_categoria, p_stock,
                                                                   p_codigo, p_presentacion,
                                                                   p_imagen)
                                                            VALUES (:producto, :descripcion,
                                                                    :categoria, :stockIni,
                                                                    :codigo, :presentacion,
                                                                    :imagenFinal)");
            }
        }
        if($pass){
        // Pasamos valores, con sentencias preparadas, para luego ejecutar.
          $insertar -> bindParam(':producto', $producto, PDO::PARAM_STR);
          $insertar -> bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
          $insertar -> bindParam(':categoria', $categoria, PDO::PARAM_INT);
          $insertar -> bindParam(':stockIni', $stockIni, PDO::PARAM_STR);
          $insertar -> bindParam(':codigo', $codigo, PDO::PARAM_STR);
          $insertar -> bindParam(':presentacion', $presentacion, PDO::PARAM_INT);
          $insertar -> bindParam(':imagenFinal', $imagenFinal, PDO::PARAM_STR);
          if ($insertar -> execute()) {
              # Datos de la empresa actualizados con exito.
              #JSON = array('json' => 1, 'src'=> $new_img_name);
              $JSON["code"] = 1;
          } else {
            # No se pudo actualizar los datos de la empresa
            $JSON["code"] = 2;
          }
        } else {
          $JSON["code"] = 0;
        }
        echo json_encode($JSON);
    }

    // Se encarga de capturar el ID del permiso y devolver los datos del mismo.
    if (isset($_POST['edit_id'])) {
        // Capturamos el ID del permiso.
        $id = $_POST['edit_id'];

        $buscar = $conexion -> prepare("SELECT * FROM tbl_productos WHERE c_id = :id");
        $buscar -> execute(['id' => $id]);
        $categoriaData = $buscar -> fetch();

        echo json_encode($categoriaData);
    }

    if (isset($_POST['action']) && $_POST['action'] == "update") {

        // Variable que almacena respuesta para el AJAX.
        $JSON = 0;

        // Capturamos los datos del formulario y los almacenamos en las variables.
        $idC = $_POST['id'];
        $categoriaC =  mb_strtoupper($_POST['inputCategoria1'], 'UTF-8');
        $descC = mb_strtoupper($_POST['inputDesc1'], 'UTF-8');

        if ($categoriaC == '' || $categoriaC == null || $descC == '' || $descC == null) {
            $JSON = 0; // Para el caso de datos vacios o nulos.
        } else {
            // Pasamos los parámetros a la función actualizará el permiso.
            $actualizar = $conexion -> prepare('UPDATE tbl_productos SET c_nombre = :categoriaC, c_desc = :descC, c_actualizar = NOW() WHERE c_id = :idC');
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
        $eliminar = $conexion -> prepare("DELETE FROM tbl_productos WHERE c_id = :id");

        if ($eliminar -> execute(['id' => $id])) {
          $JSON = 1;
        } else {
          $JSON = 2;
        }

        // Finalmente imprimimos respuesta que interpretará AJAX posteriormente.
        echo json_encode($JSON);
    }

?>
