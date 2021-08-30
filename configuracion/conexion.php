<?php
// Iniciamos conexion
$parametroC = 'mysql:dbname=db_solecon;host=localhost;port=3307';
$accesoU = "root";
$accesoC = "";
$errorM = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NUM];

try {
    //code...
    $conexion = new PDO($parametroC,$accesoU,$accesoC,$errorM);
    //echo "Conexion Exitosa";
} catch (PDOException $error) {
    echo ($error -> getMessage());
        //throw $th;
}


?>
