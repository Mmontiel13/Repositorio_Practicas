<?php
require_once __DIR__ . '/API/Productos.php'; 
use PRACTICA10\PRODUCTOS\Productos as Productos;
$conexionSearch = new Productos();
if ($conexionSearch->obtenerConexion()) {
    if( isset($_GET['search']) ) {
        $Coincidencia = $_GET['search'];
        $conexionSearch->search($Coincidencia);
        $conexionSearch->getResponse();
    } 
}else{
    echo json_encode('Sin conexion', JSON_PRETTY_PRINT); 
} 
?>
