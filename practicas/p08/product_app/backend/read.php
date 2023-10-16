<?php
include_once __DIR__.'/database.php';

// SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
$data = array();

if (isset($_POST['id']) || isset($_POST['nombre']) || isset($_POST['marca']) || isset($_POST['descripcion'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $descripcion = $_POST['descripcion'];
    
    // SE REALIZA LA QUERY DE BÚSQUEDA CON LA CLÁUSULA LIKE
    $query = "SELECT * FROM productos WHERE 1=1";
    
    if (!empty($id)) {
        $query .= " AND id = '$id'";
    }
    
    if (!empty($nombre)) {
        $query .= " AND nombre LIKE '%$nombre%'";
    }
    
    if (!empty($marca)) {
        $query .= " AND marca LIKE '%$marca%'";
    }
    
    if (!empty($descripcion)) {
        $query .= " AND detalles LIKE '%$descripcion%'";
    }
    
    if ($result = $conexion->query($query)) {
        $productos = array();
        
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
            $producto = array();
            foreach($row as $key => $value) {
                $producto[$key] = utf8_encode($value);
            }
            $productos[] = $producto;
        }
        
        $data['productos'] = $productos;
        
        $result->free();
    } else {
        die('Query Error: '.mysqli_error($conexion));
    }
    $conexion->close();
}

// SE HACE LA CONVERSIÓN DE ARRAY A JSON
echo json_encode($data, JSON_PRETTY_PRINT);
?>
