$(document).ready(function(){
    let edit = false;

    /*VALIDACIONES DE INPUTS CON BLUR. al momento de dejar de hacer focus en los inputs*/
    //VALIDACION DEL NOMBRE
    $("#name").on("blur", function() {
        const nombre = $(this).val();    
        if (nombre.length === 0 || nombre.length > 100) {
            $(this).addClass("invalid");
            $('#name-validation').html('<i class="bi bi-x-circle"></i> El Nombre no debe tener menos de 1 caracter ni más de 100.');
            $('#name-validation').show();
        } else {
            $(this).removeClass("invalid").addClass("valid");
            $('#name-validation').html('');
            $('#name-validation').hide();
        }
    });
    
    // Validación para el campo "Modelo"
    $("#model").on("blur", function() {
        let modelo = $(this).val();
        modelo = modelo.trim();
        const esAlfanumerico = /^[A-Z]{2}-\d{3}$/.test(modelo);

        if (!esAlfanumerico || modelo.trim() === "") {
            $(this).removeClass("valid").addClass("invalid");
            $('#model-validation').html('<i class="bi bi-x-circle"></i> El Modelo es obligatorio y debe seguir el formato XX-000.');
            $('#model-validation').show();
        } else {
            $(this).removeClass("invalid").addClass("valid");
            $('#model-validation').html('');
            $('#model-validation').hide();
        }
    });

    // Validación para el campo "Precio"
    $("#price").on("blur", function() {
        const precio = $(this).val();
        const esPrecioValido = !isNaN(parseFloat(precio)) && isFinite(precio) && parseFloat(precio) > 99.99;

        if (!esPrecioValido || precio.trim() === "") {
            $(this).removeClass("valid").addClass("invalid");
            $('#price-validation').html('<i class="bi bi-x-circle"></i> El Precio ingresado no es un número válido o debe ser mayor a 99.99.');
            $('#price-validation').show();
            return;
        } else {
            $(this).removeClass("invalid").addClass("valid");
            $('#price-validation').html('');
            $('#price-validation').hide();
        }
    });

    // Validación para el campo "Detalles"
    $("#details").on("blur", function() {
        const detalles = $(this).val();
        if (detalles.length >= 250) {
            $(this).removeClass("valid").addClass("invalid");
            $('#details-validation').html('<i class="bi bi-x-circle"></i> Los Detalles deben tener menos de 250 caracteres.');
            $('#details-validation').show();
        } else {
            $(this).removeClass("invalid").addClass("valid");
            $('#details-validation').html('');
            $('#details-validation').hide();
        }
    });

    // Validación para el campo "Unidades"
    $("#units").on("blur", function() {
        const unidades = $(this).val();
        if (unidades === "0" || unidades.trim() === "") {
            $(this).removeClass("valid").addClass("invalid");
            $('#units-validation').html('<i class="bi bi-x-circle"></i> Debes ingresar una cantidad de Unidades mayor que 0.');
            $('#units-validation').show();
        } else {
            $(this).removeClass("invalid").addClass("valid");
            $('#units-validation').html('');
            $('#units-validation').hide();
        }
    });

    // Validación para el campo "Imagen"
    $("#image").on("blur", function() {
        const imagen = $(this).val();
        if (imagen.trim() === "") {
            $(this).val('img/default.png')
            $(this).removeClass("invalid").addClass("valid");
            $('#image-validation').html('<i class="bi bi-lightbulb"></i> Se agregará una imagen por defecto.');
            $('#image-validation').show();
        } else {
            $(this).removeClass("invalid").addClass("valid");
            $('#image-validation').html('');
            $('#image-validation').hide();
        }
    });
    //FIN DE LAS VALIDACIONES BLUR

    $('#product-result').hide(); /*este es un id del div que sirve para mostrar mensajes acerca del estatus de consultas*/
    listarProductos(); //este es para que siempre muestre los productos de la bd al momento de entrar al index
    /*Los sig id son para ocultar los divs que sirven para hacer la primera validacion de entradas. Muestran un pequeño mensaje 
    debajo del input indicando que esta mal*/
    $('#name-validation').hide();
    $('#model-validation').hide();
    $('#price-validation').hide();
    $('#details-validation').hide();
    $('#units-validation').hide();
    $('#image-validation').hide();
    
    //EMPEZAMOS CON LAS FUNCIONES

    //funcion que lista los objetos de la bd disponibles
    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response) {
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                const productos = JSON.parse(response);
                console.log(productos);
                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                if(Object.keys(productos).length > 0) {
                    // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                    let template = '';
                    productos.forEach(producto => {
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
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger" onclick="">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    $('#products').html(template);
                }
            }
        });
    }

    //FUNCION SEARCH, se activa cada que tipeamos sobre la barra de busqueda
    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/product-search.php?search='+$('#search').val(),
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
                                descripcion += '<li>precio: '+producto.precio+'</li>';
                                descripcion += '<li>unidades: '+producto.unidades+'</li>';
                                descripcion += '<li>modelo: '+producto.modelo+'</li>';
                                descripcion += '<li>marca: '+producto.marca+'</li>';
                                descripcion += '<li>detalles: '+producto.detalles+'</li>';
                            
                                template += `
                                    <tr productId="${producto.id}">
                                        <td>${producto.id}</td>
                                        <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="product-delete btn btn-danger" onclick="">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                                template_bar += `
                                    <li>${producto.nombre}</il>
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
    
    //FUNCION ADD
    $('#product-form').submit(e => {
        e.preventDefault(); //ESTO EVITA EL FUNCIONAMIENTO NORMAL DEL BOTON DEL FORMULARIO, ES DECIR, EVITA QUE SE RECARGUE LA PAGINA
        /*Se crea un objeto javascript*/
        let postData = {
            id : $('#productId').val(),
            nombre : $('#name').val(),
            marca : $('#brand').val(),
            modelo : $('#model').val(),
            precio : $('#price').val(),
            detalles : $('#details').val(),
            unidades : $('#units').val(),
            imagen : $('#image').val(),
        };

        console.log(postData)
        
        //comienzan las validaciones del formulario, se hacen luego del envio del formulario
        var nombre=postData['nombre'];
        var marca = postData['marca'];
        var modelo=postData['modelo'];
        var precio=postData['precio'];
        var detalles=postData['detalles'];
        var unidades=postData['unidades'];
        var imagen=postData['imagen'];

        if(nombre.length<=0 || nombre.length>100){
            $('#name').addClass("invalid");
            alert('EL nombre no debe de tener menos o 0 caracteres ni tampoco tener mas de 100!!!');
            return; 
            /*con return, la función agregarProducto se detendrá inmediatamente en ese punto y no ejecutará el código restante en la función. */
        }
        else{
            /*se verifica el modelo*/
            var modelo = modelo.trim();
            var esAlfanumerico = /^[A-Z]{2}-\d{3}$/.test(modelo); 

            if (!esAlfanumerico) {
                $('#model').addClass("invalid");
                alert('El campo "modelo" es obligatorio y no puede estar en blanco.');
                return; 
            }
            else{
                var esPrecioValido = !isNaN(parseFloat(precio)) && isFinite(precio) && parseFloat(precio) > 99.99;
                if (!esPrecioValido) {
                    $('#price').addClass("invalid");
                    alert('El precio ingresado no es un número válido o debe de ser mayor a 99.99.');
                    return; 
                } 
                else {
                    if(detalles.length >= 250){
                        alert('Los detalles deben de ser menos de 250 caracteres');
                        $('#details').addClass("invalid");
                        return; 
                    }
                    else{
                        if(parseInt(unidades) == 0){
                            $('#units').addClass("invalid");
                            alert('debe ingresar una cantidad unidades');
                            return; 
                        }
                        else{
                            var unidadesNumericas = parseInt(unidades);
                            if (isNaN(unidadesNumericas) || unidadesNumericas < 0) {
                                $('#units').addClass("invalid");
                                alert('Las unidades ingresadas no son un número válido o son menores que 0.');
                                return; 
                            } else {
                                if (imagen.trim() === "") {
                                    imagen = 'img/default.png';
                                    $('#image').addClass("invalid");
                                    alert('agregaremos una imagen por defecto');
                                    $('#image').val("img/default.png");
                                }
                            }
                        }
                    }
                }
            }
        }

        const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
        /*objeto js a string json*/
        let stringPostData = JSON.stringify(postData);
        /*string json a objeto json*/
        let objPostData = JSON.parse(stringPostData);
        
        $.post(url, { data: objPostData }, (response) => {
            console.log(response);
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let respuesta = JSON.parse(response);
            // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
            let template_bar = '';
            template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
            // SE REINICIA EL FORMULARIO
            $('#name').val('').removeClass('valid');
            $('#brand').val('rolex').removeClass('valid');
            $('#model').val('').removeClass('valid');
            $('#price').val('').removeClass('valid');
            $('#details').val('').removeClass('valid');
            $('#units').val('').removeClass('valid');
            $('#image').val('').removeClass('valid');

            // SE HACE VISIBLE LA BARRA DE ESTADO
            $('#product-result').show();
            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
            $('#container').html(template_bar);
            // SE LISTAN TODOS LOS PRODUCTOS
            listarProductos();
            // SE REGRESA LA BANDERA DE EDICIÓN A false
            edit = false;
        });
    });

    //FUNCION DELETE
    $(document).on('click', '.product-delete', (e) =>{
        if(confirm('estas seguro?')){
            let id = event.target.parentElement.parentElement.getAttribute("productId");
            console.log(id);
            $.post('./backend/product-delete.php', {id}, (response) => {
                console.log(response);
                listarProductos();
                    let respuesta = JSON.parse(response);
                    let template_bar = '';
                        template_bar += `
                            <li>${respuesta.message}</il>
                        `;
                    $('#product-result').show();
                    $('#container').html(template_bar);
            });
        }
    });

    //FUNCION EDIT
    $(document).on('click', '.product-item', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('productId');
        $.post('./backend/product-single.php', {id}, (response) => {
            // SE CONVIERTE A OBJETO EL JSON OBTENIDO
            let product = JSON.parse(response);
            // SE INSERTAN LOS DATOS ESPECIALES EN LOS CAMPOS CORRESPONDIENTES
            $('#name').val(product.nombre);
            $('#brand').val(product.marca);
            $('#model').val(product.modelo);
            $('#price').val(product.precio);
            $('#details').val(product.detalles);
            $('#units').val(product.unidades);
            $('#image').val(product.imagen);
           
            // EL ID SE INSERTA EN UN CAMPO OCULTO PARA USARLO DESPUÉS PARA LA ACTUALIZACIÓN
            $('#productId').val(product.id);
            // SE PONE LA BANDERA DE EDICIÓN EN true
            edit = true;
        });
        e.preventDefault();
    }); 

    //Funcion para singleByName que sirve para dar un mensaje si el nombre del producto ya existe
    $('#name').keyup(function() {
        if($('#name').val()) {
            let name = $('#name').val();
            $.ajax({
                url: './backend/product-single-by-name.php?name='+$('#name').val(),
                data: {name},
                type: 'GET',
                success: function (response) {
                    // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                    const productos = JSON.parse(response);
                    
                    // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                    let template_bar = '';
                    template_bar += `
                        <li>${productos.message}</il>
                    `;
                    // SE HACE VISIBLE LA BARRA DE ESTADO
                    $('#product-result').show();
                    // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                    $('#container').html(template_bar);
                }
            });
        }
        else {
            $('#product-result').hide();
        }
    });
});