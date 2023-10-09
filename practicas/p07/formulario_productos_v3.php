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

      <form id="formularioProductos" action="http://localhost/tecweb/practicas/p07/actualizar_producto.php" method="post" onsubmit="return validarFormulario()">
        <fieldset>
          <legend>Información del producto a actualizar</legend>

          <ul>
              <li>
                  <label for="id">ID:</label>
                  <input type="text" name="id" id="id" value="<?= !empty($_POST['id'])?$_POST['id']:$_GET['id'] ?>" readonly>
              </li>
            <li><label for="form-name-producto">Nombre:</label> <input type="text" name="nombre" id="form-name-producto" value="<?= !empty($_POST['nombre'])?$_POST['nombre']:$_GET['nombre'] ?>"></li>
            <li><label for="form-marca">Marca:</label>
              <select name="marcas" id="form-marca" required>
                <option value="HP">HP</option>
                <option value="DELL">DELL</option>
                <option value="LENOVO">LENOVO</option>
                <option value="AMD">AMD</option>
                <option value="INTEL">INTEL</option>
              </select>
            </li>
            <li><label for="form-model">Modelo:</label> <input type="text" name="modelo" id="form-model" value="<?= !empty($_POST['modelo'])?$_POST['modelo']:$_GET['modelo'] ?>"></li>
            <li><label for="form-precio">Precio:</label> <input type="number" name="precio" id="form-precio" value="<?= !empty($_POST['precio'])?$_POST['precio']:$_GET['precio'] ?>"></li>
            <li><label for="form-detalles">Detalles:</label><input type="text" name="detalles" id="form-detalles" value="<?= !empty($_POST['detalles'])?$_POST['detalles']:$_GET['detalles'] ?>"></li>
            <li><label for="form-unidades">Unidades:</label> <input type="number" name="unidades" id="form-unidades" value="<?= !empty($_POST['unidades'])?$_POST['unidades']:$_GET['unidades'] ?>"></li>
            <li><label for="form-img">Imagen:</label> <input type="text" name="imagen" id="form-img" value="<?= !empty($_POST['imagen'])?$_POST['imagen']:$_GET['imagen'] ?>"></li>
          </ul>
        </fieldset>
        <p>
          <input type="submit" value="Actualizar producto" name="UpdateProduct">
        </p>
      </form>
      <script>
            function validarFormulario() {
              var nombre = document.getElementById('form-name-producto').value;
              var marca = document.getElementById('form-marca').value;
              var modelo = document.getElementById('form-model').value;
              var precio = parseFloat(document.getElementById('form-precio').value);
              var detalles = document.getElementById('form-detalles').value;
              var unidades = parseInt(document.getElementById('form-unidades').value);
              var imagen = document.getElementById('form-img').value;

              //trim() metodo de js utiliza cadenas de texto para eliminar espacios en blanco
              if (nombre.trim() === "" || nombre.length > 100) {
                alert("El nombre es requerido y debe tener 100 caracteres o menos.");
                return false;
              }

              if (marca === "") {
                  alert("Debes seleccionar una marca.");
                  return false;
              }

              if (!modelo.match(/^[a-zA-Z0-9 ]{1,25}$/)) {
                  alert("El modelo debe ser alfanumérico y tener 25 caracteres o menos.");
                  return false;
              }
              //isNan is not a number
              if (isNaN(precio) || precio <= 99.99) {
                  alert("El precio debe ser un número mayor a 99.99.");
                  return false;
              }

              if (detalles.length > 250) {
                  alert("Los detalles no deben tener más de 250 caracteres.");
                  return false;
              }

              if (isNaN(unidades) || unidades < 0) {
                  alert("Las unidades deben ser un número mayor o igual a 0.");
                  return false;
              }

              if (imagen.trim() === "") {
                  document.getElementById('form-img').value = "img/default.png";
              }

              return true;
            }
        </script>
	</body>
</html>