<?php
require_once __DIR__ . '/API/Productos.php'; 
use PRACTICA10\PRODUCTOS\Productos as Productos;
$conexionEdit = new Productos();
if ($conexionEdit->obtenerConexion()) {
    // Verifica si se envió un parámetro 'data' en el POST
    if( isset($_POST['data']) ) {
        // data se convierte a un string json y luego a un objeto PHP
        $Producto = json_decode( json_encode($_POST['data']) );
        $conexionEdit->edit($Producto);
        $conexionEdit->getResponse();
    }
}else{
    echo json_encode('Sin conexion', JSON_PRETTY_PRINT); 
} 
?>