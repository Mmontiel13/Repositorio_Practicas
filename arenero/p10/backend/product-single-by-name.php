<?php
require_once __DIR__ . '/API/Productos.php'; 
use PRACTICA10\PRODUCTOS\Productos as Productos;
$conexionSBN = new Productos();
if ($conexionSBN->obtenerConexion()) {
    // Verifica si se envió un parámetro 'data' en el POST
    if (isset($_GET['name'])) {
        $Nombre = $_GET['name'];
        $conexionSBN->singleByName($Nombre);
        $conexionSBN->getResponse();
    }

}else{
    echo json_encode('Sin conexion', JSON_PRETTY_PRINT); 
} 
?>

