<?php

    // Requerimos el archivo de control de sesiones.
    require_once '../configuracion/sesion.php';
    // Requerimos el archivo de conexion a la base de datos e iniciamos la sesión.
    require_once '../configuracion/conexion.php';

    if (isset($_POST['action']) && $_POST['action'] == "update") {

        if (isset($_FILES['logo'])) {
            // Variable que almacena respuesta para el AJAX.
            $JSON = 0;

            // Capturamos los datos del formulario y los almacenamos en las variables.
            $empresa = $_POST['empresa'];
            $eslogan = $_POST['eslogan'];
            $direccion = $_POST['direccion'];
            $correo = $_POST['correo'];
            $telefono1 = $_POST['telefono1'];
            $telefono2 = $_POST['telefono2'];
            $movil1 = $_POST['movil1'];
            $movil2 = $_POST['movil2'];
            $razon = $_POST['razon'];
            $nrc = $_POST['nrc'];
            $nit = $_POST['nit'];
            $id = 1;
          	# getting image data and store them in var
          	$img_name = $_FILES['logo']['name'];
          	$img_size = $_FILES['logo']['size'];
          	$tmp_name = $_FILES['logo']['tmp_name'];
          	$error    = $_FILES['logo']['error'];

          	# if there is not error occurred while uploading
          	if ($error === 0) {
            		if ($img_size > 1000000) {
              			# Imagen demasiado pesada.
              			$JSON = 0;
            		    echo json_encode($JSON);
            		} else {
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
              				# inserting imge name into database
                      $sql = "UPDATE tbl_empresa SET
                              e_nombre = :empresa,
                              e_eslogan = :eslogan,
                              e_telefonofijo1 = :telefono1,
                              e_telefonofijo2 = :telefono2,
                              e_movil1 = :movil1,
                              e_movil2 = :movil2,
                              e_direccion = :direccion,
                              e_correo = :correo,
                              e_razonsocial = :razon,
                              e_nrc = :nrc,
                              e_nit = :nit,
                              e_logo = :new_img_name
                              WHERE identificador = :id";
                      // Pasamos los parámetros a la función actualizará el permiso.
                      $actualizar = $conexion -> prepare($sql);
                      $actualizar -> bindValue(':empresa', $empresa, PDO::PARAM_STR);
                      $actualizar -> bindValue(':eslogan', $eslogan, PDO::PARAM_STR);
                      $actualizar -> bindValue(':telefono1', $telefono1, PDO::PARAM_STR);
                      $actualizar -> bindValue(':telefono2', $telefono2, PDO::PARAM_STR);
                      $actualizar -> bindValue(':movil1', $movil1, PDO::PARAM_STR);
                      $actualizar -> bindValue(':movil2', $movil2, PDO::PARAM_STR);
                      $actualizar -> bindValue(':direccion', $direccion, PDO::PARAM_STR);
                      $actualizar -> bindValue(':correo', $correo, PDO::PARAM_STR);
                      $actualizar -> bindValue(':razon', $razon, PDO::PARAM_STR);
                      $actualizar -> bindValue(':nrc', $nrc, PDO::PARAM_STR);
                      $actualizar -> bindValue(':nit', $nit, PDO::PARAM_STR);
                      $actualizar -> bindValue(':new_img_name', $new_img_name, PDO::PARAM_STR);
                      $actualizar -> bindValue(':id', $id, PDO::PARAM_INT);
                      $actualizar -> execute();
                      # Datos de la empresa actualizados con exito.
              				$JSON = array('json' => 1, 'src'=> $new_img_name);

                      echo json_encode($JSON);
              			} else {
              				# No se pudo actualizar los datos de la empresa
              				$JSON = 2;

              		    echo json_encode($JSON);
              			}
            		}
          	} else {
            		# Error al cargar la imagen.
            		$JSON = 3;

            	  echo json_encode($JSON);
          	}
        }
    }
?>
