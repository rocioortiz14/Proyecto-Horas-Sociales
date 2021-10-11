<?php

    include 'conexion.php';

    $query = "SELECT * FROM tbl_empresa WHERE identificador = 1";
    $empresa = $conexion -> prepare($query);
    $empresa -> execute();
    $resultado = $empresa -> fetch();

?>
