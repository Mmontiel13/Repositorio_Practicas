<?php
require_once __DIR__ . '/API/Productos.php'; 
use PRACTICA10\PRODUCTOS\Productos as Productos;
$conexionList = new Productos();
if ($conexionList->obtenerConexion()) {
    $conexionList->list();
    $conexionList->getResponse();
    
}else{
    echo json_encode('Sin conexion', JSON_PRETTY_PRINT); 
} 
?>
