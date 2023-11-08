// JSON BASE A MOSTRAR EN FORMULARIO
/*
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };
*/
function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
    */
    // SE LISTAN TODOS LOS PRODUCTOS
    listarProductos();
}
    //LISTAR
function listarProductos(){
    $.ajax({
        url: './backend/product-list.php',
        type: 'GET',
        success: function(response){
            let productos = JSON.parse(response);
            let template = '';
            productos.forEach(producto => {
                // SE COMPRUEBA QUE SE OBTIENE UN OBJETO POR ITERACIÓN
                //console.log(producto);
                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                let descripcion = '';
                descripcion += '<li>precio: '+producto.precio+'</li>';
                descripcion += '<li>unidades: '+producto.unidades+'</li>';
                descripcion += '<li>modelo: '+producto.modelo+'</li>';
                descripcion += '<li>marca: '+producto.marca+'</li>';
                descripcion += '<li>detalles: '+producto.detalles+'</li>';
            
                template += `
                    <tr productId="${producto.id}">
                        <td>${producto.id}</td>
                        <td>
                            <a href="#" class="product-item">${producto.nombre}</a>
                        </td>
                        <td><ul>${descripcion}</ul></td>
                        <td>
                            <button class="product-delete btn btn-danger">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                `;
            });
            $('#products').html(template);
        }
    });
}

function validarDatosProducto(producto) {
    var nombreValido = false;
    var marcaValida = false;
    var modeloValido = false;
    var precioValido = false;
    var detallesValidos = false;
    var unidadesValidas = false;
    var imagenValida = false;

    if (!producto.nombre || typeof producto.nombre !== 'string' || producto.nombre.length > 100) {
        alert('El nombre del producto es inválido.');
        nombreValido = false;
    } else {
        nombreValido = true;
    }
    mostrarOcultarCheckmark('nombre-checkmark', nombreValido);
    mostrarOcultarXmark('nombre-xmark', !nombreValido);

    marcaValida = producto.marca !== "";
    mostrarOcultarCheckmark('marca-checkmark', marcaValida);
    mostrarOcultarXmark('marca-xmark', !marcaValida);

    modeloValido = producto.modelo.match(/^[a-zA-Z0-9 ]{1,25}$/);
    mostrarOcultarCheckmark('modelo-checkmark', modeloValido);
    mostrarOcultarXmark('modelo-xmark', !modeloValido);

    precioValido = !isNaN(producto.precio) && producto.precio > 99.99;
    mostrarOcultarCheckmark('precio-checkmark', precioValido);
    mostrarOcultarXmark('precio-xmark', !precioValido);

    // Validación del campo "detalles"
    detallesValidos = producto.detalles.length <= 250;
    mostrarOcultarCheckmark('desc-checkmark', detallesValidos);
    mostrarOcultarXmark('desc-xmark', !detallesValidos);

    // Validación del campo "unidades"
    if (isNaN(producto.unidades) || producto.unidades < 0 || producto.unidades === "") {
        alert("Las unidades son inválidas.");
        unidadesValidas = false;
    } else {
        unidadesValidas = true;
    }
    mostrarOcultarCheckmark('unidades-checkmark', unidadesValidas);
    mostrarOcultarXmark('unidades-xmark', !unidadesValidas);

    if (imagen == "") {
        document.getElementById('form-img').value = "img/default.png";
    }
    imagenValida = true;
    mostrarOcultarCheckmark('imagen-checkmark', imagenValida);
    mostrarOcultarXmark('imagen-xmark', !imagenValida);

    if (nombreValido && marcaValida && modeloValido && precioValido && detallesValidos && unidadesValidas) {
        // Todos los campos son válidos, puedes continuar con el proceso de envío del formulario.
        return true;
    } else {
        return false;
    }
}

// check
function mostrarOcultarCheckmark(checkmarkId, isValid) {
    if (isValid) {
      $('#' + checkmarkId).removeClass('hidden');
    } else {
      $('#' + checkmarkId).addClass('hidden');
    }
  }
