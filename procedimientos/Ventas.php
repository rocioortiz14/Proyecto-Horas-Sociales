<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Requerimos el archivo de control de sesiones.
require_once '../configuracion/sesion.php';
// Requerimos el archivo de conexion a la base de datos e iniciamos la sesión.
require_once '../configuracion/conexion.php';

$cargar = $conexion -> prepare("SELECT
                                v.v_id,
                                v.v_fecha,
                                cl.cliente_Nombre,
                                v.v_comprobante,
                                v.v_serie,
                                v.v_numero,
                                v.v_ttl,
                                v.v_estado
                                FROM tbl_venta AS v
                                LEFT JOIN tbl_clientes AS cl ON v.v_cliente = cl.cliente_id
                                ORDER BY v.v_id ASC");

$cargar -> execute();
/*Almacenamos el resultado de fetchAll en una variable*/
$arrayDatos = $cargar -> fetchAll();
//print_r($arrayDatos);

if (isset($_POST['action']) && $_POST['action'] == "view") {
    echo '
    <table class="table table-hover table-sm" id="tblVentas">
      <thead>
        <th class="bg-primary text-white text-center" style="width: 5%;">ID</th>
        <th class="bg-primary text-white text-center" style="width: 10%;">Fecha</th>
        <th class="bg-primary text-white text-center" style="width: 25%;">Proveedor</th>
        <th class="bg-primary text-white text-center" style="width: 10%;">Comprobante</th>
        <th class="bg-primary text-white text-center" style="width: 10%;">Estado</th>
        <th class="bg-primary text-white text-center" style="width: 10%;">Serie</th>
        <th class="bg-primary text-white text-center" style="width: 10%;">N° venta</th>
        <th class="bg-primary text-white text-center" style="width: 10%;">Total venta</th>
        <th class="bg-primary text-white text-center" style="width: 10%;"></th>
      </thead>
      <tbody>';
          /*Recorremos todos los resultados, ya no hace falta invocar más a fetchAll como si fuera fetch...*/
          foreach ($arrayDatos as $datos) {
              echo '<tr>';

                echo '<td class="text-center">' . $datos[0] . '</td>';
                echo '<td class="text-center">' . $datos[1] . '</td>';
                echo '<td class="text-justify">' . $datos[2] . '</td>';
                echo '<td class="text-center">' . $datos[3] . '</td>';
                echo '<td class="text-center">' . $datos[7] . '</td>';
                echo '<td class="text-center">' . $datos[4] . '</td>';
                echo '<td class="text-center">' . $datos[5] . '</td>';
                echo '<td class="text-center">$' . $datos[6] . '</td>';
                echo '<td class="">
                          <center>
                              <div class="btn-group">
                                  <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Acciones</button>
                                  <ul class="dropdown-menu">
                                      <a href="detalleVentas.php?identificador='.$datos[0].'" class="dropdown-item text-dark btnDetail" id="'.$datos[0].'" title="Detalle venta"><i class="fa fa-edit text-success"></i> Detalle</a>
                                      ';
                                      if($datos[7] == "FINALIZADA"){
                                        echo '<a class="dropdown-item text-dark btnDelete" id="'.$datos[0].'" title="Anular venta"><i class="fa fa-trash text-danger"></i> Anular</a>';
                                      }
                                  echo '</ul>
                              </div>
                          </center>
                      </td>';
              echo ' </tr>';
          }
      echo '
        </tbody>
      </table>';
}

if (isset($_POST['action']) && $_POST['action'] == "insert") {
  $JSON = array();
  $insertar = 0;

  $cliente = $_POST['cliente'];
  $comprobante = $_POST['comprobante'];
  $fechaV = $_POST['fechaV'];
  $qty = $_POST['tqty'];
  $stot = $_POST['tpc'];
  $iva = $_POST['tiva'];
  $ttl = $_POST['ttl'];
  $serie = mb_strtoupper($_POST['serie'], 'UTF-8');
  $numero = mb_strtoupper($_POST['numero'], 'UTF-8');
  $productos = json_decode($_POST['productos'], true);

  $insertar = $conexion -> prepare("INSERT INTO tbl_venta(v_fecha, v_cliente, v_comprobante, v_serie,
                                                     v_numero, v_qty, v_stot, v_iva, v_ttl)
                                                     VALUES (:fecha, :cliente, :comprobante, :serie,
                                                             :numero, :qty, :stot, :iva, :ttl)");
  // Pasamos valores, con sentencias preparadas, para luego ejecutar.
  $insertar->bindParam(':fecha', $fechaV,PDO::PARAM_STR);
  $insertar->bindParam(':cliente', $cliente, PDO::PARAM_INT);
  $insertar->bindParam(':comprobante', $comprobante, PDO::PARAM_STR);
  $insertar->bindParam(':serie', $serie, PDO::PARAM_STR);
  $insertar->bindParam(':numero', $numero, PDO::PARAM_STR);
  $insertar->bindParam(':qty', $qty, PDO::PARAM_STR);
  $insertar->bindParam(':stot', $stot, PDO::PARAM_STR);
  $insertar->bindParam(':iva', $iva, PDO::PARAM_STR);
  $insertar->bindParam(':ttl', $ttl, PDO::PARAM_STR);
  $conexion->beginTransaction();
  if ($insertar->execute()) {
    $venta = $conexion->lastInsertId();
    $err = 0;
    foreach ($productos as $producto) {
      $ins_dt = $conexion->prepare("INSERT INTO tbl_venta_detalle(vd_venta,vd_producto,vd_qty,vd_pv,vd_stot)
                                                         VALUES (:venta, :producto, :qty,
                                                                 :pv, :stot)");

      $ins_dt->bindParam(':venta', $venta,PDO::PARAM_INT);
      $ins_dt->bindParam(':producto', $producto["id"], PDO::PARAM_INT);
      $ins_dt->bindParam(':qty', $producto["cantidad"], PDO::PARAM_STR);
      // $ins_dt->bindParam(':pc', $producto["pc"], PDO::PARAM_STR);
      $ins_dt->bindParam(':pv', $producto["pv"], PDO::PARAM_STR);
      $ins_dt->bindParam(':stot', $producto["stot"], PDO::PARAM_STR);

      $dt = $ins_dt->execute();
      if(!$dt){
        $err = 1;
      } else{
        $consulta_stock = $conexion->prepare("SELECT p_stock FROM tbl_productos WHERE p_id='".$producto['id']."'");
        $consulta_stock->execute();
        $datos_stock = $consulta_stock->fetch();
        $stock_anterior = $datos_stock[0];
        $stock_nuevo = $stock_anterior - $producto["cantidad"];
        $update_stock = $conexion -> prepare('UPDATE tbl_productos SET p_stock = :stock, p_pv = :pv WHERE p_id = :id');
        $update_stock->bindValue(':stock', $stock_nuevo, PDO::PARAM_STR);
        // $update_stock->bindValue(':pc', $producto["pc"], PDO::PARAM_STR);
        $update_stock->bindValue(':pv', $producto["pv"], PDO::PARAM_STR);
        $update_stock->bindValue(':id', $producto['id'], PDO::PARAM_INT);
        $update_stk = $update_stock->execute();
        if(!$update_stk){
            $err = 1;
        }
      }
    }
    if(!$err){
      $conexion->commit();
      $JSON["code"] = 1;
    } else{
      $conexion->rollback();
      $JSON["code"] = 3;
    }
  } else {
    $conexion->rollback();
    $JSON["code"] = 0;
  }
  echo json_encode($JSON);
}

if (isset($_POST['action']) && $_POST['action'] == "anular") {
  $JSON = array();
  $insertar = 0;

  $id = $_POST['id'];

  $conexion->beginTransaction();
  $update = $conexion -> prepare("UPDATE tbl_venta SET v_estado = 'Anulada' WHERE v_id=:id");
  // Pasamos valores, con sentencias preparadas, para luego ejecutar.
  $update->bindParam(':id', $id, PDO::PARAM_INT);
  if ($update->execute()) {
    $err = 0;
    $cargar = $conexion->prepare("SELECT dt.vd_producto, dt.vd_qty, p.p_stock
                                  FROM tbl_venta_detalle AS dt
                                  JOIN tbl_productos AS p ON p.p_id = dt.vd_producto WHERE dt.vd_venta=:id");

    $cargar -> execute(["id" => $id]);
    /*Almacenamos el resultado de fetchAll en una variable*/
    $arrayDatos = $cargar -> fetchAll();

    foreach ($arrayDatos as $producto) {
      $idp = $producto[0];
      $qty = $producto[2];
      $qtydesc = $producto[1];
      $qtyres = $qty + $qtydesc;
      $upd_dt = $conexion->prepare("UPDATE tbl_productos SET p_stock=:qty WHERE p_id = :idp");

      $upd_dt->bindParam(':qty', $qtyres, PDO::PARAM_STR);
      $upd_dt->bindParam(':idp', $idp, PDO::PARAM_INT);

      $dt = $upd_dt->execute();
      if(!$dt){
        $err = 1;
      }
    }
    if(!$err){
      $conexion->commit();
      $JSON["code"] = 1;
    } else{
      $conexion->rollback();
      $JSON["code"] = 3;
    }
  } else {
    $conexion->rollback();
    $JSON["code"] = 0;
  }
  echo json_encode($JSON);
}
if (isset($_POST['action']) && $_POST['action'] == "consultar") {
  $id = $_POST['id'];
    $cargar = $conexion->prepare("SELECT p_stock, p_pv
                                  FROM tbl_productos WHERE p_id=:id");

    $cargar -> execute(["id" => $id]);
    $arrayDatos = $cargar -> fetch();
    $JSON["stock"] = $arrayDatos[0];
    $JSON["pv"] = $arrayDatos[1];
    echo json_encode($JSON);
}
