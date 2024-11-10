<?php
include_once __DIR__.'/database.php';

$data = array(
    'status'  => 'error',
    'message' => 'Error'
);

if(!empty($jsonOBJ)) {
    $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
    $result = $conexion->query($sql);

    if ($result && $result->num_rows == 0) {
        $conexion->set_charset("utf8");
        
        $sql = "INSERT INTO productos 
                VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', 
                        {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, 
                        '{$jsonOBJ->imagen}', 0)";

        if($conexion->query($sql)) {
            $data['status'] = "success";
            $data['message'] = "Producto agregado";
        } else {
            $data['message'] = "Error al insertar: " . $conexion->error;
        }
    } elseif ($result) {
        $data['message'] = "Producto con ese nombre ya existe.";
    } else {
        $data['message'] = "Error en la consulta: " . $conexion->error;
    }

    if ($result) $result->free();
    $conexion->close();
}

echo json_encode($data, JSON_PRETTY_PRINT);
?>
