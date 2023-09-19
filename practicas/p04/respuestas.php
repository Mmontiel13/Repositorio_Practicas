<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respuestas ej 5 y 6</title>
</head>
<body>
    <h1>Solución Ejercicios 5 y 6</h1>
    <form action="index.php">
        <input type="submit" value="regresar">
    </form>
    <h2>Ejercicio 5</h2>
    <?php
    include('funcionesEj5.php');
    if(isset($_POST['edad']) && isset($_POST['sexo'])){
        $edad = intval($_POST['edad']);
        $sexo = $_POST['sexo'];
        ejercicio5($edad, $sexo);
    }
    ?>
    <br><hr>
    <h2>Ejercicio 6</h2>
    <?php
        include('REj6.php');

        function mostrarVehiculoPorMatricula($parqueVehicular, $matricula) {
            if (isset($parqueVehicular[$matricula])) {
                $vehiculo = $parqueVehicular[$matricula];
                echo "Matrícula: $matricula<br>";
                echo "Auto:<br>";
                foreach ($vehiculo['Auto'] as $clave => $valor) {
                    echo "$clave: $valor<br>";
                }
                echo "Propietario:<br>";
                foreach ($vehiculo['Propietario'] as $clave => $valor) {
                    echo "$clave: $valor<br>";
                }
            } else {
                echo "Matrícula $matricula no encontrada.<br>";
            }
        }
        


        if(isset($_POST['buscar'])){
            
            $matriculaBuscada = strtoupper($_POST['buscarMatricula']);
            mostrarVehiculoPorMatricula($parqueVehicular, $matriculaBuscada);

        }elseif(isset($_POST['mostrarTodos'])){
            echo "Mostrando todos los vehiculos <br>";
            foreach ($parqueVehicular as $matricula => $vehiculo) { 
                echo "<h4>Matricula: $matricula </h4>";
                print_r($vehiculo);
                echo "<br>";
            }
        }
 
    ?>
</body>
</html>