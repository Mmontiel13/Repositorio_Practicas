// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

// FUNCIÓN CALLBACK DE BOTÓN "Buscar"
function buscarID(e) {
    e.preventDefault();

    // SE OBTIENE LOS VALORES DE LOS CAMPOS DE BÚSQUEDA
    var id = document.getElementById('searchid').value;
    var nombre = document.getElementById('searchnombre').value;
    var marca = document.getElementById('searchmarca').value;
    var desc = document.getElementById('searchdescripcion').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n' + client.responseText);

            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            var data = JSON.parse(client.responseText);

            // SE VERIFICA SI HAY PRODUCTOS EN LA RESPUESTA
            if (data.productos) {
                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DE LOS PRODUCTOS
                var productosHTML = '';
                for (var i = 0; i < data.productos.length; i++) {
                    var producto = data.productos[i];
                    var descripcion = '<ul>';
                    descripcion += '<li>precio: ' + producto.precio + '</li>';
                    descripcion += '<li>unidades: ' + producto.unidades + '</li>';
                    descripcion += '<li>modelo: ' + producto.modelo + '</li>';
                    descripcion += '<li>marca: ' + producto.marca + '</li>';
                    descripcion += '<li>detalles: ' + producto.detalles + '</li>';
                    descripcion += '</ul>';
            
                    // SE CREA UNA PLANTILLA PARA CREAR LA(S) FILA(S) A INSERTAR EN EL DOCUMENTO HTML
                    var template = `
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td>${descripcion}</td>
                        </tr>
                    `;
            
                    productosHTML += template;
                }
            
                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = productosHTML;
            } else {
                document.getElementById("productos").innerHTML = "<tr><td colspan='3'>No se encontraron productos.</td></tr>";
            }
        }
    };
    if (id == "" && nombre == "" && marca == "" && desc == "") {
        document.getElementById("productos").innerHTML = "<tr><td colspan='3'>Campos de búsqueda vacíos.</td></tr>";
    } else{
        client.send("id=" + id + "&nombre=" + nombre + "&marca=" + marca + "&descripcion=" + desc);
    }
}

// FUNCIÓN CALLBACK DE BOTÓN "Agregar Producto"
function agregarProducto(e) {
    e.preventDefault();

    // SE OBTIENE DESDE EL FORMULARIO EL JSON A ENVIAR
    var productoJsonString = document.getElementById('description').value;
    
    try {
        var finalJSON = JSON.parse(productoJsonString);
        finalJSON['nombre'] = document.getElementById('name').value;
        // Validar los datos del producto antes de enviar
        if (validarDatosProducto(finalJSON)) {
            productoJsonString = JSON.stringify(finalJSON, null, 2);
            var client = getXMLHttpRequest();
            client.open('POST', './backend/create.php', true);
            client.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
            client.onreadystatechange = function () {
                // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
                if (client.readyState == 4) {
                    if (client.status == 200) {
                        console.log(client.responseText);
                        var response = JSON.parse(client.responseText);
                        if (response.success === true) {
                            alert(response.message);
                        } else if (response.success === false) {
                            alert(response.message);
                        }
                    } else {
                        console.error('Error en la solicitud al servidor. Código de estado:', client.status);
                        alert('Error en la solicitud al servidor. Código de estado: ' + client.status);
                    }
                }
            };
            client.send(productoJsonString);
        }
    } catch (error) {
        console.error('Error en el JSON:', error);
        alert('Error en el JSON: ' + error.message);
    }
}


function validarDatosProducto(producto) {
    if (!producto || typeof producto !== 'object') {
        alert('El JSON del producto no es válido.');
        return false;
    }

    if (!producto.nombre || typeof producto.nombre !== 'string' || producto.nombre.length > 100) {
        alert('El nombre del producto es inválido.');
        return false;
    }
    if (!producto.marca) {
        alert("La marca es requerida.");
        return false;
    }
    
    if (!producto.modelo.match(/^[a-zA-Z0-9 ]{1,25}$/)) {
        alert("El modelo debe ser alfanumérico y tener 25 caracteres o menos.");
        return false;
    }
    if (isNaN(producto.precio) || producto.precio <= 99.99) {
        alert("El precio debe ser un número mayor a 99.99.");
        return false;
    }

    if (producto.detalles.length > 250) {
        alert("Los detalles no deben tener más de 250 caracteres.");
        return false;
    }

    if (isNaN(producto.unidades) || producto.unidades < 0) {
        alert("Las unidades deben ser un número mayor o igual a 0.");
        return false;
    }

    if (!producto.imagen || producto.imagen.trim() === "") {
        producto.imagen = "img/default.png";
    }
    return true;
}

// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try{
        objetoAjax = new XMLHttpRequest();
    }catch(err1){
        /**
         * NOTA: Las siguientes formas de crear el objeto ya son obsoletas
         *       pero se comparten por motivos historico-académicos.
         */
        try{
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(err2){
            try{
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(err3){
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
}