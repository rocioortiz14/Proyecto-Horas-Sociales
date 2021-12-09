<?php

    // Requerimos el archivo de control de sesiones.
    require_once '../configuracion/sesion.php';
    // Requerimos el archivo de conexion a la base de datos e iniciamos la sesión.
    require_once '../configuracion/conexion.php';
    $cargar = $conexion -> prepare("SELECT
                                    p.p_id,
                                    p.p_codigo,
                                    p.p_producto,
                                    p.p_desc,
                                    CONCAT(c.c_nombre,' - ',c.c_desc),
                                    p.p_stock
                                    FROM tbl_productos AS p
                                    LEFT JOIN tbl_categorias AS c ON p.p_categoria
                                    ORDER BY p.p_id ASC");
    $cargar -> execute();
    /*Almacenamos el resultado de fetchAll en una variable*/
    $arrayDatos = $cargar -> fetchAll();
    //print_r($arrayDatos);
    if (isset($_POST['action']) && $_POST['action'] == "view") {
?>
        <table class="table table-hover table-sm" id="tblInventario">
          <thead>
            <th class="bg-primary text-white text-center" style="width: 5%;">ID</th>
            <th class="bg-primary text-white text-center" style="width: 10%;">Código</th>
            <th class="bg-primary text-white text-center" style="width: 15%;">Producto</th>
            <th class="bg-primary text-white text-center" style="width: 25%;">Descripción</th>
            <th class="bg-primary text-white text-center" style="width: 25%;">Categoría</th>
            <th class="bg-primary text-white text-center" style="width: 10%;">Stock</th>
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
                echo ' </tr>';
            }
?>
          </tbody>
        </table>
<?php
    }
?>