// X
function mostrarOcultarXmark(XmarkId, mostrar) {
    if (mostrar) {
        $('#' + XmarkId).removeClass('hidden');
      } else {
        $('#' + XmarkId).addClass('hidden');
      }
}
    //BUSCAR
$(document).ready(function(){

    let editar = false;

    $('#product-result').hide();
    $('#search').keyup(function(){
        if($('#search').val()){
            let search = $('#search').val();
            $.ajax({
                url: './backend/product-search.php',
                type: 'GET',
                data: {search},
                success: function(response){
                    let productos = JSON.parse(response);
                    let template = '';

                    productos.forEach(producto =>{
                        template += `<li>
                            ${producto.nombre}
                        </li>`
                    })

                    $('#container').html(template);
                    $('#product-result').show();
                }
            });
        }
    });

    //Busqueda del nombre al insertar
    $('#nombre').keyup(function(){
        if($('#nombre').val()){
            let search = $('#nombre').val();
            $.ajax({
                url: './backend/product-search-Insert.php',
                type: 'GET',
                data: {search},
                success: function(response){
                    let productos = JSON.parse(response);
                    let template = `<p>Nota: Agregara un producto con nombre similar a los que se muestren en la lista<br>
                                        Si el producto es repetido no se agregara :(
                                    </p>`;

                    productos.forEach(producto =>{
                        template += `<li>
                            ${producto.nombre}
                        </li>`
                    })
                    if(!editar){
                        $('#container').html(template);
                        $('#product-result').show();
                    }
                }
            });
        }
    });

    //INSERTAR
    $('#product-form').submit(function(e){
        e.preventDefault();
        //var productoJsonString = $('#description').val();
        var finalJSON = {};
        finalJSON['nombre'] = $('#nombre').val();
        finalJSON['id'] = $('#productId').val();
        finalJSON['marca'] = $('#marca').val();
        finalJSON['modelo'] = $('#modelo').val();
        finalJSON['precio'] = $('#precio').val();
        finalJSON['detalles'] = $('#detalles').val();
        finalJSON['unidades'] = $('#unidades').val();
        finalJSON['imagen'] = $('#imagen').val();
        
        if(validarDatosProducto(finalJSON)){
            var productoJsonString = JSON.stringify(finalJSON,null,2);
            console.log(productoJsonString);
            let url = editar === false ? './backend/product-add.php': './backend/product-edit.php';
            $.post(url, productoJsonString, function(response){
                console.log(response);
                let respuesta = JSON.parse(response);
                let template_bar = '';
                    template_bar += `
                                <li style="list-style: none;">status: ${respuesta.status}</li>
                                <li style="list-style: none;">message: ${respuesta.message}</li>
                            `;
                $('#product-result').html(template_bar);
                $('#product-result').show();
                $('#produc-form').trigger('reset');
                listarProductos();
            
            });
        }
    });
    //ELIMINAR
    $(document).on('click', '.product-delete', function(){
        if(confirm("De verdad deseas eliminar el Producto")){
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('productId');
            $.post('./backend/product-delete.php', {id}, function (response) {
                let respuesta = JSON.parse(response);
                let template_bar = '';
                template_bar += `
                            <li style="list-style: none;">status: ${respuesta.status}</li>
                            <li style="list-style: none;">message: ${respuesta.message}</li>
                        `;
                $('#product-result').html(template_bar);
                $('#product-result').show();
                listarProductos();
            })
        }
    })

    $(document).on('click', '.product-item', function(){
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('productId');
        $.post('./backend/product-single.php', {id}, function(response){
            const producto = JSON.parse(response);
            //$('#name').val(producto.nombre);
            // Convierte la descripción a una cadena JSON con formato legible
            //const descripcion = JSON.stringify(producto.descripcion, null, 2);
            //$('#description').val(descripcion);
            $('#productId').val(producto.id);
            $('#nombre').val(producto.nombre);
            $('#marca').val(producto.marca);
            $('#modelo').val(producto.modelo);
            $('#precio').val(producto.precio);
            $('#detalles').val(producto.detalles);
            $('#unidades').val(producto.unidades);
            $('#imagen').val(producto.imagen);
            editar = true;
        });
    });
    

    //Check de los campos
    
});
