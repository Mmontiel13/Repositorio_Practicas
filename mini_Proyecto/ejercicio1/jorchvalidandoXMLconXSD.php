<?php
libxml_use_internal_errors(true);

$xml = new DOMDocument();
$documento = file_get_contents('catalogovod.xml');
$xml->loadXML($documento, LIBXML_NOBLANKS);

$xsd = 'serviciovod_ns.xsd';

if (!$xml->schemaValidate($xsd)) {
    $errors = libxml_get_errors();
    $noError = 1;
    $lista = '';
    foreach ($errors as $error) {
        $lista = $lista . '[' . ($noError++) . ']: ' . $error->message . ' ';
    }
    echo $lista;
} else {
    $conexion = @mysqli_connect(
        'localhost',
        'root',
        'Normita1230',
        'plataformavod'
    );

    if (!$conexion) {
        die('Error de conexión a la base de datos: ' . mysqli_connect_error());
    }

    echo '<style>
            body {
                font-family: sans-serif;
                margin: 20px;
            }
            header {
                text-align: center;
                margin-bottom: 20px;
            }
            main {
                max-width: 800px;
                margin: 0 auto;
            }
            h1 {
                text-align: center;
            }
            section {
                margin-bottom: 30px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>';

    echo '<body>';
    echo '<header><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/Amazon_Prime_Video_logo.svg/2560px-Amazon_Prime_Video_logo.svg.png" style="width: 25em; height: auto;"/></header>';
    echo '<h1>Catalogo VOD</h1>';

    // Function to check if a record exists in the database
    function datosexistente($conexion, $region, $nombre_genero, $nombre_titulo, $duracion) {
        $sql = "SELECT * FROM contenido WHERE region = '$region' AND genero = '$nombre_genero' AND titulo = '$nombre_titulo' AND duracion = '$duracion'";
        $result = mysqli_query($conexion, $sql);

        if (!$result) {
            die('Error en la consulta: ' . mysqli_error($conexion));
        }

        return mysqli_num_rows($result) > 0;
    }

    //checa si hay una cuenta en la bd coincidente
    function cuentaexistente($conexion, $correo) {
        $sql = "SELECT * FROM cuenta WHERE correo = '$correo'";
        $result = mysqli_query($conexion, $sql);

        if (!$result) {
            die('Error en la consulta: ' . mysqli_error($conexion));
        }

        return mysqli_num_rows($result) > 0;
    }

    function perfilexistente($conexion, $usuario, $correo) {
        $sql = "SELECT * FROM perfiles WHERE usuario = '$usuario' AND ID_Cuenta = (SELECT ID_Cuenta FROM cuenta WHERE correo = '$correo')";
        $result = mysqli_query($conexion, $sql);
        if (!$result) {
            die('Error en la consulta: ' . mysqli_error($conexion));
        }

        return mysqli_num_rows($result) > 0;
    }

    // Process and display XML content
    function processXMLContent($xml, $tipo, $conexion) {
        //insercion de cuentas(correos pues)
        $cuentas = $xml->getElementsByTagName('cuenta');
        foreach($cuentas as $cuenta){
            $correo = $cuenta->getAttribute('correo');
            if (!cuentaexistente($conexion, $correo)) {
                // If not, insert the record into the database
                $sql = "INSERT INTO cuenta VALUES (null, '$correo', 0)";
                $result = mysqli_query($conexion, $sql);

                if (!$result) {
                    die('Error en la inserción: ' . mysqli_error($conexion));
                }
            }
            //insercion de perfiles, se hace en el foreach pq getElementsByTagName jala varios nodos, aunque solo haya uno en el exml
            $perfiles = $xml->getElementsByTagName('perfil');
            foreach($perfiles as $perfil){
                $usuario = $perfil->getAttribute('usuario');
                $idioma = $perfil->getAttribute('idioma');
                if (!perfilexistente($conexion, $usuario, $correo)) {
                    //jala el ID_Cuenta asociado al correo
                    $sqlObtenerID = "SELECT ID_Cuenta FROM cuenta WHERE correo = '$correo'";
                    $resultObtenerID = mysqli_query($conexion, $sqlObtenerID);

                    if (!$resultObtenerID) {
                        die('Error en la consulta para obtener ID_Cuenta: ' . mysqli_error($conexion));
                    }

                    $row = mysqli_fetch_assoc($resultObtenerID);
                    $idCuenta = $row['ID_Cuenta'];  
                    $sql = "INSERT INTO perfiles VALUES (null, '$usuario', '$idioma', 0, $idCuenta)";
                    $result = mysqli_query($conexion, $sql);

                    if (!$result) {
                        die('Error en la inserción: ' . mysqli_error($conexion));
                    }
                }
            }
        }        

        $elements = $xml->getElementsByTagName($tipo);
        $content = '';

        foreach ($elements as $element) {
            $region = $element->getAttribute('region');
            $generos = $element->getElementsByTagName('genero');

            foreach ($generos as $genero) {
                $nombre_genero = $genero->getAttribute('nombre');
                $titulos = $genero->getElementsByTagName('titulo');

                foreach ($titulos as $titulo) {
                    $nombre_titulo = $titulo->nodeValue;
                    $duracion = $titulo->getAttribute('duracion');

                    $content .= "<tr>
                                    <td>$nombre_titulo</td>
                                    <td>$duracion</td>
                                    <td>$nombre_genero</td>
                                </tr>";

                    // Check if the record already exists
                    if (!datosexistente($conexion, $region, $nombre_genero, $nombre_titulo, $duracion)) {
                        // If not, insert the record into the database
                        $sql = "INSERT INTO contenido VALUES (null, '$tipo', '$region', '$nombre_genero', '$nombre_titulo', '$duracion', 0, 0)";
                        $result = mysqli_query($conexion, $sql);

                        if (!$result) {
                            die('Error en la inserción: ' . mysqli_error($conexion));
                        }
                    }
                    
                    

                    
                }
            }
        }

        return $content;
    }

    echo '<section>
            <h2>PELICULAS</h2>
            <table>';
    echo '<tr> 
            <th>Titulo</th>
            <th>Duraci&oacute;n</th>
            <th>G&eacute;nero</th>
        </tr>';
    echo processXMLContent($xml, 'peliculas', $conexion);
    echo '</table>';
    echo '</section>';

    echo '<section>
            <h2>SERIES</h2>
            <table>';
    echo '<tr> 
            <th>Titulo</th>
            <th>Duraci&oacute;n</th>
            <th>G&eacute;nero</th>
        </tr>';
    echo processXMLContent($xml, 'series', $conexion);
    echo '</table>';
    echo '</section>';
    echo '</body>';
}

libxml_use_internal_errors(false); // Clear error buffer
?>