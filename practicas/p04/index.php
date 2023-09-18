<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.1//EN”
“http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 4</title>
</head>
<body>
<h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <?php
        if(isset($_GET['numero']))
        {
            $num = $_GET['numero'];
            if ($num%5==0 && $num%7==0)
            {
                echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
            }
            else
            {
                echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
            }
        }
    ?>
    <!--
    <h2>Ejemplo de POST</h2>
    <form action="http://localhost/tecweb/practicas/p04/index.php" method="post">
        Name: <input type="text" name="name"><br>
        E-mail: <input type="text" name="email"><br>
        <input type="submit">
    </form>
    <br>
    <?php
        if(isset($_POST["name"]) && isset($_POST["email"]))
        {
            echo $_POST["name"];
            echo '<br>';
            echo $_POST["email"];
        }
    ?>
    -->
    <br><hr>
    <h2>Ejercicio 2</h2>
        <p>
            Crea un programa para la generación repetitiva de 3 números aleatorios hasta obtener una
            secuencia compuesta por:
        </p>
        <p>Impar, par, impar</p>
        <p>Por Ejemplo</p>
        <ul>
            <li>990, 382, 786</li>
            <li>422, 361, 473</li>
            <li>392, 671, 914</li>
            <li>213, 744, 911</li>
        </ul>
        <p>
            Estos números deben almacenarse en una matriz de Mx3, donde M es el número de filas y
            3 el número de columnas. Al final muestra el número de iteraciones y la cantidad de
            números generados:
        </p>
        <p>12 números obtenidos en 4 iteraciones</p>

        <form method="post" action="">
            <input type="submit" name="EJ2" value="Generar Matriz">
        </form>

        <?php
            if(isset($_POST['EJ2'])){
                
                    $secuencia = false;
                    $iteraciones = 0;
                    $matrizIPI = [];

                do{//Ciclo do-while que genera 3 numeros aleatorios asta que la secuencia (Impar, Par, Impar) se cumpla
                    $num1 = rand(100,999);
                    $num2 = rand(100,999);
                    $num3 = rand(100,999);
    
                    if($num1 % 2 == 1 && $num2 % 2 == 0 && $num3 % 2 == 1){
                        $secuencia = true;
                    }
                    $matrizIPI[] = [$num1,$num2,$num3];
                    $iteraciones++;
                }while(!$secuencia);

                for ($i = 0; $i < count($matrizIPI); $i += 3) {
                    echo '<p>';
                    for ($j = $i; $j < $i + 3 && $j < count($matrizIPI); $j++) {
                        echo '(' . implode(', ', $matrizIPI[$j]) . ') ';
                    }
                    echo '</p>';
                }
                echo '<p>'.($iteraciones * 3). ' números generados en '.$iteraciones.' iteraciones</p';
            }
        ?>
        <br><hr>
</body>
</html>