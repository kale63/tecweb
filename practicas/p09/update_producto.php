<?php
    
    $link = mysqli_connect("localhost", "root", "californication", "marketzone");

  
    if ($link === false) {
        die("ERROR: No pudo conectarse con la DB. " . mysqli_connect_error());
    }

    $id_producto = intval($_GET['id'] ?? 0);

   
        $name = $_POST['name'] ?? '';
        $brand = $_POST['brand'] ?? '';
        $model = $_POST['model'] ?? '';
        $price = $_POST['price'] ?? '';
        $details = $_POST['details'] ?? '';
        $units = $_POST['units'] ?? '';
        $imgPath = $_POST['imgPath'] ?? '';
    

    $sql = "UPDATE productos SET 
        nombre='$name', 
        marca='$brand', 
        modelo='$model', 
        precio='$price', 
        detalles='$details', 
        unidades='$units', 
        imagen='$imgPath' 
        WHERE id=$id_producto";

    //echo $sql;

    if(mysqli_query($link, $sql)){
        echo "Registro actualizado.<br>";
    } else {
        echo "ERROR: No se ejecuto $sql. " . mysqli_error($link);
    }
    
    echo'<a href="http://localhost/tecweb/tecweb/practicas/p09/get_productos_vigentes_v2.php">Consultar Productos Vigentes</a><br>';
    echo'<a href="http://localhost/tecweb/tecweb/practicas/p09/get_productos_xhtml_v2.php">Consultar Productos por Tope</a>';

    mysqli_close($link);
?>
