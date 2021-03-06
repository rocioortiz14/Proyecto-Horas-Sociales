<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Requerimos el archivo de control de sesiones.
require_once '../configuracion/sesion.php';
// Requerimos el archivo de conexion a la base de datos e iniciamos la sesión.
require_once '../configuracion/conexion.php';

$cargar = $conexion -> prepare("SELECT
                                c.c_id,
                                c.c_fecha,
                                p.prv_nombre,
                                c.c_comprobante,
                                c.c_serie,
                                c.c_numero,
                                c.c_ttl,
                                c.c_estado
                                FROM tbl_compra AS c
                                LEFT JOIN tbl_proveedores AS p ON c.c_proveedor = p.prv_id
                                ORDER BY c.c_id ASC");

$cargar -> execute();
/*Almacenamos el resultado de fetchAll en una variable*/
$arrayDatos = $cargar -> fetchAll();
//print_r($arrayDatos);

if (isset($_POST['action']) && $_POST['action'] == "view") {
    echo '
    <table class="table table-hover table-sm" id="tblCompras">
      <thead>
        <th class="bg-primary text-white text-center" style="width: 5%;">ID</th>
        <th class="bg-primary text-white text-center" style="width: 10%;">Fecha</th>
        <th class="bg-primary text-white text-center" style="width: 25%;">Proveedor</th>
        <th class="bg-primary text-white text-center" style="width: 10%;">Comprobante</th>
        <th class="bg-primary text-white text-center" style="width: 10%;">Estado</th>
        <th class="bg-primary text-white text-center" style="width: 10%;">Serie</th>
        <th class="bg-primary text-white text-center" style="width: 10%;">N° compra</th>
        <th class="bg-primary text-white text-center" style="width: 10%;">Total compra</th>
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
                                      <a href="detalleCompras.php?identificador='.$datos[0].'" class="dropdown-item text-dark btnDetail" id="'.$datos[0].'" title="Detalle compra"><i class="fa fa-edit text-success"></i> Detalle</a>
                                      ';
                                      if($datos[7] == "FINALIZADA"){
                                        echo '<a class="dropdown-item text-dark btnDelete" id="'.$datos[0].'" title="Anular compra"><i class="fa fa-trash text-danger"></i> Anular</a>';
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

  $proveedor = $_POST['proveedor'];
  $comprobante = $_POST['comprobante'];
  $fechaC = $_POST['fechaC'];
  $qty = $_POST['tqty'];
  $stot = $_POST['tpc'];
  $iva = $_POST['tiva'];
  $ttl = $_POST['ttl'];
  $serie = mb_strtoupper($_POST['serie'], 'UTF-8');
  $numero = mb_strtoupper($_POST['numero'], 'UTF-8');
  $productos = json_decode($_POST['productos'], true);

  $insertar = $conexion -> prepare("INSERT INTO tbl_compra(c_fecha, c_proveedor, c_comprobante, c_serie,
                                                     c_numero, c_qty, c_stot, c_iva, c_ttl)
                                                     VALUES (:fecha, :proveedor, :comprobante, :serie,
                                                             :numero, :qty, :stot, :iva, :ttl)");
  // Pasamos valores, con sentencias preparadas, para luego ejecutar.
  $insertar->bindParam(':fecha', $fechaC,PDO::PARAM_STR);
  $insertar->bindParam(':proveedor', $proveedor, PDO::PARAM_INT);
  $insertar->bindParam(':comprobante', $comprobante, PDO::PARAM_STR);
  $insertar->bindParam(':serie', $serie, PDO::PARAM_STR);
  $insertar->bindParam(':numero', $numero, PDO::PARAM_STR);
  $insertar->bindParam(':qty', $qty, PDO::PARAM_STR);
  $insertar->bindParam(':stot', $stot, PDO::PARAM_STR);
  $insertar->bindParam(':iva', $iva, PDO::PARAM_STR);
  $insertar->bindParam(':ttl', $ttl, PDO::PARAM_STR);
  $conexion->beginTransaction();
  if ($insertar->execute()) {
    $compra = $conexion->lastInsertId();
    $err = 0;
    foreach ($productos as $producto) {
      $ins_dt = $conexion->prepare("INSERT INTO tbl_compra_detalle(cd_compra,cd_producto,cd_qty,cd_pc,cd_pv,cd_stot)
                                                         VALUES (:compra, :producto, :qty, :pc,
                                                                 :pv, :stot)");

      $ins_dt->bindParam(':compra', $compra,PDO::PARAM_INT);
      $ins_dt->bindParam(':producto', $producto["id"], PDO::PARAM_INT);
      $ins_dt->bindParam(':qty', $producto["cantidad"], PDO::PARAM_STR);
      $ins_dt->bindParam(':pc', $producto["pc"], PDO::PARAM_STR);
      $ins_dt->bindParam(':pv', $producto["pv"], PDO::PARAM_STR);
      $ins_dt->bindParam(':stot', $producto["stot"], PDO::PARAM_STR);

      $dt = $ins_dt->execute();
      if($producto["vencimiento"] !=""){
        $ins_dtl = $conexion->prepare("INSERT INTO tbl_lote(l_compra,l_producto,l_unidades,l_disponibles,l_vencimiento)
                                                           VALUES (:compra, :producto, :qty, :qty,
                                                                   :vencimiento)");
        $ins_dtl->bindParam(':compra', $compra,PDO::PARAM_INT);
        $ins_dtl->bindParam(':producto', $producto["id"], PDO::PARAM_INT);
        $ins_dtl->bindParam(':qty', $producto["cantidad"], PDO::PARAM_STR);
        $ins_dtl->bindParam(':vencimiento', $producto["vencimiento"], PDO::PARAM_STR);
        $dtl = $ins_dtl->execute();
      }
      $dt = $ins_dt->execute();
      if(!$dt){
        $err = 1;
      } else{
        $consulta_stock = $conexion->prepare("SELECT p_stock FROM tbl_productos WHERE p_id='".$producto['id']."'");
        $consulta_stock->execute();
        $datos_stock = $consulta_stock->fetch();
        $stock_anterior = $datos_stock[0];
        $stock_nuevo = $stock_anterior + $producto["cantidad"];
        $update_stock = $conexion -> prepare('UPDATE tbl_productos SET p_stock = :stock, p_pc = :pc, p_pv = :pv WHERE p_id = :id');
        $update_stock->bindValue(':stock', $stock_nuevo, PDO::PARAM_STR);
        $update_stock->bindValue(':pc', $producto["pc"], PDO::PARAM_STR);
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
  $update = $conexion -> prepare("UPDATE tbl_compra SET c_estado = 'Anulada' WHERE c_id=:id");
  // Pasamos valores, con sentencias preparadas, para luego ejecutar.
  $update->bindParam(':id', $id, PDO::PARAM_INT);
  $updatel = $conexion -> prepare("UPDATE tbl_lote SET l_estado = 'Anulado', l_unidades='0', l_disponibles='0' WHERE l_compra=:id");
  // Pasamos valores, con sentencias preparadas, para luego ejecutar.
  $updatel->bindParam(':id', $id, PDO::PARAM_INT);
  $updatel->execute();
  if ($update->execute()) {
    $err = 0;
    $cargar = $conexion->prepare("SELECT dt.cd_producto, dt.cd_qty, p.p_stock
                                  FROM tbl_compra_detalle AS dt
                                  JOIN tbl_productos AS p ON p.p_id = dt.cd_producto WHERE dt.cd_compra=:id");

    $cargar -> execute(["id" => $id]);
    /*Almacenamos el resultado de fetchAll en una variable*/
    $arrayDatos = $cargar -> fetchAll();

    foreach ($arrayDatos as $producto) {
      $idp = $producto[0];
      $qty = $producto[2];
      $qtydesc = $producto[1];
      $qtyres = $qty - $qtydesc;
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
