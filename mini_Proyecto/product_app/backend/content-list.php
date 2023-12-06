<?php
    use BACKEND\API\Read\Leer as Producto;
    require_once __DIR__.'/../vendor/autoload.php';

    $productos = new Producto('plataformavod');
    $productos->list();
    echo $productos->getResponse();
?>