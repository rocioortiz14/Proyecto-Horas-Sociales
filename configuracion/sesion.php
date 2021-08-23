<?php

// Creamos la sesion
session_start();

if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true) {
    # code...
    header('location: index.php');
    exit;
}

?>
