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
            require_once __DIR__ . '/Persona.php';
            $per1 = new Persona;
            $per1->inicializar('Yoshua');
            $per1->mostrar();
            echo 'X';
            $per2 = new Persona;
            $per2->inicializar('Darla');
            $per2->mostrar();
        ?>
    </body>
</html>