<?php
    use BACKEND\API\Read\Leer as Productos;
    require_once __DIR__.'/../vendor/autoload.php';

    $productos = new Productos('marketzone');
    $productos->search( $_GET['search'] );
    echo $productos->getResponse();
?>