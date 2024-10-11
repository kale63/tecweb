<?php
    header("Content-Type: text/html; charset=utf-8");

    @$link = new mysqli('localhost', 'root', 'californication', 'marketzone');
  
    if ($link->connect_errno) {
      die('Falló la conexión: ' . $link->connect_error . '<br/>');
    }

    $product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($product_id > 0) {
        $sql = "SELECT * FROM productos WHERE id = $product_id";
        
       
        $result = $link->query($sql);
        
        if (!$result) {
            die('Error en la consulta: ' . $link->error . '<br/>');
        }

        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();

            $product_name = $product['nombre'];
            $product_brand = $product['marca'];
            $product_model = $product['modelo'];
            $product_price = $product['precio'];
            $product_details = $product['detalles'];
            $product_units = $product['unidades'];
            $product_img = $product['imagen'];
        } else {
            echo "No se encontró un producto con ese ID.<br/>";
        }

        $result->free();
    }

    $link->close();
?>

<!DOCTYPE html >
<html>

  <head>
    <meta charset="utf-8" >
    <title>Registro de Nuevos Productos</title>
    <style type="text/css">
      ol, ul { 
      list-style-type: none;
      }
    </style>
    <script src="script_formulario_producto.js" defer></script>
  </head>

  <body>
    <h1>Registro de Productos</h1>

    <form id="formularioProducto" action="http://localhost/tecweb/tecweb/practicas/p09/update_producto.php?id=<?php echo $product_id?>" method="post">
      <h2>Información del Producto</h2>

      <fieldset>
          <legend>Ingresa los Detalles del Producto</legend>

          <ul>
              <li><label for="form-name">Nombre del Producto:</label> 
                  <input type="text" name="name" id="form-name" value="<?php echo isset($product_name) ? $product_name : ''; ?>">
              </li><br>
              
              <li>
                  <label for="form-brand">Marca:</label>
                  <select name="brand" id="form-brand">
                      <option value="default" disabled <?php if (!isset($product_brand)) echo 'selected'; ?>>Selecciona una marca</option>
                      <option value="ravensburger" <?php if (isset($product_brand) && $product_brand == 'ravensburger') echo 'selected'; ?>>Ravensburger</option>
                      <option value="magic" <?php if (isset($product_brand) && $product_brand == 'magic') echo 'selected'; ?>>Magic Puzzle Company</option>
                      <option value="daqi" <?php if (isset($product_brand) && $product_brand == 'daqi') echo 'selected'; ?>>DAQI</option>
                      <option value="lego" <?php if (isset($product_brand) && $product_brand == 'lego') echo 'selected'; ?>>LEGO</option>
                      <option value="clementoni" <?php if (isset($product_brand) && $product_brand == 'clementoni') echo 'selected'; ?>>Clementoni</option>
                      <option value="plaid" <?php if (isset($product_brand) && $product_brand == 'plaid') echo 'selected'; ?>>Plaid</option>
                  </select>
              </li><br>

              <li><label for="form-model">Modelo:</label> 
                  <input type="text" name="model" id="form-model" value="<?php echo isset($product_model) ? $product_model : ''; ?>">
              </li><br>
              
              <li><label for="form-price">Precio:</label> 
                  <input type="text" name="price" id="form-price" value="<?php echo isset($product_price) ? $product_price : ''; ?>">
              </li><br>

              <li><label for="form-details">Detalles:</label> 
                  <input type="text" name="details" id="form-details" value="<?php echo isset($product_details) ? $product_details : ''; ?>">
              </li><br>

              <li><label for="form-units">Unidades:</label> 
                  <input type="number" name="units" id="form-units" value="<?php echo isset($product_units) ? $product_units : ''; ?>">
              </li><br>

              <li><label for="form-img-path">Ruta de la Imagen:</label> 
                  <input type="text" name="img" id="form-img-path" value="<?php echo isset($product_img) ? $product_img : ''; ?>">
              </li>
          </ul>
      </fieldset>

      <p>
          <input type="submit" value="Guardar">
          <input type="reset">
      </p>
    </form>
  </body>
</html>