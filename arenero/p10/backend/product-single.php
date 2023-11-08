<?php
require_once __DIR__ . '/API/Productos.php'; 
use PRACTICA10\PRODUCTOS\Productos as Productos;
$conexionSingle= new Productos();
if ($conexionSingle->obtenerConexion()) {
    if( isset($_POST['id']) ) {
        $Id = $_POST['id'];
        $conexionSingle->single($Id);
        $conexionSingle->getResponse();
    }
}else{
    echo json_encode('Sin conexion', JSON_PRETTY_PRINT); 
} 
?>