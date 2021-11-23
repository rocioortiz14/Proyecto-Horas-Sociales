<?php

    // Requerimos el archivo de control de sesiones.
    require_once '../configuracion/sesion.php';
    // Requerimos el archivo de conexion a la base de datos e iniciamos la sesión.
    require_once '../configuracion/conexion.php';
    $cargar = $conexion -> prepare("SELECT
                                    p.p_id,
                                    p.p_producto,
                                    c.c_nombre,
                                    p.p_desc,
                                    p.p_presentacion,
                                    p.p_imagen
                                    FROM tbl_productos AS p
                                    LEFT JOIN tbl_categorias AS c ON p.p_categoria = c.c_id
                                    ORDER BY p.p_id DESC");
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
                  echo '<td class="text-center"><img src="imagenes/uploads/' . $datos[5] . '" class="img img-fluid" style="width: 40%; height: 40%;"></td>';
                  echo '<td class="text-center">' . $datos[1] . '</td>';
                  echo '<td class="text-center">' . $datos[2] . '</td>';
                  echo '<td class="text-center">' . $datos[3] . '</td>';
                  $identificador1 = $datos[4];
                  $resultado1 = '';
                  $estado1 = array('','UNIDAD','DOCENA','CAJA','ONZA','LIBRA','KILOGRAMO','QUINTAL','SACO','LITRO','GALON');
                  $array1 = $estado1;
                  for ($k1=1; $k1<sizeof($array1); $k1++)
                  {
                    if ($identificador1 == $k1) {
                      $resultado1 = $array1[$k1];
                    }
                  }
                  echo '<td class="text-center">' . $resultado1 . '</td>';
                  echo '<td class="">
                            <center>
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Acciones</button>
                                    <ul class="dropdown-menu">
                                        <a href="editarProducto.php?identificador='.$datos[0].'" class="dropdown-item text-dark btnEdit" id="'.$datos[0].'" title="Editar producto"><i class="fa fa-edit text-success"></i> Editar</a>
                                        <a href="#" class="dropdown-item text-dark btnDelete" id="'.$datos[0].'" title="Eliminar producto"><i class="fa fa-trash text-danger"></i> Eliminar</a>
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

    if (isset($_POST['action']) && $_POST['action'] == "update") {

        // Variable que almacena respuesta para el AJAX.
        $JSON = array();
        $imagenV = '';
        $pass = '';
        $imagenFinal = '';
        $fecha = '';
        $insertar = '';

        $producto = mb_strtoupper($_POST['inputProducto1'], 'UTF-8');
        $descripcion = mb_strtoupper($_POST['inputDesc1'], 'UTF-8');
        $categoria = mb_strtoupper($_POST['inputCategoria1'], 'UTF-8');
        $stockIni = $_POST['inputStockIni1'];
        $codigo = mb_strtoupper($_POST['inputCodigo1'], 'UTF-8');
        $id = $_POST['id'];
        $presentacion = $_POST['inputPresentacion1'];

        # getting image data and store them in var
        $img_name = $_FILES['inputImagen1']['name'];
        $img_size = $_FILES['inputImagen1']['size'];
        $tmp_name = $_FILES['inputImagen1']['tmp_name'];
        $error    = $_FILES['inputImagen1']['error'];

        # get image extension store it in var
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                # crating upload path on root directory
                $img_upload_path = "../imagenes/uploads/".$new_img_name;
                # move uploaded image to 'uploads' folder
                move_uploaded_file($tmp_name, $img_upload_path);
                $imagenFinal = $new_img_name;

                $actualizar = $conexion -> prepare("UPDATE tbl_productos
                                                    SET p_producto = :producto,
                                                        p_desc = :descripcion,
                                                        p_categoria = :categoria,
                                                        p_stock = :stockIni,
                                                        p_codigo = :codigo,
                                                        p_presentacion = :presentacion,
                                                        p_imagen = :imagenFinal
                                                        WHERE p_id = :id");

                $actualizar -> bindValue(':producto', $producto, PDO::PARAM_STR);
                $actualizar -> bindValue(':descripcion', $descripcion, PDO::PARAM_STR);
                $actualizar -> bindValue(':categoria', $categoria, PDO::PARAM_INT);
                $actualizar -> bindValue(':stockIni', $stockIni, PDO::PARAM_STR);
                $actualizar -> bindValue(':codigo', $codigo, PDO::PARAM_STR);
                $actualizar -> bindValue(':presentacion', $presentacion, PDO::PARAM_INT);
                $actualizar -> bindValue(':imagenFinal', $imagenFinal, PDO::PARAM_STR);
                $actualizar -> bindValue(':id', $id, PDO::PARAM_INT);
                if ($actualizar -> execute()) {
                    $JSON["code"] = 1;
                } else {
                    $JSON["code"] = 2;
                }
                #echo "paso 2";
            } else {
            $JSON["code"] = 0;
            }
        echo json_encode($JSON);
    }


    if (isset($_POST['del_id'])) {

        // Variable que almacena respuesta para el AJAX.
        $JSON = 0;

        // Capturamos el ID del permiso a eliminar.
        $id = $_POST['del_id'];

        // Pasamos los parámetros a la función que preparara la sentencia SQL de eliminación.
        $eliminar = $conexion -> prepare("DELETE FROM tbl_productos WHERE p_id = :id");

        if ($eliminar -> execute(['id' => $id])) {
          $JSON = 1;
        } else {
          $JSON = 2;
        }

        // Finalmente imprimimos respuesta que interpretará AJAX posteriormente.
        echo json_encode($JSON);
    }

?>
