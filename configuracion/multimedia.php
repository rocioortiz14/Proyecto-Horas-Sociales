<?php

    // Incluimos el archivo de conexion.
    include 'conexion.php';

    // SQL para consultar y mostrar los datos de la empresa en el ADMIN.
    $query = "SELECT * FROM tbl_empresa WHERE identificador = 1";
    $empresa = $conexion -> prepare($query);
    $empresa -> execute();
    $resultado = $empresa -> fetch();

    // SQL para consultar la informacion del usuario en sesion.
    $id = $_SESSION["id"];
    $usuarioSesion = $conexion -> prepare("SELECT
                                    u.u_id, u.u_nombre, e.e_nombre, u.u_usuario, e.e_codigo,
                                    e.e_correo, e.e_telefono, e.e_direccion, e.e_cargo
                                    FROM tbl_usuarios AS u
                                    LEFT JOIN tbl_empleados AS e ON u.u_empleado = e.e_id
                                    WHERE u.u_id = :id");
    $usuarioSesion -> execute(['id' => $id]);
    $data = $usuarioSesion -> fetch();
?>
