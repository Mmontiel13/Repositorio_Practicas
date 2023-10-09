<?php 
    if(isset($_POST['UpdateProduct'])){
        @$link = new mysqli('localhost', 'root', '130803', 'marketzone');

        if ($link->connect_errno) 
        {
            die('Falló la conexión: '.$link->connect_error.'<br/>');
        }
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $marca = $_POST['marcas'];
        $modelo = $_POST['modelo'];
        $precio = $_POST['precio'];
        $detalles = $_POST['detalles'];
        $unidades = $_POST['unidades'];
        $imagen = $_POST['imagen'];
        $sql = "UPDATE productos SET nombre = '{$nombre}', marca = '{$marca}', modelo = '{$modelo}', precio = {$precio}, detalles = '{$detalles}', unidades = {$unidades}, imagen = '{$imagen}' WHERE id = {$id}";
        
        if(mysqli_query($link, $sql)){
        echo "Registro actualizado.";
        } else {
        echo "ERROR: No se ejecuto $sql. " . mysqli_error($link);
        }
        
        mysqli_close($link);
    }
    
?>