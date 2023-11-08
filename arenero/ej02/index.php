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
        require_once __DIR__ . '/Menu.php';
        $menu1 = new Menu;
        $menu1->cargar_opcion('https://facebook.com', 'Facebook');
        $menu1->cargar_opcion('https://buap.mx','BUAP');
        $menu1->cargar_opcion('https://instagram.com','Instagram');

        $menu1->mostrar();
    ?>
</body>
</html>