<?php
    include_once __DIR__.'/database.php';

    $data = array();
    
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id']; 

        $sql = "SELECT * FROM productos WHERE id = {$id}";

    } elseif (isset($_POST['info']) && !empty($_POST['info'])) {
        $info = $_POST['info'];

        $sql = "SELECT * FROM productos 
                WHERE nombre LIKE '%{$info}%' 
                OR marca LIKE '%{$info}%' 
                OR detalles LIKE '%{$info}%'";
    }

    if (isset($sql) && $result = $conexion->query($sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $producto = array();
            foreach ($row as $key => $value) {
                $producto[$key] = utf8_encode($value);
            }
            $data[] = $producto;
        }
        $result->free();
    } else {
        die('Query Error: '.mysqli_error($conexion));
    }
    
    // CERRAR CONEXIÓN
    $conexion->close();
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>