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
        'jorge',
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

    // Check if an account exists in the database
    function cuentaexistente($conexion, $correo) {
        $sql = "SELECT * FROM cuenta WHERE correo = '$correo'";
        $result = mysqli_query($conexion, $sql);

        if (!$result) {
            die('Error en la consulta: ' . mysqli_error($conexion));
        }

        return mysqli_num_rows($result) > 0;
    }

    // Get the ID_Cuenta associated with the correo
    function obtenerIDCuenta($conexion, $correo) {
        $sqlGetIDCuenta = "SELECT ID_Cuenta FROM cuenta WHERE correo = '$correo'";
        $resultGetIDCuenta = mysqli_query($conexion, $sqlGetIDCuenta);

        if (!$resultGetIDCuenta) {
            die('Error en la consulta para obtener ID_Cuenta: ' . mysqli_error($conexion));
        }

        $rowGetIDCuenta = mysqli_fetch_assoc($resultGetIDCuenta);
        return $rowGetIDCuenta['ID_Cuenta'];
    }

    // Process and display XML content
    function processXMLContent($xml, $tipo, $conexion) {
        $elements = $xml->getElementsByTagName($tipo);
        $content = '';
    
        foreach ($elements as $element) {
            $region = $element->getAttribute('region');
            $correo = $element->parentNode->getAttribute('correo'); // Get correo from the parent node
    
            // Debug: Display the correo value
            echo "Debug: Correo from XML: $correo\n";
    
            if (cuentaexistente($conexion, $correo)) {
                $idCuenta = obtenerIDCuenta($conexion, $correo);
    
                // Debug: Display the ID_Cuenta value
                echo "Debug: ID_Cuenta from Database: $idCuenta\n";
    
                $generos = $element->getElementsByTagName('genero');
    
                foreach ($generos as $genero) {
                    $nombre_genero = $genero->getAttribute('nombre');
                    $titulos = $genero->getElementsByTagName('titulo');
    
                    foreach ($titulos as $titulo) {
                        $nombre_titulo = $titulo->nodeValue;
                        $duracion = $titulo->getAttribute('duracion');
    
                        // Check if the record already exists
                        if (!datosexistente($conexion, $region, $nombre_genero, $nombre_titulo, $duracion)) {
                            // If not, insert the record into the database
                            $sql = "INSERT INTO contenido VALUES (null, '$tipo', '$region', '$nombre_genero', '$nombre_titulo', '$duracion', 0, 0, $idCuenta)";
                            $result = mysqli_query($conexion, $sql);
    
                            // Debug: Display the insert query
                            echo "Insert Query: $sql\n";
    
                            if (!$result) {
                                // Debug: Display the error message
                                echo 'Error in insertion: ' . mysqli_error($conexion) . "\n";
                            } else {
                                // Debug: Display success message
                                echo 'Insert successful: ' . mysqli_affected_rows($conexion) . " row(s) affected\n";
                            }
                        } else {
                            // Debug: Display a message if the record already exists
                            echo 'Record already exists: Tipo=$tipo, Region=$region, Genero=$nombre_genero, Titulo=$nombre_titulo, Duracion=$duracion, ID_Cuenta=$idCuenta\n';
                        }
                    }
                }
            } else {
                // Debug: Display a message if the account does not exist
                echo "Account not found: Correo=$correo\n";
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