// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "tipo": "pelicula",
    "region": "mx",
    "genero": "comedia",
    "duracion": "140",
    "ID_Cuenta": "1"
  };

$(document).ready(function(){
    let edit = false;

    let JsonString = JSON.stringify(baseJSON,null,2);
    $('#description').val(JsonString);
    $('#content-result').hide();
    listarContenido();

    function listarContenido() {
        $.ajax({
            url: './backend/content-list.php',
            type: 'GET',
            success: function(response) {
                const contenido = JSON.parse(response);
                if(Object.keys(contenido).length > 0) {
                    let template = '';

                    contenido.forEach(contenido => {
                        let descripcion = '';
                        descripcion += '<li>tipo: '+contenido.tipo+'</li>';
                        descripcion += '<li>region: '+contenido.region+'</li>';
                        descripcion += '<li>genero: '+contenido.genero+'</li>';
                        descripcion += '<li>duracion: '+contenido.duracion+'</li>';
                        descripcion += '<li>ID_Cuenta: '+contenido.ID_Cuenta+'</li>';
                        template += `
                            <tr productId="${contenido.ID_Contenido}">
                                <td>${contenido.ID_Contenido}</td>
                                <td><a href="#" class="product-item">${contenido.titulo}</a></td>
                                <td>${contenido.region}</td>
                                <td>${contenido.genero}</td>
                                <td>${contenido.tipo}</td>
                                <td>${contenido.duracion} minutos</td>
                                <td>
                                    <button class="product-delete btn btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#contenidos').html(template);
                }
            }
        });
    }

    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/content-search.php?search='+$('#search').val(),
                data: {search},
                type: 'GET',
                success: function (response) {
                    if(!response.error) {
                        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                        const productos = JSON.parse(response);
                        
                        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                        if(Object.keys(productos).length > 0) {
                            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                            let template = '';
                            let template_bar = '';

                            productos.forEach(producto => {
                                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                                let descripcion = '';
                                descripcion += '<li>tipo: '+contenido.tipo+'</li>';
                                descripcion += '<li>region: '+contenido.region+'</li>';
                                descripcion += '<li>genero: '+contenido.genero+'</li>';
                                descripcion += '<li>duracion: '+contenido.duracion+'</li>';
                                descripcion += '<li>ID_Cuenta: '+contenido.ID_Cuenta+'</li>';
                                template += `
                                    <tr productId="${contenido.ID_Contenido}">
                                        <td>${contenido.ID_Contenido}</td>
                                        <td><a href="#" class="product-item">${contenido.titulo}</a></td>
                                        <td>${contenido.region}</td>
                                        <td>${contenido.genero}</td>
                                        <td>${contenido.tipo}</td>
                                        <td>${contenido.duracion} minutos</td>
                                        <td>
                                            <button class="product-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                                template_bar += `
                                    <li>${contenido.titulo}</il>
                                `;
                            });
                            // SE HACE VISIBLE LA BARRA DE ESTADO
                            $('#product-result').show();
                            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                            $('#container').html(template_bar);
                            // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                            $('#products').html(template);    
                        }
                    }
                }
            });
        }
        else {
            $('#product-result').hide();
        }
    });

    $('#product-form').submit(e => {
        e.preventDefault();
        let postData = JSON.parse( $('#description').val() );
        postData['name'] = $('#name').val();
        postData['ID_Contenido'] = $('#contentId').val();

        /**
         * AQUÍ DEBES AGREGAR LAS VALIDACIONES DE LOS DATOS EN EL JSON
         * --> EN CASO DE NO HABER ERRORES, SE ENVIAR EL PRODUCTO A AGREGAR
         **/

        const url = edit === false ? './backend/content-add.php' : './backend/content-edit.php';
        
        $.post(url, postData, (response) => {
            console.log(response);
            let respuesta = JSON.parse(response);
            let template_bar = '';
            template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
            // SE REINICIA EL FORMULARIO
            $('#name').val('');
            $('#description').val(JsonString);
            // SE HACE VISIBLE LA BARRA DE ESTADO
            $('#product-result').show();
            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
            $('#container').html(template_bar);
            // SE LISTAN TODOS LOS PRODUCTOS
            listarContenido();
            // SE REGRESA LA BANDERA DE EDICIÓN A false
            edit = false;
        });
    });

    $(document).on('click', '.product-delete', (e) => {
        if(confirm('¿Realmente deseas eliminar el producto?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('contentId');
            $.post('./backend/content-delete.php', {id}, (response) => {
                $('#product-result').hide();
                listarContenido();
            });
        }
    });

    $(document).on('click', '.product-item', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('contentId');
        $.post('./backend/content-single.php', {id}, (response) => {
            // SE CONVIERTE A OBJETO EL JSON OBTENIDO
            let contenido = JSON.parse(response);
            // SE INSERTAN LOS DATOS ESPECIALES EN LOS CAMPOS CORRESPONDIENTES
            $('#name').val(contenido.titulo);
            // EL ID SE INSERTA EN UN CAMPO OCULTO PARA USARLO DESPUÉS PARA LA ACTUALIZACIÓN
            $('#contentId').val(contenido.ID_Contenido);
            // SE ELIMINA nombre, eliminado E id PARA PODER MOSTRAR EL JSON EN EL <textarea>
            delete(contenido.titulo);
            delete(contenido.eliminado);
            delete(contenido.ID_Contenido);
            // SE CONVIERTE EL OBJETO JSON EN STRING
            let JsonString = JSON.stringify(contenido,null,2);
            // SE MUESTRA STRING EN EL <textarea>
            $('#description').val(JsonString);
            
            // SE PONE LA BANDERA DE EDICIÓN EN true
            edit = true;
        });
        e.preventDefault();
    });    
});