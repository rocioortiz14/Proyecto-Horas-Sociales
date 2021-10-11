<?php
    //Función encargada de insertar en la tabla de auditoria de conexiones.
    function actualizarIP($id) {
        // Incluimos el archivo de conexión a la DB.
        require_once "configuracion/conexion.php";

        // Capturamos los datos del formulario y los almacenamos en las variables.
        $userID = $id;

        // Pasamos los parámetros a la función insertar usuarios.
        // Alamacenamos sentencia SQL (Procedimiento almacenado) en variable.
        $sql = "UPDATE tbl_ip SET i_actualizar = NOW() WHERE i_id = :userID";
        // Preparamos Procedimiento almacenado, para traer todos los datos de la tabla usuarios.
        $actualizar = $conexion -> prepare($sql);
        // Ejecutamos sentencia SQL.
        $actualizar -> execute(['userID' => $userID]);

        return true;
    }

    session_start();
    $id = $_SESSION["ultima"];
    // Ejecutamos función de actualización de conexiones.
    actualizarIP($id);
    // Unset all of the session variables.
    $_SESSION = array();
    // Destroy the session.
    session_destroy();
    // Redirect to login page
    header("location: index.php");

    header("Location: index.php ");
    exit;

?>
