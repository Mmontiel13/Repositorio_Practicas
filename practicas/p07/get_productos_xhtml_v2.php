<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.1//EN” 
“http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<?php
    $data = array();
    if(isset($_GET['tope']))
        $tope = $_GET['tope'];

    if (!empty($tope))
    {
        /** SE CREA EL OBJETO DE CONEXION */
        @$link = new mysqli('localhost', 'root', '130803', 'marketzone');	

        /** comprobar la conexión */
        if ($link->connect_errno) 
        {
            die('Falló la conexión: '.$link->connect_error.'<br/>');
                /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
        }

        /** Crear una tabla que no devuelve un conjunto de resultados si es que esta el id*/
        if ( $result = $link->query("SELECT * FROM productos WHERE unidades <= $tope") ) 
        {
            $row = $result->fetch_all(MYSQLI_ASSOC);
            
            $result->free();
        }

        $link->close();
    }
?>

<body>
    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Marca</th>
            <th scope="col">Modelo</th>
            <th scope="col">Precio</th>
            <th scope="col">Unidades</th>
            <th scope="col">Detalles</th>
            <th scope="col">Imagen</th>
            <th scope="col">Modificar</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php 
                    foreach ($row as $registro) {
                        $fila_id = $registro['id'];
                        echo '<tr id="' . $fila_id . '">';
                        echo '<td scope="row">' . $registro['id'] . '</td>';
                        echo '<td class="row-data">' . $registro['nombre'] . '</td>';
                        echo '<td class="row-data">' . $registro['marca'] . '</td>';
                        echo '<td class="row-data">' . $registro['modelo'] . '</td>';
                        echo '<td class="row-data">' . $registro['precio'] . '</td>';
                        echo '<td class="row-data">' . $registro['unidades'] . '</td>';
                        echo '<td class="row-data">' . $registro['detalles'] . '</td>';
                        echo '<td class="row-data"><img src="' . $registro['imagen'] . '"></td>';
                        echo '<td><input type="button" value="Modificar" onclick="show()" /></td>';
                        echo '</tr>';
                    }
                ?>
            </tr>
        </tbody>
    </table>

    <script>
        /*Esta funcion es la misma que con el get*/
        function show() {
            // se obtiene el id de la fila donde está el botón presinado
            var rowId = event.target.parentNode.parentNode.id;

            // se obtienen los datos de la fila en forma de arreglo
            var data = document.getElementById(rowId).querySelectorAll(".row-data");
            /**
            querySelectorAll() devuelve una lista de elementos (NodeList) que 
            coinciden con el grupo de selectores CSS indicados.
            (ver: https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Selectors)

            En este caso se obtienen todos los datos de la fila con el id encontrado
            y que pertenecen a la clase "row-data".
            */

            var nombre = data[0].innerHTML;
            var marcas = data[1].innerHTML;
            var modelo = data[2].innerHTML;
            var precio = data[3].innerHTML;
            var unidades = data[4].innerHTML;
            var detalles = data[5].innerHTML;
            
            var imagenCompleta = data[6].innerHTML;
            var inicioSrc = imagenCompleta.indexOf('"') + 1;

            var finSrc = imagenCompleta.indexOf('"', inicioSrc);

            var imagenURL = imagenCompleta.substring(inicioSrc, finSrc);

            alert("nombre: " + nombre + "\nmarca: " + marcas + "\nmodelo: " + modelo + "\nprecio: " + precio + "\nunidades: " + unidades + "\nimg: " + imagenURL);
            send2form(nombre, marcas, modelo, precio, unidades, detalles, imagenURL);
        }
    </script>

    <script>
            function send2form(nombre, marcas, modelo, precio, unidades, detalles, imagen) {

                var form = document.createElement("form");
                form.method = 'POST';
                form.action = "http://localhost/tecweb/practicas/p07/formulario_productos_v2.php";

                var nombreIn = document.createElement("input");
                nombreIn.type = 'text';
                nombreIn.name = 'nombre';
                nombreIn.value = nombre;
                form.appendChild(nombreIn);

                // Aquí debes eliminar la creación duplicada del campo 'marcaIn' y solo dejar el menú desplegable

                var marcaSelect = document.createElement("select");
                marcaSelect.name = 'marcas';

                var opciones = ["HP", "DELL", "LENOVO", "AMD", "INTEL"];
                for (var i = 0; i < opciones.length; i++) {
                    var opcion = document.createElement("option");
                    opcion.text = opciones[i];
                    marcaSelect.appendChild(opcion);
                }
                marcaSelect.value = marcas;
                form.appendChild(marcaSelect);

                var modeloIn = document.createElement("input");
                modeloIn.type = 'text';
                modeloIn.name = 'modelo';
                modeloIn.value = modelo;
                form.appendChild(modeloIn);

                var precioIn = document.createElement("input");
                precioIn.type = 'text';
                precioIn.name = 'precio';
                precioIn.value = precio;
                form.appendChild(precioIn);

                var unidadesIn = document.createElement("input");
                unidadesIn.type = 'text';
                unidadesIn.name = 'unidades';
                unidadesIn.value = unidades;
                form.appendChild(unidadesIn);

                var detallesIn = document.createElement("input");
                detallesIn.type = 'text';
                detallesIn.name = 'detalles';
                detallesIn.value = detalles;
                form.appendChild(detallesIn);

                var imagenIn = document.createElement("input");
                imagenIn.type = 'text';
                imagenIn.name = 'imagen';
                imagenIn.value = imagen;
                form.appendChild(imagenIn);

                document.body.appendChild(form);
                form.submit();
            }
        </script>

</body>
	
</html