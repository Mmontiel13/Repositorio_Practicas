<?php
    use BACKEND\API\Delete\Eliminar as Productos;
    require_once __DIR__.'/../vendor/autoload.php';

    $productos = new Productos('marketzone');
    $productos->delete( $_POST['id'] );
    echo $productos->getResponse();
?>