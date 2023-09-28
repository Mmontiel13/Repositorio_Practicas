<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 3</title>
</head>
<body>
    <h2> Ejercicio 1 </h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar, $_7var, myvar, $myvar, $var7, $_element1, $house*5</p>
    <?php
        $_myvar;
        $_7var;
        //myvar; Invalida
        $myvar;
        $var7;
        $_element1; 
        //$house*5 Invalida

        echo '<ul>';
        echo '<li>$_myvar es valida por que inicia con guion bajo.';
        echo '<li>$_7var es valida por que inicia con guion bajo.';
        echo '<li>myvar es invalida por que no tiene el signo de dolar.';
        echo '<li>$myvar es valida por que inicia una letra.';
        echo '<li>$var7 es valida por que inicia una letra.';
        echo '<li>$_element1 es valida por que inicia con guion bajo.';
        echo '</ul>';
    ?>

    <br><hr>
    <h2> Ejercicio 2 </h2>
    <p>Proporcionar los valores de $a, $b, $c como sigue:</p>
    <p>
        $a = "ManejadorSQL";<br>
        $b = 'MySQL';<br>
        $c = &$a;<br>
    </p>
    <?php
       unset($a, $b, $c);
       $a = "ManejadorSQL";
       $b = 'MySQL';
       $c = &$a;
       echo 'Mostrando variables';
       echo '<br>';
       var_dump($a);
       var_dump($b);
       var_dump($c);
       $a = "PHP server";
       $b = &$a;
       echo '<br>';
       echo 'Mostrando variables luego de cambiar el valor:';
       echo '<br>';
       var_dump($a);
       var_dump($b);
       var_dump($c);
       echo '<br>';
       echo 'Al cambiar el valor de la variable a y las otras 2 variables tener el valor de la misma tambien se modifico su valor';
       echo '<br>';
    ?>

    <br><hr>
    <h2> Ejercicio 3 </h2>
    <p>
        Muestra el contenido de cada variable inmediatamente después de cada asignación,
        verificar la evolución del tipo de estas variables (imprime todos los componentes de los
        arreglo):
    </p>
    <ul>
        <li>$a = “PHP5”;</li>
        <li>$z[] = &$a;</li>
        <li>$b = “5a version de PHP”;</li>
        <li>$c = $b*10;</li>
        <li>$a .= $b;</li>
        <li>$b *= $c;</li>
        <li>$z[0] = “MySQL”;</li>
    </ul>
    <?php
        unset($a, $b, $c, $z);
        $a = "PHP5";
        echo 'Variable a: '.$a;
        echo '<br>';
        $z[] = &$a;
        echo 'Variable z: ';
        var_dump($z);
        echo '<br>';
        $b = "5a version de PHP";
        echo 'Variable b: '.$b;
        echo '<br>';
        @$c = $b*10;
        echo 'Variable c: '.$c;
        echo '<br>';
        $a .= $b;
        echo 'Variable a: '.$a;
        echo '<br>';
        @$b *= $c;
        echo 'Variable b: '.$b;
        echo '<br>';
        $z[0] = "MySQL";
        echo 'Variable z: ';
        var_dump($z);
    ?>

    <br><hr>
    <h2> Ejercicio 4</h2>
    <p>
    Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de
    la matriz $GLOBALS o del modificador global de PHP.
    </p>
    <?php
        unset($a, $b, $c, $z);
        $a = "PHP5";
        echo 'Variable a: '.$GLOBALS['a'];
        echo '<br>';
        $z[] = &$a;
        echo 'Variable z: '.$GLOBALS['z'][0];
        echo '<br>';
        $b = "5a version de PHP";
        echo 'Variable b: '.$GLOBALS['b'];
        echo '<br>';
        @$c = $b*10;
        echo 'Variable c: '.$GLOBALS['c'];
        echo '<br>';
        $a .= $b;
        echo 'Variable a: '.$GLOBALS['a'];
        echo '<br>';
        @$b *= $c;
        echo 'Variable b: '.$GLOBALS['b'];
        echo '<br>';
        $z[0] = "MySQL";
        echo 'Variable z: '.$GLOBALS['z'][0];
    ?>

    <br><hr>
    <h2> Ejercicio 5</h2>
    <p>Dar el valor de las variables $a, $b, $c al final del siguiente script:</p>
    <ul>
        <li>$a = “7 personas”;</li>
        <li>$b = (integer) $a;</li>
        <li>$a = “9E3”;</li>
        <li>$c = (double) $a;</li>
    </ul>
    <!--Comprobacion
    <?php
    
        unset($a, $b, $c, $z);
        $a = "7 personas";
        echo 'Variable a: '.$a;
        echo '<br>';
        $b = (integer) $a;
        echo 'Variable b: '.$b;
        echo '<br>';
        $a = "9E3";
        echo 'Variable a: '.$a;
        echo '<br>';
        $c = (double) $a;
        echo 'Variable c: '.$c;
    
    ?>
    -->
    <ul>
        <li>$a contendra una cadena "93E"</li>
        <li>$b contendra el valor de 7 </li>
        <li>$c su valor final sera 9000 </li>
    </ul>

    <br><hr>
    <h2> Ejercicio 6</h2>
    <p>
    Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f y muéstralas
    usando la función var_dump(datos).
    Después investiga una función de PHP que permita transformar el valor booleano de $c y $e
    en uno que se pueda mostrar con un echo:
    </p>
    <ul>
    <li>$a = “0”;</li>
    <li>$b = “TRUE”;</li>
    <li>$c = FALSE;</li>
    <li>$d = ($a OR $b);</li>
    <li>$e = ($a AND $c);</li>
    <li>$f = ($a XOR $b);</li>
    </ul>
    <?php
        unset($a, $b, $c, $d, $e, $f);
        $a = "0";
        $b = "TRUE";
        $c = "FALSE";
        $d = ($a OR $b);
        $e = ($a AND $c);
        $f = ($a XOR $b); 

        echo '$a = 0: ';
        //Comprobando si es bool con la funcion is_bool()
        if(is_bool($a)){
            echo "La variable es booleano";
        }
        else{
            echo "La variable No es Booleano";
        }
        //Mostrando variable con var_dupm()
        echo "<br>";
        var_dump($a);
        echo "<br><br>";
        //
        echo '$b = "TRUE": ';
        if(is_bool($b)){
            echo "La variable es booleano";
        }
        else{
            echo "La variable No es Booleano";
        }
        echo "<br>";
        var_dump($b);
        echo "<br><br>";
        //
        echo '$c = "FALSE": ';
        if(is_bool($c)){
            echo "La variable es booleano";
        }
        else{
            echo "La variable No es Booleano";
        }
        echo "<br>";
        var_dump($c);
        echo "<br><br>";
        //
        echo '$d = ($a OR $b): ';
        if(is_bool($d)){
            echo "La variable es booleano";
        }
        else{
            echo "La variable No es Booleano";
        }
        echo "<br>";
        var_dump($d);
        echo "<br><br>";
        //
        echo '$e = ($a AND $c): ';
        if(is_bool($e)){
            echo "La variable es booleano";
        }
        else{
            echo "La variable No es Booleano";
        }
        echo "<br>";
        var_dump($e);
        echo "<br><br>";
        //
        echo '$f = ($a XOR $b): ';
        if(is_bool($f)){
            echo "La variable es booleano";
        }
        else{
            echo "La variable No es Booleano";
        }
        echo "<br>";
        var_dump($f);
        echo "<br><br>";

        // Convierte las variables $c y $e en enteros (0 o 1)
        settype($c, "int");
        settype($e, "int");
        echo 'Monstrando $c con un echo: '.$c;
        echo "<br>";
        echo 'Monstrando $e con un echo: '.$e;
        echo "<br>Debido a que son falsos se muestra 0";
    ?>

    <br><hr>
    <h2> Ejercicio 7</h2>
    <p>
        Usando la variable predefinida $_SERVER, determina lo siguiente:
    </p>
    <ul>
        <li>La versión de Apache y PHP</li>
        <li>El nombre del sistema operativo (servidor)</li>
        <li>El idioma del navegador (cliente)</li>
    </ul>
    <?php
        $versionApache = $_SERVER['SERVER_SOFTWARE'];
        echo "Versión de Apache y PHP: $versionApache <br><br>";
        $sistemaOperativo = php_uname('s');
        echo "Nombre del sistema operativo del servidor: $sistemaOperativo <br><br>";
        $idiomaNavegador = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        echo "Idioma del navegador cliente: $idiomaNavegador <br><br>";
    ?>
    <p><a href="http://validator.w3.org/check?uri=refer"><img src="http://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" /></a></p>
</body>
</html>