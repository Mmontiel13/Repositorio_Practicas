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

        <h2>Ejercicio 3</h2>
        <p>
            Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente,
            pero que además sea múltiplo de un número dado.
        </p>
        <ul>
            <li>Crear una variante de este script utilizando el ciclo do-while.</li>
            <li>El número dado se debe obtener vía GET.</li>
        </ul>
        <?php
        if(isset($_GET['numeroEJ3']))
        {
            $numDado = $_GET['numeroEJ3'];
            $numEnc = 0;
            while(true){
                $numEnc = rand(0, 1000);
                if($numDado % $numEnc == 0){
                    break;
                }
            }
            echo "El primer número múltiplo de $numDado obtenido aleatoriamente es: $numEnc";
        }
        ?>
        <p>
            Variante usando do-while
        </p>
        <?php
        if(isset($_GET['numeroEJ3']))
        {
            $numDado = $_GET['numeroEJ3'];
            $numEnc = 0;

            do{
                $numEnc = rand(0,1000);
            }while($numEnc % $numDado != 0);//el ciclo sigue asta que el modulo del numero encontrado con el numero obtenido con $_GET sea 0
            echo "El primer número múltiplo de $numDado obtenido aleatoriamente es: $numEnc";
        }
        ?>

    <br><hr>

    <h2>Ejercicio 4</h2>
    <p>
        Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la ‘a’
        a la ‘z’. Usa la función chr(n) que devuelve el caracter cuyo código ASCII es n para poner
        el valor en cada índice. Es decir:
    </p>
    <p>
        [97] => a <br>
        [98] => b <br>
        [99] => c <br>
        ... <br>
        [122] => z <br>
    </p>
    <ul>
        <li>Crea el arreglo con un ciclo for</li>
        <li>Lee el arreglo y crea una tabla en XHTML con echo y un ciclo foreach</li>
    </ul>
    <?php
        $abc = array();
        for($i = 97; $i <= 122; $i++){
            $abc[$i] = chr($i);
        }
        echo '<table border = "1">';
        echo '<tr><th>Indice</th><th>Valor</th></tr>';

        foreach ($abc as $indice => $valor) {
            echo '<tr>';
            echo '<td>' . $indice . '</td>';
            echo '<td>' . $valor . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    ?>

    <br><hr>

    <h2>Ejercicio 5</h2>
    <p>
        Usar las variables $edad y $sexo en una instrucción if para identificar una persona de
        sexo “femenino”, cuya edad oscile entre los 18 y 35 años y mostrar un mensaje de
        bienvenida apropiado. Por ejemplo: <br>
        Bienvenida, usted está en el rango de edad permitido. <br>
        En caso contrario, deberá devolverse otro mensaje indicando el error.
    </p>
    <ul>
        <li>
            Los valores para $edad y $sexo se deben obtener por medio de un formulario en
            HTML.
        </li>
        <li>Utilizar el la Variable Superglobal $_POST (revisar documentación).</li>
    </ul>
    
    <form method="post" action="">
        <label for="edad">Edad: </label>
        <input type="number" name="edad">
        <select id="sexo" name="sexo">
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
        </select>
        <input type="submit" value="Verificar">
    </form>
    <?php
    if (isset($_POST['edad']) && isset($_POST['sexo'])) {
        $edad = intval($_POST['edad']);
        $sexo = $_POST['sexo'];

        if ($sexo === 'femenino' && $edad >= 18 && $edad <= 35) {
            echo '<p>Bienvenida, usted está en el rango de edad permitido.</p>';
        } else {
            echo '<p>No se pudo acceder no cumple los requisitos.</p>';
        }
    }
    ?>
    
</body>
</html>