<?php
    use BACKEND\API\Create\Crear as Productos;
    require_once __DIR__.'/../vendor/autoload.php';

    $productos = new Productos('marketzone');
    $productos->add( json_decode( json_encode($_POST) ) );
    echo $productos->getResponse();
?>