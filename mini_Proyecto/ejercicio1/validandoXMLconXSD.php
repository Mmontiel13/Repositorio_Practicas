<?php
libxml_use_internal_errors(true);
$xml= new DOMDocument();
$documento = file_get_contents('catalogovod.xml');
$xml->loadXML($documento, LIBXML_NOBLANKS);
// o usa $xml->load si prefieres usar la ruta del archivo
$xsd = 'serviciovod_ns.xsd';
if (!$xml->schemaValidate($xsd))// o usa $xml->schemaValidateSource si prefieres usar el xsd en format string
{
    $errors = libxml_get_errors();
    $noError = 1;
    $lista = '';
    foreach ($errors as $error)
    {
    $lista = $lista.'['.($noError++).']: '.$error->message.' ';
    }
    echo $lista;
}
else{
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
        </style>
        ';
    echo '<body>';
    echo '<header><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/Amazon_Prime_Video_logo.svg/2560px-Amazon_Prime_Video_logo.svg.png" style="width: 25em; height: auto;"/></header>';
    echo '<h1>Catalogo VOD</h1>';
    $peliculas = $xml->getElementsByTagName('peliculas');
    $series = $xml->getElementsByTagName('series');
    echo '<section>
            <h2>PELICULAS</h2>
            <table>';
            echo '<tr> 
                    <th>Titulo</th>
                    <th>Duraci&oacute;n</th>
                    <th>G&eacute;nero</th>
                </tr>
                ';
                foreach ($peliculas as $pelicula) {
                    $generos = $pelicula->getElementsByTagName('genero');
                    foreach ($generos as $genero) {
                        $titulos = $genero->getElementsByTagName('titulo');
                        
                        foreach ($titulos as $titulo) {
                            echo '<tr>
                                    <td>' . $titulo->nodeValue . '</td>
                                    <td>' . $titulo->getAttribute('duracion') . '</td>
                                    <td>' . $genero->getAttribute('nombre') . '</td>
                                  </tr>';
                        }
                    }
                }
        echo '</table>';
    echo '</section>';
    echo '<section>
            <h2>SERIES</h2>
            <table>';
            echo '<tr> 
                    <th>Titulo</th>
                    <th>Duraci&oacute;n</th>
                    <th>G&eacute;nero</th>
                </tr>
                ';
                foreach ($series as $serie) {
                    $generos = $serie->getElementsByTagName('genero');
                    foreach ($generos as $genero) {
                        $titulos = $genero->getElementsByTagName('titulo');
                        
                        foreach ($titulos as $titulo) {
                            echo '<tr>
                                    <td>' . $titulo->nodeValue . '</td>
                                    <td>' . $titulo->getAttribute('duracion') . '</td>
                                    <td>' . $genero->getAttribute('nombre') . '</td>
                                  </tr>';
                        }
                    }
                }
        echo '</table>';
    echo '</section>';
    echo '</body>';

    // Guardar el documento modificado en un nuevo archivo o sobrescribir el existente
    //$xml->save('nuevo_ejemplo.xml');
}

?>