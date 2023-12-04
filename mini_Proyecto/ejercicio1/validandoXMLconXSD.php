<?php
//COMENTE LAS CONSULTAS DE INSERSION, PUES HASYA EL MOMENTO SE EJECUTAN CADA QUE SE ABRE EL ARCHIVO PHP
libxml_use_internal_errors(true);

//cargamos xml y el xsd
$xml= new DOMDocument();
$documento = file_get_contents('catalogovod.xml');
$xml->loadXML($documento, LIBXML_NOBLANKS);
$xsd = 'serviciovod_ns.xsd';


if (!$xml->schemaValidate($xsd))//valida el xml con el xsd
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
else{ //si todo esta bien...
    $conexion = @mysqli_connect( //abrimos la conexion a la bd
        'localhost',
        'root',
        'Normita1230',
        'plataformavod'
    );

    //estilos para mostrar las peliculas y series en html
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
    //seleccionamos todos los nodos peliculas y series
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
                //vamos descomponiendo la pelicula
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
                                    $region = $pelicula->getAttribute('region');
                                    $nombre_genero = $genero->getAttribute('nombre');
                                    $nombre_titulo = $titulo->nodeValue;
                                    $duracion = $titulo->getAttribute('duracion');
                                    /*$sql = "INSERT INTO contenido VALUES (null, 'pelicula', '$region', '$nombre_genero', '$nombre_titulo', '$duracion', 0, 0)";  
                                    mysqli_query($conexion, $sql); */
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
                                  $region = $serie->getAttribute('region');
                                  $nombre_genero = $genero->getAttribute('nombre');
                                  $nombre_titulo = $titulo->nodeValue;
                                  $duracion = $titulo->getAttribute('duracion');
                                  /*$sql = "INSERT INTO contenido VALUES (null, 'serie', '$region', '$nombre_genero', '$nombre_titulo', '$duracion', 0, 0)";  
                                  mysqli_query($conexion, $sql); */
                        }
                    }
                }
        echo '</table>';
    echo '</section>';
    echo '</body>';
    
    //sacamos el correo y lo insertamos en la tabla cuenta
    $cuentas = $xml->getElementsByTagName('cuenta');
    foreach($cuentas as $cuenta){
        $correo = $cuenta->getAttribute('correo');
        /*$sql = "INSERT INTO cuenta VALUES (null, '$correo', 0)";  
        mysqli_query($conexion, $sql); */
    }

    //sacamos los perfiles y lo insertamos en la tabla perfiles
    //el ultimo 0 es la llave foranea que corresponde a la cuenta, seria bueno que hubiera una consulta que rectificara la existencia de esa cuenta.
    $perfiles = $xml->getElementsByTagName('perfil');
    foreach($perfiles as $perfil){
        $usuario = $perfil->getAttribute('usuario');
        $idioma = $perfil->getAttribute('idioma');
        /*$sql = "INSERT INTO perfiles VALUES (null, '$usuario', '$idioma', 0, 0)";  
        mysqli_query($conexion, $sql);*/
    }
    $conexion->close();

   
               
    
}

?>