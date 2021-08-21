<?php

    require_once '../configuracion/conexion.php';
    //echo $conexion;
    session_start();

    // Para ejecutar el proceso de logueo, se verifica si la acción es "login" y el metodo "POST".
    if(isset($_POST['action']) && $_POST['action'] == "acceso"){

        // Declaramos vacia la variable, que enviara el tipo de resultado en formato JSON a la función AJAX de logueo del sistema.
        $JSON = 0;

        if (empty($_POST['accesoU']) || empty($_POST['accesoC']) || $_POST['accesoU'] == "" || $_POST['accesoC'] == "") {
            // Sí alguno de los datos capturados del formulario es vacío, reenviará la alertar de rellenar todos los campos.
            $JSON = 0;
        } else {
            // Capturamos valores del formulario de ingreso al sistema.
            $usuarioAcceso = trim($_POST['accesoU']);
            $contraAcceso = trim($_POST['accesoC']);
            //$passLogin1 = password_hash($_POST['accesoC'], PASSWORD_DEFAULT);

            // Preparamos quey, que retornara hash de contraseña, para verificar acceso al sistema.
            $sqlHash = $conexion -> prepare("SELECT u_contra FROM tbl_usuarios WHERE u_usuario = :usuarioAcceso");
            $sqlHash -> execute(array(':usuarioAcceso' => $usuarioAcceso));
            $resultadoHash = $sqlHash -> fetch();

            // Verificamos la contraseña.
            if ($resultadoHash && password_verify($contraAcceso, $resultadoHash[0])) {
                // Preparamos la sentencia 	SQL, si la query esta correcta, se procede a almacenar en una variable.
                $sqlAcceso = $conexion -> prepare("SELECT * FROM tbl_usuarios WHERE u_usuario = :usuarioAcceso");
                // Ejecutamos la sentencia SQL, previamente verificada.
                $sqlAcceso -> execute(array(':usuarioAcceso' => $usuarioAcceso));
                // Almacenamos en una variable, el objeto obtenido, con los datos del usuario.
                $resultadoConsulta = $sqlAcceso -> fetchAll();
                // Verificamos que si, nos devuelve un usuario almacenado en la DB de ORACLE, procedemos a crearle su sessión.
                if($resultadoConsulta) {
                    // Datos especiales, para manejos de la sesión.
                    $_SESSION["logueado"] = true;
                    $_SESSION["time_start"] = time();
                    // Obtenemos los demás datos de la sesión del usuario.
                    foreach ($resultadoConsulta as $datos) {
                        $_SESSION["id"] = $datos[0];
                        $_SESSION["nombre"] = $datos[1];
                        $_SESSION["usuario"] = $datos[2];
                        $_SESSION["permiso"] = $datos[4];
                        $_SESSION["estado"] = $datos[5];
                        $_SESSION["empleado"] = $datos[6];
                    }
                    // Insertamos el proceso de "Exito" en la variable que interpreta AJAX.
                    $JSON = 1;
                }
                // Finalmente si el proceso, es diferente, la alerta respondera que no se ha encontrado el usuario.
                else{
                    $JSON = 2;
                    unset($resultadoConsulta);
                }
            } else {
              // Para el caso que encuentre el usuario, pero la contraseña sea incorrecta.
              $JSON = 3;
              unset($resultadoConsulta);
            }
        }
        // Imprimos el valor a pasar, que interpretará AJAX.
        echo json_encode($JSON);
    }
    

?>