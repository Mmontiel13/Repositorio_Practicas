<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Formulario Productos</title>
		<style type="text/css">
      ol, ul { 
      list-style-type: none;
      }
    </style>
	</head>
	<body>
      <h1>Formulario de productos</h1>

      <form id="formularioProductos" action="" method="post">
        <fieldset>
          <legend>Información del producto</legend>

          <ul>
            <li><label for="form-name-producto">Nombre:</label> <input type="text" name="nombre_producto" id="form-name-producto"></li>
            <li><label for="form-marca">Marca:</label> <input type="text" name="marca_producto" id="form-marca"></li>
            <li><label for="form-model">Modelo:</label> <input type="text" name="modelo_producto" id="form-model"></li>
            <li><label for="form-precio">Precio:</label> <input type="text" name="precio_producto" id="form-precio"></li>
            <li><label for="form-detalles">Detalles:</label><br><textarea name="detalles_producto" rows="4" cols="60" id="form-detalles" placeholder="No más de 100 caracteres de longitud" maxlength="100"></textarea></li>
            <li><label for="form-unidades">Unidades:</label> <input type="text" name="unidades_producto" id="form-unidades"></li>
            <li><label for="form-img">Imagen:</label> <input type="text" name="imagen_producto" id="form-img"></li>
          </ul>
        </fieldset>
        <p>
          <input type="submit" value="Agregar Producto" name="addProduct" formaction="set_producto.php">
          <input type="submit" value="Validar y Agregar Producto" name="addValidProduct" formaction="set_producto_v2.php">
        </p>
      </form>
        
	</body>
</html>