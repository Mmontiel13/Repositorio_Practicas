<?php
    use BACKEND\API\Update\Actualizar as Productos;
    require_once __DIR__.'/../vendor/autoload.php';

    $productos = new Productos('plataformavod');
    $productos->edit( json_decode( json_encode($_POST) ) );
    echo $productos->getResponse();
?>