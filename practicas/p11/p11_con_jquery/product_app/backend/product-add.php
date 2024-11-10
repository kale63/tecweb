<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    $data = array(
        'status'  => 'error',
        'message' => 'Ya existe un producto con ese nombre'
    );
    
    if(!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JASON A OBJETO
        $jsonOBJ = json_decode($producto);
        
        if(json_last_error() === JSON_ERROR_NONE){
            $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
            $result = $conexion->query($sql);
            
            if($result) {
                if ($result->num_rows == 0) {
                    $conexion->set_charset("utf8");
                    $sql = "INSERT INTO productos VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}', 0)";
                    if($conexion->query($sql)){
                        $data['status'] =  "success";
                        $data['message'] =  "Producto agregado";
                    } else {
                        $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($conexion);
                    }
                }
                $result->free();
            }
            
        } else {
            $data['message'] = "El formato del JSON no es válido: " . json_last_error_msg();
        }
        

        
        // Cierra la conexion
        $conexion->close();
    }

    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>