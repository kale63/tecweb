<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    if(!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JASON A OBJETO
        $jsonOBJ = json_decode($producto);

        if (isset($jsonOBJ->nombre) && isset($jsonOBJ->precio) && isset($jsonOBJ->modelo)) {

            $nombre = $jsonOBJ->nombre;
            $precio = $jsonOBJ->precio;
            $modelo = $jsonOBJ->modelo;
            $unidades = $jsonOBJ->unidades;
            $marca = $jsonOBJ->marca;
            $detalles = $jsonOBJ->detalles;
            $imagen = $jsonOBJ->imagen;
    
            $consulta = "SELECT * FROM productos WHERE nombre = ? AND eliminado = 0";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param('s', $nombre);
            $stmt->execute();
            $resultado = $stmt->get_result();
    
            if ($resultado->num_rows > 0) {
                echo 'Error: Ya existe un producto con este nombre (y no está eliminado).';
            } else {
                
                $sql = "INSERT INTO productos (nombre, precio, modelo, unidades, marca, detalles, imagen) 
                              VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param('sdissss', $nombre, $precio, $modelo, $unidades, $marca, $detalles, $imagen);
                
                if ($stmt->execute()) {
                    echo 'Producto insertado correctamente.';
                } else {
                    echo 'Error al insertar el producto: '.$conexion->error;
                }
            }
        } else {
            echo 'Error: Datos incompletos.';
        }
    }
?>