<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    use EJEMPLOS\POO\Cabecera2 as Cabecera;

        require_once __DIR__ . '/Cabecera.php';
        $cab1 = new Cabecera('En manada somos más fuertes', 'center', 'https://buap.mx');
        $cab1->graficar();
    ?>
</body>
</html>