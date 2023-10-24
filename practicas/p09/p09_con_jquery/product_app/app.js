// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;

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
    //INSERTAR
    $('#product-form').submit(function(e){
        e.preventDefault();
        var productoJsonString = $('#description').val();
        var finalJSON = JSON.parse(productoJsonString);
        finalJSON['nombre'] = $('#name').val();
        finalJSON['id'] = $('#productId').val();
        productoJsonString = JSON.stringify(finalJSON,null,2);

        let url = editar === false ? './backend/product-add.php': './backend/product-edit.php';

        console.log(url);

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
            $('#name').val(producto.nombre);
            // Convierte la descripción a una cadena JSON con formato legible
            const descripcion = JSON.stringify(producto.descripcion, null, 2);
            $('#description').val(descripcion);
            $('#productId').val(producto.id);
            editar = true;
        });
    });
    
});
