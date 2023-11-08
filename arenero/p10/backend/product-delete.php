<?php
require_once __DIR__ . '/API/Productos.php'; 
use PRACTICA10\PRODUCTOS\Productos as Productos;
$conexionDel = new Productos();
if ($conexionDel->obtenerConexion()) {
    // Verifica si se envió un parámetro 'id' en el POST
    if( isset($_POST['id']) ) {
        $Id = $_POST['id'];
        $conexionDel->delete($Id);
        $conexionDel->getResponse();
    }
}else{
    echo json_encode('Sin conexion', JSON_PRETTY_PRINT); 
} 
?>